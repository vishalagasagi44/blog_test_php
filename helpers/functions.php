<?php
// Sanitize user inputs
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Redirect function
function redirect($url) {
    header("Location: $url");
    exit;
}

// Password Hashing
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}
?>
