<?php

class Blog {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    // Get all posts with pagination
    public function getAllPosts($limit, $offset) {
        $query = "SELECT * FROM blog_posts WHERE is_published = 1 ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get total post count for pagination
    public function getTotalPosts() {
        $query = "SELECT COUNT(*) FROM blog_posts WHERE is_published = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getPostById($id) {
        $query = "SELECT * FROM blog_posts WHERE id = :id AND is_published = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getLatestPosts($limit) {
        $query = "SELECT * FROM blog_posts ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAuthorById($authorId) {
        $query = "SELECT * FROM users WHERE id = :author_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':author_id', $authorId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
