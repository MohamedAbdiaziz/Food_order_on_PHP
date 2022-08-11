<?php include('partials/menu.php') ?>
<div class="menu-content">
        <div class="wrapper">
            <h1>Update Admin</h1>
            <br/>
            <br/>
            <?php
                // include('../config/configration.php');

                $id = $_GET['id'];

                $sql = "SELECT * FROM tbl_admin WHERE ID = $id";

                $res = mysqli_query($conn, $sql);
                if($res == TRUE){
                    $count = mysqli_num_rows($res);
                    if($count>0){
                        while($rows = mysqli_fetch_assoc($res)){
                            $id =$rows['ID'];
                            $full_name = $rows['Full_name'];
                            $username = $rows['Username'];
                        }
                    }
                    else{
                        echo "Sorry";
                    }
                }
                
                
            ?>
            <form action="" method="post">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td>
                            <input type="text" name="Full_Name" value="<?php echo $full_name; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td>
                            <input type="text" name="Username" value="<?php echo $username; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"> 
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" value="Update Admin" name="submit" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
</div>

<?php 
    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $full_name = $_POST['Full_Name'];
        $username = $_POST['Username'];

        $sql = "UPDATE tbl_admin SET 
            Full_name = '$full_name',
            Username = '$username'
            WHERE ID = '$id'
            ";
        $res = mysqli_query($conn, $sql);
        if($res == true){
            $div = "<div class='success'>";
            $cdiv = "</div>";
            $_SESSION['update'] = "$div Admin Deleted $cdiv";
            header('location:'.SITEURL.'admin/manage_admin.php');
        }
        else{
            $_SESSION['update'] = "<div class='error'>Failed to delete Admin. Try Again Later.</div>";
            header('location:'.SITEURL.'admin/manage_admin.php');
        }
    }

?>

<?php include('partials/footer.php') ?>
