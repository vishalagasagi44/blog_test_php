<?php
require_once './database/db.php';

class searchController {
    private $conn;

    public function __construct() {
        global $conn; // Use the global $conn defined in db.php
        $this->conn = $conn;
    }

    public function search() {
        if (!isset($_GET['query']) || empty($_GET['query'])) {
            echo json_encode([]);
            return;
        }

        $query = htmlspecialchars($_GET['query']);
        $stmt = $this->conn->prepare("SELECT id, title, image_path FROM blog_posts WHERE title LIKE :query LIMIT 5");
        $stmt->execute([':query' => "%$query%"]);

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($results);
    }
}
