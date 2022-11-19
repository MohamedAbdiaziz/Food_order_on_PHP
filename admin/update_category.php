<?php
    include('partials/menu.php');
    $id = $_GET['id'];
    echo $id;
?>
<?php
    if(!isset($_GET['id'])){
        $_SESSION['noget'] = "<div class='error'>sorry, Click the category's delete button that you want to delete</div>";
		header("location:".SITEURL."admin/manage_category.php");
        
    }
    else{
		$id = $_GET['id'];
        $sql = "SELECT * FROM tbl_category WHERE id = '$id'";
        $res = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($res);
        ///
        $title = $rows['title'];
        $current_image = $rows['image_name'];
        $featured= $rows['featured'];
        $active = $rows['active'];
	}
?>

<div class="menu-content">

<div class="wrapper">
    <h1>Update Category</h1>
    <?php
        if (isset($_SESSION['updated_order'])) {
            echo $_SESSION['updated_order'];
            unset($_SESSION['updated_order']);
        }
    ?>

    <!-- ========== Start form ========== -->
    <form action="" method="post" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>title:</td>
                <td><input type="text" value="<?php echo $title;?>" name="title" placeholder="enter title"></td>
            </tr>
            <tr>
                <td>Current Image:</td>
                <td><input type="image" name="current_image" value="<?php echo $current_image;?>" readonly></td>
            </tr>
            <tr>
                <td>Add Image:</td>
                <td><input type="file"  name="images" accept="Image"></td>
            </tr>
            <tr>
                <td>feature:</td>
                <td>
                    <input type="radio" <?php if($featured=="yes"){echo "checked";}?> checked name="featureyon" value="yes">yes
                    <input type="radio" <?php if($featured=="No"){echo "checked";}?> name="featureyon" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input type="radio" <?php if($active=="yes"){echo "checked";}?> name="a_yes" value="yes">yes
                    <input type="radio" <?php if($active=="No"){echo "checked";}?> name="a_yes" value="No">No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>
        </table>
    </form>
    
    <!-- ========== End form ========== -->
</div>

</div>

<?php include('partials/footer.php'); ?>


<?php
    if(isset($_POST['submit'])){
        $title = $_POST['title'];

        /// image
        if (isset($_FILES['images']['name'])) {
            $image_name = $_FILES['images']['name'];
            if($image_name == "")
            {
                $image_name = $current_image;
            }
            else{
                $ext = end(explode('.', $image_name));
                $image_name = "Food_".$title."_".rand(000,999).'.'.$ext;
                $image_path = $_FILES['images']['tmp_name'];
                $destination_path = '../images/category/'.$image_name;
                $upload = move_uploaded_file($image_path, $destination_path);
                if ($upload == 0) {
                    $remove = unlink("../images/category/".$current_image);
                }
            }
            
            
        }
        else {
            $image_name = $current_image;
        }

        // active
        if (isset($_POST['a_yes'])) {
            $active = $_POST['a_yes'];
        }
        else{
            $active = "No";
        }

        /// featured
        if (isset($_POST['featureyon'])) {
            $feature = $_POST['featureyon'];
        }
        else{
            $feature = "No";
        }

        $sql2 = "UPDATE tbl_category SET 
            title = '$title',
            image_name='$image_name', 
            featured='$feature', 
            active='$active'
            where id = '$id'
        ";
        $result = mysqli_query($conn, $sql2);
        if ($result == true) {
            $_SESSION['updated_order']="<div class='success'>Successfull to update</div>";
            header('location:'.SITEURL.'admin/manage_category.php');
        }
        else {
            $_SESSION['updated_order']="<div class='error'>Failed to update</div>";
        }
    }
?>