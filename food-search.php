<?php include('partials/menu.php');?>



    
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search_title=$_POST['search']; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
                if (isset($_POST['submit'])) {
                    $search_title = $_POST['search'];
                    $sql = "SELECT * FROM tbl_food where title like'%$search_title%' and active = 'yes' AND featured = 'yes'";
                    $res = mysqli_query($conn, $sql);
                    if ($res == true) {
                        $count = mysqli_num_rows($res);
                        if ($count>0) {
                            while ($rows = mysqli_fetch_assoc($res)) {
                                $id = $rows['id'];
                                $title = $rows['title'];
                                $description = $rows['description'];
                                $price = $rows['price'];
                                $image_name = $rows['image_name'];
                                ?>
                                <div class="food-menu-box">
                                    <div class="food-menu-img">
                                        <img src="images/foods/<?php echo $image_name;?>" alt="<?php echo $title;?>" class="img-responsive img-curve">
                                    </div>

                                    <div class="food-menu-desc">
                                        <h4><?php echo $title;?></h4>
                                        <p class="food-price">$<?php echo $price;?></p>
                                        <p class="food-detail">
                                            <?php echo $description;?>
                                        </p>
                                        <br>

                                        <a href="order.php?id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    
                }
            ?>
            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
    <!-- social Section Ends Here -->

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>All rights reserved. Designed By <a href="#">Mohamed Abdiaziz</a></p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>
</html>

<form action="" method="post" enctype="multipart/form-data"></form>