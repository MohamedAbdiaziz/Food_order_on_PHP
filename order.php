<?php include('partials/menu.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    else{
        header('location:'.SITEURL);
    }
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        
        <div class="container">
            <?php 
                if(isset($_SESSION['order_success'])){
                    echo $_SESSION['order_success'];
                    unset($_SESSION['order_success']);
                }
            ?>
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>
            <form class="order" method="POST" action="">
                <fieldset>
                    <legend>Selected Food</legend>
                    <?php
                        $sql = "SELECT * FROM tbl_food where id='$id'";
                        $res = mysqli_query($conn, $sql);
                        if ($res==TRUE) {
                            # code...
                            $count = mysqli_num_rows($res);
                            if ($count==1) {
                                # code...
                                while ($rows=mysqli_fetch_assoc($res)) {
                                    # code...
                                    $title = $rows['title'];
                                    $img = $rows['image_name'];
                                    $price = $rows['price'];
                                }
                            }
                        }
                    ?>
                    <div class="food-menu-img">
                        <img src="images/foods/<?php echo $img;?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                    </div>
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <p class="food-price">$<?php echo $price;?> x Your Quantity</p>
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Mohamed Abdiaziz" class="input-responsive" required>
                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 2526xxxxxxxx" class="input-responsive" required>
                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@gmail.com" class="input-responsive" required>
                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>
                    <button type="submit" name="submit"  onclick="openPopup()" class="btn btn-primary"> order</button>
                </fieldset>
            </form>
            <?php
                if (isset($_POST['submit'])) {
                    $food_name = $title;
                    $food_price = $price;
                    $qty = $_POST['qty'];
                    $costumer_name = $_POST['full-name'];
                    $costumer_phone = $_POST['contact'];
                    $costumer_email = $_POST['email'];
                    $costumer_addr = $_POST['address'];
                    date_default_timezone_set('Africa/Mogadishu');
                    $date = date('Y-m-d H:i:s');
                    $total = $qty * $price;

                    $sql2 = "INSERT into tbl_order set
                    food = '$food_name',
                    price = '$food_price',
                    qty = '$qty',
                    total = '$total',
                    order_date = '$date',
                    status = 'On Delivery',
                    customer_name = '$costumer_name',
                    customer_contact = '$costumer_phone',
                    customer_email = '$costumer_email',
                    customer_address = '$costumer_addr'
                    ";
                    $res2 = mysqli_query($conn, $sql2);
                    if ($res2 == true) {
                        $_SESSION['order_success']="<div class='popup open-popup' id='popup'>
                        <h2>Thanks You!</h2><p>Your details has been successfully submitted, Delivery in (30)Minutes</p>
                        <button type='button' onclick='closePopup()'>OK</button></div>";
                        header('location:'.SITEURL);
                    }
                    else{
                        $_SESSION['order_success']="<div class='error'>Failed to order!!!</div>";
                    }
                }
            ?>



        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php include('partials/footer.php');?>
    
   