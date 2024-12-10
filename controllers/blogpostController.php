<?php
require_once __DIR__ . '/../models/blog_post.php';

class BlogPostController {



    
    public function create() {
 
            // Check if file is uploaded
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $blogModel = new BlogModel();
                $data = $_POST;
                $response = $blogModel->createWithImage($data, $_FILES['image']);
                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'No image file uploaded or error with the image']);
            }
        }
    

        public function edit() {
            $data = $_POST;
            $blogModel = new BlogModel();
    
           
            if (isset($_FILES['image_path'])) {
                $uploadDir = __DIR__ . '/../public/uploads/';
                $fileName = basename($_FILES['image_path']['name']);
                $uploadFilePath = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['image_path']['tmp_name'], $uploadFilePath)) {
                    $data['image_path'] = $fileName; // Add the new image path to the data
                } else {
                    echo json_encode(['error' => 'Error uploading image']);
                    return; // Exit if image upload fails
                }
            } 
            $response = $blogModel->edit($data);
            echo json_encode($response);
        }

    public function delete() {
        $id = $_POST['id'];
        $blogModel = new BlogModel();
        $response = $blogModel->delete($id);
        echo json_encode($response);
    }

    public function fetch() {
        $blogModel = new BlogModel();
        $username = $_SESSION['auth']; // Assuming the username is stored in the session
        $user_id = $_SESSION['user_id'];  // Assuming the user ID is stored in the session
        $user_role = $_SESSION['designation'];   // Assuming the user's role is stored in the session (e.g., 'Admin', 'Author')
    
        if ($user_role === 'Author') { 
            $blogs = $blogModel->fetchByAuthor($user_id);
        } else {
            // Admin or other roles fetch all posts
            $blogs = $blogModel->fetchAll();
        }
    
        echo json_encode(['data' => $blogs]);
    }
   
    

    public function fetchById($id) {
        $blogModel = new BlogModel();
        $blog = $blogModel->fetchById($id);
        echo json_encode($blog);
    }

    public function single($id) {
        $blogModel = new BlogModel();
        $blog = $blogModel->fetchById($id);
        require_once 'views/blogs/single.php';
    }
}
