<?php
    include('partials/menu.php');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_order where id = $id";
        $res = mysqli_query($conn, $sql);
        $rows = mysqli_fetch_assoc($res);
        $qty =$rows['qty'];
        $status = $rows['status'];
        $customer_name = $rows['customer_name'];
        $customer_contact = $rows['customer_contact'];
        $customer_email = $rows['customer_email'];
        $customer_address = $rows['customer_address'];
    }
    else{
        $_SESSION['Select_now'] = "<div class='error'>Select Now!!!</div>";
        header('location:'.SITEURL.'admin/manage_order.php');
    }
?>
<div class="menu-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br>
        <br>
        <?php
            if (isset($_SESSION['updated_order'])) {
                echo $_SESSION['updated_order'];
                unset($_SESSION['updated_order']);
            }
        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Quantity:</td>
                    <td><input type="number" name="qty" value="<?php echo $qty;?>" placeholder="Quantity"></td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status_order">
                            <option value="Delivered" <?php if($status == "Delivered"){echo "selected";}?> >Delivered</option>
                            <option value="On Delivery" <?php if($status == "On Delivery"){echo "selected";}?> >On Delivery</option>
                            <option value="Cancelled" <?php if($status == "Cancelled"){echo "selected";}?> >Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td><input type="text" name="c_name" value="<?php echo $customer_name;?>" placeholder="Customer name"></td>
                </tr>
                <tr>
                    <td>Customer Phone:</td>
                    <td><input type="tel" name="c_tell" value="<?php echo $customer_contact;?>" placeholder="Phone number"></td>
                </tr>
                <tr>
                    <td>Customer Emial:</td>
                    <td><input type="email" name="c_email" value="<?php echo $customer_email;?>" placeholder="Email"></td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td colspan=3><textarea name="c_address" cols="22" rows="3" placeholder="Address"><?php echo $customer_address;?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
            if (isset($_POST['submit'])) {
                $qty = $_POST['qty'];
                $status = $_POST['status_order'];
                $c_name = $_POST['c_name'];
                $c_tell = $_POST['c_tell'];
                $c_email = $_POST['c_email'];
                $c_address = $_POST['c_address'];
                $sql2 = "UPDATE tbl_order SET 
                qty = '$qty', 
                status = '$status',
                customer_name = '$c_name',
                customer_contact = '$c_tell',
                customer_email = '$c_email',
                customer_address = '$c_address'
                where id = '$id'
                ";
                $res2 = mysqli_query($conn, $sql2);
                if ($res2==true) {
                    $_SESSION['updated_order']="<div class='success'>Successfull to update</div>";
                    header('location:'.SITEURL.'admin/manage_order.php');
                }
                else {
                    $_SESSION['updated_order']="<div class='error'>Failed to update</div>";
                }
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php');?>