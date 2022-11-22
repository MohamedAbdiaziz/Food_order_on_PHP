<?php
    include('../config/configration.php');
    include('partials/login_check.php');
    
    $id = $_GET['id'];
    
    $user = $_SESSION['user'];
    $title_action = "Deleted Admin";
    date_default_timezone_set('Africa/Mogadishu');
    $date = date('y-m-d H:i:s');
    $Description = "Delelted by ID $id the date was $date";    

    $sql = "DELETE FROM tbl_admin WHERE ID = $id";

    $res = mysqli_query($conn, $sql);

    if($res == true){
        $div = "<div class='success'>";
        $cdiv = "</div>";
        $_SESSION['delete'] = "$div Admin Deleted $cdiv";

        $sql1 = "INSERT into tbl_admin_report_update_and_delete_and_add set 
        Action_Title = '$title_action',
        Date = '$date',
        Action_user = '$user',
        Description_action = '$Description'";
        $result = mysqli_query($conn, $sql1);

        header('location:'.SITEURL.'admin/manage_admin.php');
    }
    else{
        $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage_admin.php');
    }
?>