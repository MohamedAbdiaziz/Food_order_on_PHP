<?php include('config/configration.php');?>



<?php


        if (isset($_POST['submit'])) {
            # code...
            $food_name = " ";
            $food_price = " ";
            $qty = $_POST['qty'];
            $costumer_name = $_POST['full-name'];
            $costumer_phone = $_POST['contact'];
            $costumer_email = $_POST['email'];
            $costumer_addr = $_POST['address'];
            date_default_timezone_set('Africa/Mogadishu');
            $date = date('y-m-d H:i:s');
            
            $total = $qty * $price;
            // query
            $sql2 = "INSERT into tbl_order set
            food = '$food_name',
            price = '$food_price',
            qty = '$qty',
            total = '$ total',
            order_date = '$date',
            status = 'yes',
            customer_name = '$costumer_name',
            customer_contact = '$costumer_phone',
            customer_email = '$costumer_email',
            customer_address = '$costumer_addr'
            ";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == true) {
                # code...
                echo "hello";
                $_SESSION['order_success']="<div class='success'>Successfuly your order!!:)</div>";
                header('location:'.SITEURL);
            }
            else{
                $_SESSION['order_success']="<div class='error'>Successfuly your order!!:)</div>";
            }
        }
    ?>