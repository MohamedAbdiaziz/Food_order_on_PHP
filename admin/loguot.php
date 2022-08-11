<?php 
    include('../config/configration.php');

    session_destroy();

    header('location'.SITEURL.'admin/login.php')



?>