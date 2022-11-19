
<?php include('partials/menu.php'); ?>
<div class="menu-content">

    <div class="wrapper">
        <h1>Add Category</h1>
        <?php
            if (isset($_SESSION['add_category'])) {
                echo $_SESSION['add_category'];
                unset ($_SESSION['add_category']);
            }
            if (isset($_SESSION['upload_image_category'])) {
                echo $_SESSION['upload_image_category'];
                unset ($_SESSION['upload_image_category']);
            }
        ?>

        <!-- ========== Start form ========== -->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>title:</td>
                    <td><input type="text" name="title" placeholder="enter title"></td>
                </tr>
                <tr>
                    <td>Add Image:</td>
                    <td><input type="file"  name="images"></td>
                </tr>
                <tr>
                    <td>feature:</td>
                    <td>
                        <input type="radio" name="featureyon" value="yes">yes
                        <input type="radio" name="featureyon" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="a_yes" value="yes">yes
                        <input type="radio" name="a_yes" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        
        <!-- ========== End form ========== -->
    </div>

</div>

<?php include('partials/footer.php'); ?>


<?php


    if (isset($_POST['submit'])) {
        $title = $_POST['title'];

        if (isset($_FILES['images']['name'])) {
            $image_name = $_FILES['images']['name'];
            $ext = end(explode('.', $image_name));
            $image_name = "Food_".$title."_".rand(000,999).'.'.$ext;
            $image_path = $_FILES['images']['tmp_name'];
            
            $destination_path = '../images/category/'.$image_name;
            // echo($destination_path);
            $upload = move_uploaded_file($image_path, $destination_path);
            echo($upload);

            if ($upload==0) {
                $_SESSION['upload_image_category'] = "<div class='error'>failed to upload image </div>";
                header('location:'.SITEURL.'admin/add-category.php');
                die();
            }
        }
        else{
            $image_name = "";
        }

        if (isset($_POST['featureyon'])) {
            $feature = $_POST['featureyon'];
        }
        else{
            $feature = "No";
        }

        if (isset($_POST['a_yes'])) {
            $active = $_POST['a_yes'];
        }
        else{
            $active = "No";
        }
        
        # code...
        $sql = "INSERT INTO tbl_category SET 
            title = '$title',
            image_name='$image_name', 
            featured='$feature', 
            active='$active'
        ";
        $res = mysqli_query($conn, $sql);
        if ($res == True) {
            $_SESSION['add_category'] =  "<div class='success'>New category added</div>";
            header('location:'.SITEURL.'admin/manage_category.php');
        }
        else{
            $_SESSION['add_category'] = "<div class='error'>failed to add New category </div>";
            header('location:'.SITEURL.'admin/add-category.php');
        }
    }


?>