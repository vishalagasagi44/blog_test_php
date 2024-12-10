<?php
require_once './database/db.php';
 
class AuthModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
     
    
        public function getUserByUsername($username)
        {
            $sql = "SELECT * FROM users WHERE email = :username AND is_active = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        public function getUserByEmail($email)
        {
            $sql = "SELECT * FROM users WHERE email = :email AND is_active = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function getAllUsers() {
            $query = "SELECT * FROM users";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        public function getAuthors() {
            $sql = "SELECT * FROM users WHERE designation = 'Author' AND is_active = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        // Insert a new author
        public function insertAuthor($name, $email, $content, $password, $designation, $is_active) {
            try {
                // Check if the email already exists
                $checkQuery = "SELECT id FROM users WHERE email = :email";
                $checkStmt = $this->conn->prepare($checkQuery);
                $checkStmt->bindParam(':email', $email);
                $checkStmt->execute();
        
                if ($checkStmt->rowCount() > 0) {
                    return ["success" => false, "message" => "Email already exists"];
                }
        
                // Insert new author
                $insertQuery = "INSERT INTO users (name, email,content, password, designation, is_active, created_at) 
                                VALUES (:name, :email,:content, :password, :designation, :is_active, NOW())";
                $stmt = $this->conn->prepare($insertQuery);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':designation', $designation);
                $stmt->bindParam(':is_active', $is_active);
        
                if ($stmt->execute()) {
                    return ["success" => true, "message" => "Author added successfully"];
                } else {
                    return ["success" => false, "message" => "Failed to add author"];
                }
            } catch (PDOException $e) {
                return ["success" => false, "message" => $e->getMessage()];
            }
        }
        
        // Update user status (deactivate)
        public function updateUserStatus($userId, $status) {
            $sql = "UPDATE users SET is_active = :status WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':id', $userId);
            return $stmt->execute();
        }
    
        // Delete a user
        public function deleteUser($userId) {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $userId);
            return $stmt->execute();
        }
        public function saveOTP($userId, $otp) {
            $query = "UPDATE users SET otp = :otp, otp_expiry = DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':otp', $otp, PDO::PARAM_INT);
            $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
            
            return $stmt->execute();
        }
        public function verifyOTP($email, $otp)
        {
            $query = "SELECT id FROM users WHERE email = :email AND otp = :otp AND otp_expiry > NOW() AND is_active = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':otp', $otp, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount() > 0; 
        }
    
      
        public function updatePassword($email, $hashedPassword)
        {
            $query = "UPDATE users SET password = :password, otp = NULL, otp_expiry = NULL WHERE email = :email AND is_active = 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            return $stmt->execute();
        }
        
    }
    ?>
    