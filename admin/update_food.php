<?php include('partials/menu.php'); ?>
<?php
    if(isset($_GET['id'])){
        if($_GET['id']==""){
            $_SESSION['noget'] = "<div class='error'>sorry :), which food?????</div>";
		    header("location:".SITEURL."admin/manage_category.php");
        }
        else {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_food WHERE id = '$id'";
            $res = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_assoc($res);

        }
        
    }
    else{
        $_SESSION['noget'] = "<div class='error'>sorry, Click the category's update button that you want to modify</div>";
		header("location:".SITEURL."admin/manage_category.php");
    }
?>

<div class="main-contant">
    <div class="wrapper">
        <h1>Add Food</h1>
        <?php
            if(isset($_SESSION['upload_image_food'])){
                echo $_SESSION['upload_image_food'];
                unset ($_SESSION['upload_image_food']);
            }
            if(isset($_SESSION['add_food'])){
                echo $_SESSION['add_food'];
                unset($_SESSION['add_food']);
            }
        ?>

        <br><br>
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Food Name :</td>
                    <td><input type="text" name="title" placeholder="Name"></td>
                </tr>
                
                <tr>
                    <td>Description Food:</td>
                    <td>
                        <textarea name="desc" cols="30" rows="10" placeholder="Description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="price" name="price" placeholder="price">
                    
                </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="images" placeholder="image"></td>
                </tr>
                <tr>
                    <td>Category ID:</td>
                    <td>
                        <select name="category">
                            <?php
                                $sql_1 = "SELECT id,title FROM tbl_category where featured='yes' and active='yes'";
                                $res = mysqli_query($conn, $sql_1);
                                if($res == true){
                                    $count = mysqli_num_rows($res);
                                    if($count>0){
                                        while($rows = mysqli_fetch_assoc($res)){
                                            $id = $rows['id'];
                                            $title = $rows['title'];
                                            ?>
                                            <option selected value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                            <?php
                                        }
                                    }
                                    else{
                                        $_SESSION['first_add_category'] = "<div class='error'>First add category</div>";
                                        header('location:'.SITEURL.'admin/manage_Category.php');
                                    }
                                }
                                
                            ?>
                        </select>
                        
                    </td>
                </tr>
                <tr>
                    <td>Feature:</td>
                    <td>
                        <input type="radio" checked name="feature" value="yes">yes
                        <input type="radio"  name="feature" value="no">no
                    </td>
                </tr>
                <tr>
                    <td>active:</td>
                    <td>
                        <input type="radio" checked name="active" value="yes">yes
                        <input type="radio" name="active" value="no">no
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

