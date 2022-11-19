<?php include('partials/menu.php') ?>
<div class="menu-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <?php
            if (isset($_SESSION['add_category'])) {
                echo $_SESSION['add_category'];
                unset ($_SESSION['add_category']);
            }
             if (isset($_SESSION['noget'])) {
                echo $_SESSION['noget'];
                unset ($_SESSION['noget']);
            }
             if (isset($_SESSION['queryfailed'])) {
                echo $_SESSION['queryfailed'];
                unset ($_SESSION['queryfailed']);
            }
            if (isset($_SESSION['delete-category'])) {
                echo $_SESSION['delete-category'];
                unset ($_SESSION['delete-category']);
            }
            if (isset($_SESSION['first_add_category'])) {
                echo $_SESSION['first_add_category'];
                unset ($_SESSION['first_add_category']);
            }
            if (isset($_SESSION['updated_order'])) {
                echo $_SESSION['updated_order'];
                unset($_SESSION['updated_order']);
            }
        ?>
        <br><br>

           
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Images</th>
                    <th>Feature</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php 
                    
                    $sql = "SELECT * FROM tbl_category";
                    $res = mysqli_query($conn, $sql);
                    if ($res == true) {
                        // code...
                        $count = mysqli_num_rows($res);
                        if ($count >0) {
                            $S_N = 1;
                            // code...
                            while($rows = mysqli_fetch_assoc($res)){
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $image = $rows['image_name'];
                                $featured = $rows['featured'];
                                $active = $rows['active'];
                                ?>
                                    <tr>
                                        <td> <?php echo $S_N++; ?> </td>
                                        <td><?php echo $title; ?></td>
                                        <td>
                                            <?php 
                                                if ($image == "") {
                                                    // code...
                                                    echo "<div class='error'>No image</div>";
                                                }
                                                else{
                                                    ?>

                                                    <img src="../images/category/<?php echo $image; ?>" width="100px">
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td> <?php echo $active; ?> </td>
                                        <td>
                                            <a href="<?php echo SITEURL ?>admin/update_category.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a> 
                                            <a href="<?php echo SITEURL ?>admin/delete-category.php?id=<?php echo $id; ?>&image=<?php echo $image; ?>" class="btn-danger">Delete Admin</a> 
                                            
                                        </td>
                                    </tr>


                                <?php
                            }
                        }
                        else{
                            ?>
                            <tr>
                                <td colspan="9" class="error text-center">no category found!!!!</td>
                            </tr>
                            <?php
                        }
                    }


                ?>


                
            </table>
    </div>
</div>

<?php include('partials/footer.php') ?>