<?php

class Post
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function searchPosts($query)
    {
        $sql = "SELECT id, title, image_path FROM blog_posts WHERE title LIKE :query LIMIT 10";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':query', "%$query%", PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
