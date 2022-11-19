<?php include('./partials/menu.php');?>



    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

            

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                if (isset($_SESSION['sucess_order'])) {
                    # code...
                    echo $_SESSION['sucess_order'];
                    unset($_SESSION['sucess_order']);
                }
                if(isset($_SESSION['order_success'])){
                    echo $_SESSION['order_success'];
                    unset($_SESSION['order_success']);
                }

            ?>
            <script>
                let popup = document.getElementById("popup");
                function openPopup(){
                    popup.classList.add("open-popup");
                }
                function closePopup(){
                    popup.classList.remove("open-popup");
                }

            </script>
            <?php 
                $sql = "SELECT * FROM tbl_category where active='yes' and featured='yes' limit 3";
                $res = mysqli_query($conn,$sql);
                if ($res==TRUE) {
                    # code...
                    $count = mysqli_num_rows($res);
                    if ($count>0) {
                        # code...
                        while ($rows=mysqli_fetch_assoc($res)) {
                            # code...
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $_SESSION['category_title'] = $title;
                            $image = $rows['image_name'];
                            ?>
                            <a href="category-foods.php?id=<?php echo $id?>">
                                <div class="box-3 float-container">
                                    <img src="images/category/<?php echo $image;?>" alt="<?php echo$title;?>" class="img-responsive img-curve">

                                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                </div>
                            </a>
                            <?php
                        }

                    }
                    else{
                        echo "no category";
                    }
                }
            ?>
            


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
                $sql = "SELECT * from tbl_food where featured='yes' and active='yes' limit 4";
                $res = mysqli_query($conn, $sql);
                if($res==true){
                    $count = mysqli_num_rows($res);
                    if($count>0){
                        while($rows = mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $desc = $rows['description'];
                            $image_name = $rows['image_name'];
                            $price = $rows['price'];

                            ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($image_name==""){
                                            echo "image not available";
                                        }
                                        else{
                                            ?>
                                                <img src="images/foods/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title; ?></h4>
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

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('./partials/footer.php');?>