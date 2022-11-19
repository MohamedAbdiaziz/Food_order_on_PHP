<?php 

    if (!isset($_SESSION['user'])) {
        # code...
       
        $_SESSION['no-login-ms'] = "<div class='error text-center'>Please login to access Admin Panel.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }


?>