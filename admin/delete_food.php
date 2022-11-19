<?php
    include('../config/configration.php');
    include('partials/login_check.php');
    if(isset($_GET['id']) && isset($_GET['img']) && isset($_GET['act'])){
        if($_GET['id']==""){
            $_SESSION['noget'] = "<div class='error'>sorry :), which food?????</div>";
		    header("location:".SITEURL."admin/manage_category.php");
        }
        else{
            // 1 get ID and Image
            $id = $_GET['id'];
            $img = $_GET['img'];
            $act = $_GET['act'];
            // 2 check images
            // if($img != ""){
            //     $path= "../images/foods/".$img;
            //     $remove = unlink($path);
            //     if($remove==false){
            //         $_SESSION['remove_img'] = "<div class='error'>failed to remove image :<</div>";
            //         header('location:'.SITEURL.'admin/manage_food.php');
            //         die();
            //     }
            // }
            //3 delete image
            
            if($act == "no"){
                $sql = "UPDATE tbl_food SET active = 'yes' where id = '$id'";
            }
            else{
                $sql = "UPDATE tbl_food SET active = 'no' where id = '$id'";
            }
            
            $res = mysqli_query($conn, $sql);
            //check query
            if($res == true){
                $_SESSION['food_delete']="<div class='success'>Food deleted.</div>";
                header('location:'.SITEURL.'admin/manage_food.php');
            }
            else{
                $_SESSION['food_delete']="<div class='success'>zFialed to delete food :<.</div>";
                header('location:'.SITEURL.'admin/manage_food.php');
            }


            //4 redirect
        }
        
    }
    else{
        $_SESSION['noget'] = "<div class='error'>sorry, Click the category's update button that you want to modify</div>";
		header("location:".SITEURL."admin/manage_category.php");
    }
?>
