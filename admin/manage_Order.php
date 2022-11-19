<?php include('partials/menu.php') ?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> 

<?php
    $url1=$_SERVER['REQUEST_URI'];
    header("Refresh: 10; URL=$url1");
?>

<div class="menu-content">
    <div class="wrapper">
        <h1>Manage Order</h1>     
            <br><br>
            <?php
                if (isset($_SESSION['Select_now'])) {
                    echo $_SESSION['Select_now'];
                    unset($_SESSION['Select_now']);
                }
                if (isset($_SESSION['updated_order'])) {
                    echo $_SESSION['updated_order'];
                    unset($_SESSION['updated_order']);
                }
            ?>
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>S.N.</th>
                        <th>Food Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>name</th>
                        <th>Phone</th>
                        <th>email</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT *FROM tbl_order ORDER BY `tbl_order`.`status` DESC";
                        $res = mysqli_query($conn, $sql);
                        if ($res == true) {
                            $count = mysqli_num_rows($res);
                            $sn = 1;
                            if ($count>0) {
                                while ($rows = mysqli_fetch_assoc($res)) {
                                    $id = $rows['id'];
                                    $food_name = $rows['food'];
                                    $price = $rows['price'];
                                    $qty = $rows['qty'];
                                    $total = $rows['total'];
                                    $order_date = $rows['order_date'];
                                    $status = $rows['status'];
                                    $customer_contact = $rows['customer_contact'];
                                    $customer_name = $rows['customer_name'];
                                    $customer_email = $rows['customer_email'];
                                    $customer_address = $rows['customer_address'];
                                    
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++;?></td>
                                        <td><?php echo $food_name;?></td>
                                        <td>$<?php echo $price;?></td>
                                        <td><?php echo $qty;?></td>
                                        <td>$<?php echo $total;?></td>
                                        <td><?php echo $order_date;?></td>
                                        <td>
                                            <?php
                                                if ($status == "Delivered") {
                                                    echo "<div class='badge bg-success rounded-pill d-inline'>$status</div>";
                                                }
                                                if($status == "On Delivery"){
                                                    echo "<div class='badge bg-primary badge-success rounded-pill d-inline'>$status</div>";
                                                }
                                                if($status == "Cancelled"){
                                                    
                                                    echo "<div class='badge bg-error badge-warning rounded-pill d-inline'>$status</div>";
                                                    
                                                }
                                                
                                            ?>
                                        </td>
                                        <td><?php echo $customer_name;?></td>
                                        <td><?php echo $customer_contact;?></td>
                                        <td><?php echo $customer_email;?></td>
                                        <td><?php echo $customer_address;?></td>                                    
                                        <td>
                                            <a href="update_order.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>                                         
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                        }
                        else{
                            echo "connection Failed";
                        }
                    ?>
                </tbody>
                
                
            </table>
    </div>
</div>

<?php include('partials/footer.php') ?>