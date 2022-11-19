<?php include('partials/menu.php');?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                $sql = "SELECT * from tbl_category where featured='yes' and active ='yes'";
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    if ($count >0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $title = $rows['title'];
                            $image_name = $rows['image_name'];
                            ?>
                                <a href="category-foods.php?id=<?php echo $id;?>">
                                    <div class="box-3 float-container">
                                        <img src="images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                                    </div>
                                </a>
                            <?php
                        }
                    }
                    else{
                        echo "<div class='error'>there is no category!!!</div>";
                    }
                }
                else{
                    echo "<div class='error'>connection failed!!!</div>";
                }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->
    <?php include('partials/footer.php');?>