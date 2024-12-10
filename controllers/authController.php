<?php

require_once './models/user.php'; // Ensure this is the correct path
require_once './baseurl.php';

class AuthController
{
    private $model;

    public function __construct()
    {
        global $conn; // Use the database connection from db.php
        $this->model = new AuthModel($conn); // Initialize the model with the database connection
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Validate input
            if (empty($username) || empty($password)) {
                echo json_encode(['success' => false, 'message' => 'Username and password are required.']);
                return;
            }

            $user = $this->model->getUserByUsername($username);
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['auth'] = $user['email'];
                $_SESSION['designation'] = $user['designation'];
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Invalid credentials.']);
            }
        } else {
            include 'views/admin'; // Load login view for non-POST requests
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_DIR . '/admin');
        exit();
    }
}

