<?php
// Database connection
$host = 'localhost';
$dbname = 'blogspro';
$username = 'root'; // Update with your database username
$password = ''; // Update with your database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
