<?php
session_start();
require_once './database/db.php';
require_once './helpers/functions.php'; 
require_once './controllers/blogController.php'; 
require_once './controllers/searchController.php';
require_once './controllers/commentController.php';
require_once './controllers/adminController.php';
require_once './controllers/authController.php';
require_once './controllers/dashController.php';
require_once './controllers/blogpostController.php';
require_once './controllers/userController.php';
require_once './controllers/forgetPasswordController.php';
require_once __DIR__.'/router.php'; 


function isAuthenticated() {
    return isset($_SESSION['user_id']);
}

any('/', 'BlogController@index');  
any('/about', 'views/blogs/about.php'); 
any('/contact', 'views/blogs/contact.php'); 
any('/post/$id', 'BlogController@single');
get('/search', 'searchController@search');
post('/comments/create/$id', 'commentController@create');
post('/blog/create', 'blogpostController@create');
post('/blog/edit', 'blogpostController@edit');
post('/blog/delete', 'blogpostController@delete');
get('/blog/fetch', 'blogpostController@fetch');
get('/blog/fetchById/$id', 'blogpostController@fetchById');
get('/getUnapprovedCommentCount/$id', 'blogController@getUnapprovedCommentCount');
get('/getComments/$id', 'blogController@getComments');
post('/updateCommentApproval/$id/1', 'blogController@approveComment');
post('/updateCommentApproval/$id/0', 'blogController@deactivateComment');
any('/dash', 'dashController@dashboard');
any('/adduser', 'dashController@adduser');
any('/login', 'AuthController@login');
any('/logout', 'AuthController@logout');
get('/get-designations', 'dashController@getDesignations');
any('/admin', 'adminController@index');
any('/author', 'adminController@index');
get('/getAuthors', 'userController@getAuthors');
post('/addAuthor', 'userController@addAuthor');

// Forgot Password Routes
post('/forgot-password', 'ForgotPasswordController@sendOTP'); // For processing OTP requests
post('/forgot-password/verify-otp', 'ForgotPasswordController@verifyOTP'); // For verifying the OTP and allowing password reset
post('/forgot-password/reset', 'ForgotPasswordController@resetPassword'); // For handling password reset

post('/deactivateUser/$id', 'userController@deactivateUser');
post('/deleteUser/$id', 'userController@deleteUser');

any('/comments', 'CommentController@index');
any('/comments/moderation', 'CommentController@moderation');

// Error Page
http_response_code(404);
include 'views/404.php';
?>
