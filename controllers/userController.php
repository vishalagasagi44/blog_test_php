<?php
require_once __DIR__ . '/../models/user.php';

class UserController 
{
    private $userModel;

    public function __construct()
    {
        global $conn; 
        $this->userModel = new AuthModel($conn); 
    }
    // Fetch all users with designation 'Author'
    public function getAuthors() {
        $authors = $this->userModel->getAuthors();
        echo json_encode($authors);
    }

    // Add a new author
    public function addAuthor() {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $content = $_POST['content'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $designation = 'Author'; // Default designation for new user
        $is_active = 1; // New users are active by default

        $result = $this->userModel->insertAuthor($name, $email,$content, $password, $designation, $is_active);
        echo json_encode($result);
    }

    // Deactivate a user
    public function deactivateUser($userId) {
        $result = $this->userModel->updateUserStatus($userId, 0); // 0 for deactivated
        echo json_encode($result);
    }

    // Delete a user
    public function deleteUser($userId) {
        $result = $this->userModel->deleteUser($userId);
        echo json_encode($result);
    }
}
?>
