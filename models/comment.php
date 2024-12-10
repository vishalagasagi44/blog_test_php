<?php
class Comment {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getCommentsByPostId($postId) {
        $query = "SELECT * FROM comments WHERE post_id = :post_id AND is_approved = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':post_id', $postId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addComment($postId, $name, $email, $comment) {
        $query = "INSERT INTO comments (post_id, commenter_name, commenter_email, comment) VALUES (:post_id, :name, :email, :comment)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':post_id', $postId);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();
    }

    public function getAllComments() {
        $query = "SELECT * FROM comments";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUnapprovedCommentCount($postId) {
        $query = "SELECT COUNT(*) FROM comments WHERE post_id = :post_id AND is_approved = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':post_id', $postId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Get comments by post ID
    public function getCommentsByPost($postId) {
        $query = "SELECT * FROM comments WHERE post_id = :post_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':post_id', $postId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Update the approval status of a comment
    public function updateCommentApproval($commentId, $status) {
        $query = "UPDATE comments SET is_approved = :status WHERE id = :comment_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':comment_id', $commentId);
        if ($stmt->execute()) {
            return ['message' => 'Comment updated successfully'];
        } else {
            return ['error' => 'Error updating comment'];
        }
    }
}
?>
