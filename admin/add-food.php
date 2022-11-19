<?php include("./partials/menu.php"); ?>
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
                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
<?php
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $price = $_POST['price'];
        if (isset($_FILES['images']['name'])) {
            $image_name = $_FILES['images']['name'];
            $ext = end(explode('.', $image_name));
            $image_name = "Food_".$title."_".rand(000,999).'.'.$ext;
            $image_path = $_FILES['images']['tmp_name'];
            
            $destination_path = '../images/foods/'.$image_name;
            // echo($destination_path);
            $upload = move_uploaded_file($image_path, $destination_path);
            echo($upload);

            if ($upload==0) {
                $_SESSION['upload_image_food'] = "<div class='error'>failed to upload image </div>";
                header('location:'.SITEURL.'admin/add-food.php');
                die();
            }
        }
        else{
            $image_name = "";
        }
        $category_id = $_POST['category'];
        echo $category_id;
        if(isset($_POST['feature'])){
            $feature = $_POST['feature'];
        }
        else{
            $feature = "no";
        }
        if(isset($_POST['active'])){
            $active = $_POST['active'];
        }
        else{
            $active = "no";
        }

        #insert into db
        $sql = "INSERT into tbl_food  set 
            title = '$title',
            description = '$desc',
            price = '$price',
            image_name = '$image_name',
            category_id = '$category_id',
            featured = '$feature',
            active = '$active'
        ";
        $res1 = mysqli_query($conn,$sql);
        if($res1 == true){
            $_SESSION['add_food'] =  "<div class='success'>New food added</div>";
            header('location:'.SITEURL.'admin/manage_Food.php');
        }
        else{
            $_SESSION['add_food'] = "<div class='error'>failed to add New food </div>";
            header('location:'.SITEURL.'admin/add-food.php');
        }
    }



?>


<?php include("./partials/footer.php"); ?>