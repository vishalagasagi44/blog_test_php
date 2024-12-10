<?php
require_once './models/user.php'; // Assuming you have a User model
require_once './baseurl.php';

class DashController
{
    private $model;

    public function __construct()
    {
        global $conn; 
        $this->model = new AuthModel($conn); 
    }

    private function sanitize_input($data)
    {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    public function dashboard()
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: ' . BASE_DIR . '/admin');
            exit();
        }

        $urlAuth = isset($_GET['auth']) ? $this->sanitize_input($_GET['auth']) : '';
        $sessionAuth = $_SESSION['auth'] ?? '';
        $username = $_SESSION['designation'] ?? '';
        $user_id = $_SESSION['user_id'] ?? '';
        $decodedUrlAuth = base64_decode($urlAuth, true);
        $encryptedAppNo = $urlAuth;
        if ($decodedUrlAuth !== $sessionAuth) {
            header('Location: ' . BASE_DIR . '/admin');
            exit();
        }

        // Check if the user exists
        $user = $this->model->getUserByEmail($sessionAuth);

        if (!$user) {
            header('Location: ' . BASE_DIR . '/admin');
            exit();
        }

        // Render dashboard view
        include './views/admin/dash.php';
    }

    public function adduser()
    {
        if (!isset($_SESSION['auth'])) {
            header('Location: ' . BASE_DIR . '/admin');
            exit();
        }

        $urlAuth = isset($_GET['auth']) ? $this->sanitize_input($_GET['auth']) : '';
        $sessionAuth = $_SESSION['auth'] ?? '';
        $username = $_SESSION['designation'] ?? '';
        $user_id = $_SESSION['user_id'] ?? '';
        $decodedUrlAuth = base64_decode($urlAuth, true);
        $encryptedAppNo = $urlAuth;
        if ($decodedUrlAuth !== $sessionAuth) {
            header('Location: ' . BASE_DIR . '/admin');
            exit();
        }

        // Check if the user exists
        $user = $this->model->getUserByEmail($sessionAuth);

        if (!$user) {
            header('Location: ' . BASE_DIR . '/admin');
            exit();
        }

        // Render dashboard view
        include './views/admin/addusers.php';
    }
}

?>
