<?php
require_once __DIR__ . '/../models/user.php';

require_once 'utills/SMTPMailer.php';
 
class ForgotPasswordController {

    private $userModel;

    public function __construct()
    {
        global $conn; 
        $this->userModel = new AuthModel($conn); 
    }
    public function sendOTP() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);

            $user = $this->userModel->getUserByEmail($email);
            if ($user) {
                $otp = rand(100000, 999999); // Generate a 6-digit OTP
                $this->userModel->saveOTP($user['id'], $otp); 
                $subject = "Your Password Reset OTP";
                $body = "Your OTP for password reset is: $otp";
                if (SMTPMailer::sendMail($email, $subject, $body)) {
                    echo json_encode(['success' => true, 'message' => 'OTP sent to your email.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Failed to send OTP.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Email not found.']);
            }
        }
    }

    // Handle OTP verification
    public function verifyOTP() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $otp = intval($_POST['otp']);

         
            $isValid = $this->userModel->verifyOTP($email, $otp);

            if ($isValid) {
                $_SESSION['reset_email'] = $email; // Store email in session for resetting the password
                echo json_encode(['success' => true, 'message' => 'OTP verified.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid or expired OTP.']);
            }
        }
    }

    // Handle password reset
    public function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_SESSION['reset_email'] ?? null;
            $password = trim($_POST['newPassword']);
            if ($email) {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $this->userModel->updatePassword($email, $hashedPassword);
                unset($_SESSION['reset_email']);  
                echo json_encode(['success' => true, 'message' => 'Password reset successfully.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Session expired. Please try again.']);
            }
        }
    }
}
?>
