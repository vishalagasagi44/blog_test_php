<?php
class CommentController {
    public function create($postId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Decode JSON payload
            $data = json_decode(file_get_contents('php://input'), true);

            // Validate CSRF token
            if (!validateCsrfToken($data['csrfToken'])) {
                http_response_code(403);
                echo json_encode(['status' => 'error', 'message' => 'Invalid CSRF tokenee.']);
                exit();
            }

            // Sanitize and validate input data
            $name = sanitize($data['name']);
            $email = sanitize($data['email']);
            $comment = sanitize($data['comment']);

            if (empty($name) || empty($email) || empty($comment)) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
                exit();
            }

            // Add comment to the database
            $commentModel = new Comment();
            $commentModel->addComment($postId, $name, $email, $comment);

            echo json_encode(['status' => 'success', 'message' => 'Comment added successfully.']);
        }
    }
    

    public function index() {
        $comments = $this->commentModel->getAllComments();
        echo json_encode($comments);
    }

    // Approve a comment
    public function approve($id) {
        $result = $this->commentModel->approveComment($id);
        echo json_encode($result);
    }

    // Delete a comment
    public function delete($id) {
        $result = $this->commentModel->deleteComment($id);
        echo json_encode($result);
    }
}
?>
