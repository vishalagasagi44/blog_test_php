<?php
require_once __DIR__ . '/../models/Blog.php';
require_once __DIR__ . '/../models/comment.php';

class BlogController {
    private $commentModel;

    public function __construct() {
        // Instantiate the correct Comment class (not CommentModel)
        $this->commentModel = new Comment();  // Make sure this matches the class name in Comment.php
    }

    public function index() {
        $blogModel = new Blog();
        
        // Set the number of posts per page
        $postsPerPage = 10;

        // Get the current page from URL, default to 1 if not set
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // Get the total number of posts
        $totalPosts = $blogModel->getTotalPosts();

        // Calculate total pages
        $totalPages = ceil($totalPosts / $postsPerPage);

        // Calculate the offset for the query
        $offset = ($currentPage - 1) * $postsPerPage;

        // Get the posts for the current page
        $posts = $blogModel->getAllPosts($postsPerPage, $offset);

        // Pass data to the view
        require_once 'views/blogs/index.php';
    }

    public function single($postId) {
        $blogModel = new Blog();
        $post = $blogModel->getPostById($postId);
        if ($post) {
            $author = $blogModel->getAuthorById($post['author_id']);
        } else {
            $author = null;
        }
        $commentModel = new Comment();
        $comments = $commentModel->getCommentsByPostId($postId);
        $latestPosts = $blogModel->getLatestPosts(5);
        require_once 'views/blogs/single.php';
    }
    public function getPosts($userId, $isAdmin)
        {
            if ($isAdmin) {
                $sql = "SELECT * FROM blog_posts";
                $stmt = $this->conn->prepare($sql);
            } else {
                $sql = "SELECT * FROM blog_posts WHERE author_id = :userId";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getUnapprovedCommentCount($postId) {
            $count = $this->commentModel->getUnapprovedCommentCount($postId);
            echo json_encode(['unapproved_count' => $count]);
        }
    
        // Fetch comments for a specific post
        public function getComments($postId) {
            $comments = $this->commentModel->getCommentsByPost($postId);
            echo json_encode($comments);
        }
    
        // Approve a comment
        public function approveComment($commentId) {
            $result = $this->commentModel->updateCommentApproval($commentId, 1);
            echo json_encode($result);
        }
    
        // Deactivate a comment
        public function deactivateComment($commentId) {
            $result = $this->commentModel->updateCommentApproval($commentId, 0);
            echo json_encode($result);
        }
}

?>
