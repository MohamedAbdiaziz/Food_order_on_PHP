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
                            $role= $rows['Role'];
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
                        <td>Role</td>
                        <td>
                            <input type="radio" <?php if($role == "Employee"){echo "checked";} ?> name="role" value="Employee">Employee
                            <input type="radio" name="role" <?php if($role == "Manager"){echo "checked";} ?> value="Manager">Administrator
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

    $user = $_SESSION['user'];
    $title_action = "Updated Admin";
    date_default_timezone_set('Africa/Mogadishu');
    $date = date('y-m-d H:i:s');
    


    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        $full_name = $_POST['Full_Name'];
        $username = $_POST['Username'];
        $Role = $_POST['role'];

        $Description = "Updated[ID]=$id where username updated to $username, Full name updated to $full_name and Role updated to $Role the date was $date.";  

        $sql = "UPDATE tbl_admin SET 
            Full_name = '$full_name',
            Username = '$username',
            Role = '$Role'
            WHERE ID = '$id'
            ";
        $res = mysqli_query($conn, $sql);
        if($res == true){
            $div = "<div class='success'>";
            $cdiv = "</div>";
            $_SESSION['update'] = "$div Admin Deleted $cdiv";

            $sql1 = "INSERT into tbl_admin_report_update_and_delete_and_add set 
            Action_Title = '$title_action',
            Date = '$date',
            Action_user = '$user',
            Description_action = '$Description'";
            $result = mysqli_query($conn, $sql1);

            header('location:'.SITEURL.'admin/manage_admin.php');
        }
        else{
            $_SESSION['update'] = "<div class='error'>Failed to delete Admin. Try Again Later.</div>";
            header('location:'.SITEURL.'admin/manage_admin.php');
        }
    }

?>

<?php include('partials/footer.php') ?>
