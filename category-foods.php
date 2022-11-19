<?php include('partials/menu.php');
if (!isset($_GET['id'])) {
    # code...
    header('location:'.SITEURL);
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php if(isset($_SESSION['category_title'])){
                echo $_SESSION['category_title'];
            }
            ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_food where category_id = '$id' and active='yes' and featured='yes'";
                $res = mysqli_query($conn,$sql);
                if ($res == TRUE) {
                    # code...
                    $count = mysqli_num_rows($res);
                    if ($count >0) {
                        # code...
                        while ($rows=mysqli_fetch_assoc($res)) {
                            # code...

                            $id = $rows['id'];
                            $_session['id_food']=$id;
                            $title = $rows['title'];
                            $desc = $rows['description'];
                            $price = $rows['price'];
                            $image = $rows['image_name'];
                            ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <img src="images/foods/<?php echo($image);?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title;?></h4>
                                    <p class="food-price">$<?php echo $price;?></p>
                                    <p class="food-detail">
                                        <?php echo $desc;?>
                                    </p>
                                    <br>

                                    <a href="order.php?id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                            <?php

                        }
                    }
                    
                }
            ?>
            

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials/footer.php');?>
