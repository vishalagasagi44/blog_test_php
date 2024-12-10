<?php
 
require_once './baseurl.php';

class BlogModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function createWithImage($data, $image) {
        // Set upload directory and file name
        $uploadDir = __DIR__.'/../public/uploads/';
        $fileName = basename($image['name']);
        $uploadFilePath = $uploadDir . $fileName;

        // Move uploaded file to the desired directory
        if (move_uploaded_file($image['tmp_name'], $uploadFilePath)) {
            // Add the image path to the data array
            $data['image_path'] = $fileName;

            // Insert blog post data into the database
            return $this->create($data);
        } else {
            return ['error' => 'Error uploading image'];
        }
    }

    // Function to insert the blog post data into the database
    public function create($data) {
        $query = "INSERT INTO blog_posts (title, description, content, author_id, category, image_path) 
                  VALUES (:title, :description, :content, :author_id, :category, :image_path)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':content', $data['content']);
        $stmt->bindParam(':author_id', $data['author_id']);
        $stmt->bindParam(':category', $data['category']);
        $stmt->bindParam(':image_path', $data['image_path']);

        if ($stmt->execute()) {
            return ['message' => 'Blog added successfully'];
        } else {
            return ['error' => 'Error adding blog'];
        }
    }
    public function edit($data) {
    
        
        $query = "UPDATE blog_posts SET 
                  title = :title, description = :description, content = :content, 
                  category = :category, image_path = :image_path
                  WHERE id = :id";
       // Bind parameters
       $stmt = $this->conn->prepare($query);
    
    $stmt->bindParam(':title', $data['title']);
    $stmt->bindParam(':description', $data['description']);
    $stmt->bindParam(':content', $data['content']);
    $stmt->bindParam(':category', $data['category']);
    $stmt->bindParam(':image_path',  $data['image_path']); // Use the existing or new image path
    $stmt->bindParam(':id', $data['id']); // Ensure the blog ID is passed

        if ($stmt->execute()) {
            return ['message' => 'Blog added successfully'];
        } else {
            return ['error' => 'Error adding blog'];
        }
    }
    
    
    

    public function delete($id) {
        $query = "DELETE FROM blog_posts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }

    public function fetchAll() {
        $query = "SELECT * FROM blog_posts";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Use fetchAll() on the statement object
    }

    public function fetchById($id) {
        $query = "SELECT * FROM blog_posts WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
    public function fetchByAuthor($authorId) {
        $query = "SELECT * FROM blog_posts WHERE author_id = :author_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':author_id', $authorId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
