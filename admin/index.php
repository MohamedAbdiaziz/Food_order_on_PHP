
<?php include('partials/menu.php'); ?>
<?php
    $url1=$_SERVER['REQUEST_URI'];
    header("Refresh: 5; URL=$url1");
?>

    <!-- menu-content section -->
    <div class="menu-content">
        <?php
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            $query = "SELECT * FROM tbl_admin WHERE Username = '$user'";
            $result = mysqli_query($conn,$query);
            $rows = mysqli_fetch_assoc($result);
            $fullname = $rows['Full_name'];
            $role = $rows['Role'];
            echo $fullname;
            
        }
        
        ?>
        <div class="wrapper">
        <?php if (isset($_SESSION['login'])) {
            # code...
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        } ?> <br/> <br/>
            <h1>DASHBOARD</h1>
            <div class="col-4 text-center">
                <?php
                    $sql = "SELECT * FROM tbl_category where active='yes' and featured = 'yes'";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    
                ?>
                <h1><?php echo $count;?></h1>
                <br>
                category
            </div>

            <div class="col-4 text-center">
                <?php
                    $sql1 = "SELECT * FROM tbl_food where active='yes' and featured = 'yes'";
                    $res1 = mysqli_query($conn, $sql1);
                    $count1 = mysqli_num_rows($res1);
                    
                ?>
                <h1><?php echo $count1;?></h1>
                <br>
                Foods
            </div>

            <div class="col-4 text-center">
                <?php
                    date_default_timezone_set('Africa/Mogadishu');
                    $date = date('y-m-d');
                    $sql2 = "SELECT * FROM tbl_order where status='On Delivery' AND order_date LIKE '%$date%'";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                    
                ?>
                <h1><?php echo $count2;?></h1>
                <br>
                On Delivery
            </div>

            <div class="col-4 text-center">
                <?php
                    $sql3 = "SELECT SUM(total) total FROM tbl_order where status='Delivered'";
                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_fetch_assoc($res3);
                    $total = $count3['total'];
                    
                ?>
                <h1>$<?php echo $total;?></h1>
                <br>
                Revenue
            </div>

            
            <div class="clear-fix"></div>
        </div>
    </div>
    <!-- end section  -->
    <?php include('partials/footer.php'); ?>