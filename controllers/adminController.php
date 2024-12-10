<?php
class AdminController {
 
    public function index() {
        require_once 'views/admin/login.php';
    }

    public function users() {
        require_once 'views/admin/author.php';
    }
}
?>
