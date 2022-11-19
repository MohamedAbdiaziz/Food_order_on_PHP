<?php include('partials/menu.php');?>
<div class="menu-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <?php
            if(isset($_SESSION['add_food'])){
                echo $_SESSION['add_food'];
                unset($_SESSION['add_food']);
            }
            if(isset($_SESSION['remove_img'])){
                echo $_SESSION['remove_img'];
                unset($_SESSION['remove_img']);
            }
            if(isset($_SESSION['food_delete'])){
                echo $_SESSION['food_delete'];
                unset($_SESSION['food_delete']);
            }
        ?>
        <br><br>
           
            <a href="<?php echo SITEURL ?>admin/add-food.php" class="btn-primary">Add Food</a>
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Food Name</th>
                    <th>Image</th>
                    <th>description</th>
                    <th>Price</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>
                <?php
                    $sql = "SELECT * FROM tbl_food ORDER BY active DESC;";
                    $res = mysqli_query($conn,$sql);
                    $s_n = 1;
                    if($res == true){
                        $count = mysqli_num_rows($res);
                        if($count>0){
                            while($row = mysqli_fetch_assoc($res)){
                                $ID = $row['id'];
                                $TITLE = $row['title'];
                                $DESC = $row['description'];
                                $IMG = $row['image_name'];
                                $price = $row['price'];
                                $act = $row['active'];
                                $featre = $row['featured'];
                                ?>
                                <tr>
                                  
                                    <td><?php echo $s_n++;?></td>
                                    <td><?php echo $TITLE; ?></td>
                                    <td>
                                        <?php
                                            if($IMG==""){
                                                echo "<div class='error'>no image</div>";
                                            }
                                            else{
                                                ?>
                                                    <img src="../images/foods/<?php echo $IMG;?>" width=50>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $DESC;?></td>
                                    <td>$<?php echo $price;?></td>
                                    <td><?php echo $featre;?></td>
                                    <td><?php echo $act;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL ?>admin/update_food.php?id=<?php echo $ID; ?>&img=<?php echo $IMG; ?>" class="btn-secondary">Update Admin</a> 
                                        <?php
                                            if($act=="no"){
                                                ?>
                                                <a href="<?php echo SITEURL ?>admin/delete_food.php?id=<?php echo $ID; ?>&img=<?php echo $IMG; ?>&act=<?php echo $act;?>" class="btn-danger">Active food</a> 
                                                <?php
                                            }
                                            else {
                                                # code...
                                                ?>
                                                <a href="<?php echo SITEURL ?>admin/delete_food.php?id=<?php echo $ID; ?>&img=<?php echo $IMG; ?>&act=<?php echo $act;?>" class="btn-danger">Deactive food</a> 
                                                <?php
                                            }
                                        ?>
                                        
                                        
                                    </td>
                                </tr>

                                <?php
                            }
                            
                        }else{
                            ?>
                            <tr>
                                <td colspan="9" class="error text-center">no food found!!!!</td>
                            </tr>
                            <?php
                        }

                    }
                ?>
                
            </table>
    </div>
</div>

<?php include('partials/footer.php') ?>