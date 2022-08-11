<?php
    include('../config/configration.php');

    $id = $_GET['id'];

    $sql = "DELETE FROM tbl_admin WHERE ID = $id";

    $res = mysqli_query($conn, $sql);

    if($res == true){
        $div = "<div class='success'>";
        $cdiv = "</div>";
        $_SESSION['delete'] = "$div Admin Deleted $cdiv";
        header('location:'.SITEURL.'admin/manage_admin.php');
    }
    else{
        $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage_admin.php');
    }
?>