<?php
   if (session_status() == PHP_SESSION_NONE) {
      session_start();
   }
   
   require_once './baseurl.php';
   
   ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Blog</title>
        <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/pageauth.css" />
        <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/core.css" />
        <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/apexcharts.css" />
        <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/boxicon.css" />
        <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/cardanalys.css" />
        <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/demo.css" />
        <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/temedef.css" />
        <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/toast.css" />
        <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/perscroll.css" />
        <link rel="stylesheet" href="<?php echo BASE_ASSET; ?>/admin_assets/css/typehead.css" />
        <script src="<?php  echo BASE_ASSET; ?>/js/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/5164f520d9.js" crossorigin="anonymous"></script>
        <script>
                const BASE_DIR = "<?= BASE_DIR ?>";
        </script>
        <style>
            body {
                overflow: hidden;
            }

            .buttoncus,.buttoncusbut {
                position: relative;
                height: 40px;
                width: 100%;
                background-image: none;
                border: none;
                outline: none;
                background-color: #f56464;
                color: white;
                text-transform: uppercase;
                font-size: 15px;
                font-weight: 600;
                letter-spacing: 2px;
                cursor: pointer;
                transition: all 0.4s ease-out;
                overflow: hidden;
            }
            .hidden {
    display: none;
}


            .buttoncus::after, .buttoncusbut::after {
                content: "";
                display: block;
                position: absolute;
                width: 160px;
                height: 40px;
                background-color: black;
                z-index: -1;
                left: calc(50% - 80px);
                top: 10px;
                opacity: 0.3;
                filter: blur(5px);
                transition: all 0.2s ease-out;
            }

            .buttoncus:hover::after, .buttoncusbut:hover::after {
                opacity: 0.5;
                filter: blur(20px);
                transform: translateY(10px) scaleX(1.2);
            }

            .buttoncus:active, .buttoncusbut:active {
                background-color: #dd4b4b;
            }

            .buttoncus:active::after, .buttoncusbut:active::after {
                opacity: 0.3;
            }

            /* When loading, animate the width of the button */
            .buttoncus.loading, .buttoncusbut.loading {
                width: 50px;
                height: 50px;
                display: block;

                margin-left: auto;
                border-radius: 50px;
                transition: all 0.4s ease-out;
                position: relative;
                margin-right: auto;
            }

            /* Shrink the shadow effect when button is loading */
            .buttoncus.loading::after, .buttoncusbut.loading::after {
                width: 50px;
                top: 16px;
                border-radius: 100%;
                left: calc(50% - 20px); /* Adjust shadow position */
            }

            



            /* Center the spinner and animate it */
            .spinner {
                display: block;
                width: 34px;
                height: 34px;
                position: absolute;
                top: 6px; /* Adjust spinner vertical positioning */
                left: calc(50% - 17px); /* Center the spinner */
                background: transparent;
                box-sizing: border-box;
                border-top: 4px solid white;
                border-left: 4px solid transparent;
                border-right: 4px solid transparent;
                border-bottom: 4px solid transparent;
                border-radius: 100%;
                animation: spin 0.6s ease-out infinite;
            }

            @keyframes spin {
                100% {
                    transform: rotate(360deg);
                }
            }

            .auth .brand-logo img {
                width: 150px;
            }
            /* From Uiverse.io by satyamchaudharydev */
            .form {
                --width-of-input: 100%;
                --border-height: 1px;
                --border-before-color: rgba(221, 221, 221, 0.39);
                --border-after-color: #5891ff;
                --input-hovered-color: #4985e01f;
                position: relative;
                width: var(--width-of-input);
            }
            /* styling of Input */
            .input {
                color: black;
                font-size: 0.9rem;
                background-color: transparent;
                width: 100%;
                box-sizing: border-box;
                padding-inline: 0.5em;
                padding-block: 0.7em;
                border: none;
                border-bottom: var(--border-height) solid var(--border-before-color);
            }
            /* styling of animated border */
            .input-border {
                position: absolute;
                background: var(--border-after-color);
                width: 0%;
                height: 2px;
                bottom: 0;
                left: 0;
                transition: 0.3s;
            }
            /* Hover on Input */
            input:hover {
                background: var(--input-hovered-color);
            }

            input:focus {
                outline: none;
            }
            /* here is code of animated border */
            input:focus ~ .input-border {
                width: 100%;
            }
            /* === if you want to do animated border on typing === */
            /* remove input:focus code and uncomment below code */
            /* input:valid ~ .input-border{
  width: 100%;
} */
        </style>
        <script type="text/javascript">
            window.history.forward();
            function noBack() {
                window.history.forward();
            }
            window.onload = noBack;
            window.onpageshow = function (evt) {
                if (evt.persisted) noBack();
            };
            window.onunload = function () {
                null;
            };
        </script>
    </head>