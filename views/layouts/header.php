
<?php
   if (session_status() == PHP_SESSION_NONE) {
       session_start();
   }
   require_once __DIR__ . '/../../baseurl.php';
   $csrfToken = $_SESSION['csrf_token'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Blog_pro</title>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE_ASSET; ?>/images/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE_ASSET; ?>/images/logo/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE_ASSET; ?>/images/logo/apple-touch-icon.png">
    <link rel="manifest" href="<?php echo BASE_ASSET; ?>/images/logo/site.webmanifest">
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/css/style.css" />
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/plugins/themify/css/themify-icons.css">
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/plugins/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/plugins/magnific-popup/dist/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/plugins/slick-carousel/slick/slick.css">
    <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/plugins/slick-carousel/slick/slick-theme.css">

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script src="https://kit.fontawesome.com/5164f520d9.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    const BASE_DIR = "<?= BASE_DIR ?>";
</script>

<body>
<header class="navigation">
	 
 
</header>
<div class="main-wrapper ">

	