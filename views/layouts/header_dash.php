<?php
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
   require_once 'baseurl.php';

 
 
   $current_page = basename($_SERVER['PHP_SELF']);

   // Map page names to their corresponding navbar titles
   $page_titles = [
       'dash.php' => 'Dashboard',
       'adduser.php' => 'User Management',
      
   ];
   
   // Default title if page isn't in the map
   $navbar_title = isset($page_titles[$current_page]) ? $page_titles[$current_page] : '';
   
   
//    function check_session_timeout() {
//        $inactive = 900; // Session timeout in seconds (15 minutes)
//        if (isset($_SESSION['start_time'])) {
//            $session_life = time() - $_SESSION['start_time'];
//            if ($session_life > $inactive) {
//                session_unset();
//                session_destroy();
//                header('Location: ../admin');
//                exit();
//            }
//        }
//        $_SESSION['start_time'] = time(); 
//    }
   
//    check_session_timeout();
   
   
   ?>
   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Blob</title>
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/pageauth.css" />
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/apexcharts.css" />
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/boxicon.css" />
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/cardanalys.css" />
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/demo.css" />
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/custom.css" />
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/responbs.css" />
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/toast.css" />
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/perscroll.css" />
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/datatablebs.css" />
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/typehead.css" />
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/core.css" />
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/temedef.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style type="text/css">
        .layout-menu-fixed .layout-navbar-full .layout-menu,
        .layout-menu-fixed-offcanvas .layout-navbar-full .layout-menu {
        top: 62px !important;
        }
        .layout-page {
        padding-top: 62px !important;
        }
        .content-wrapper {
        padding-bottom: 54px !important;
        }
        .menu-link.active {
            background: rgb(194 245 255);
        color: #fff;

        }
        .comment-btn {
    position: relative;
    display: inline-block;
    font-size: 16px;
    padding: 10px;
}

.comment-btn .fa-comments {
    font-size: 20px; /* Adjust the size of the comment icon */
}

.comment-btn .unapproved-count {
    position: absolute;
    top: -5px;
    right: -5px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
    font-weight: bold;
    display: none;  /* Initially hide the circle */
}

    </style>
    <script>
        const BASE_DIR = "<?= BASE_DIR ?>";
        document.addEventListener('DOMContentLoaded', function () {
            // Get all menu links
            const menuLinks = document.querySelectorAll('.menu-link');

            // Loop through each link
            menuLinks.forEach(link => {
                link.addEventListener('click', function () {
                    // Remove active class from all links
                    menuLinks.forEach(link => link.classList.remove('active'));
                    // Add active class to the clicked link
                    this.classList.add('active');
                });
            });
        });
    </script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/min/moment.min.js"></script>
    <script src="https://kit.fontawesome.com/5164f520d9.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/5164f520d9.js" crossorigin="anonymous"></script>
    <script src="<?php echo BASE_ASSET; ?>/js/jquery.min.js"></script>
    <script src="<?php echo BASE_ASSET; ?>/admin_assets/js/helper.js"></script>
    <script src="<?php echo BASE_ASSET; ?>/admin_assets/js/config.js"></script>
 </head>
