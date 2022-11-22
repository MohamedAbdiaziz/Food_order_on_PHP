<?php include('partials/menu.php'); ?>
<div class="menu-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br/>
        <br/>
        <?php 
        if(isset($_GET['id'])){
            $id = $_GET['id'];
        }
        else{
            $div = "<div class='error'>";
            $cdiv = "</div>";
            $_SESSION['change-password'] = "$div sorry select only  $cdiv";
            header('location:'.SITEURL.'admin/manage_admin.php');
        }
            

        ?>
        <?php 
            if(isset($_POST['submit'])){
                $id = $id;

                $user = $_SESSION['user'];
                $title_action = "Password Changed Admin";
                date_default_timezone_set('Africa/Mogadishu');
                $date = date('y-m-d H:i:s');

                $old_password = md5($_POST['old_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);
                $cf = $_POST['confirm_password'];
                
                $Description = "Changed the password of ID $id to $cf the date was $date";
                
                $sql = "SELECT * FROM tbl_admin WHERE ID = '$id'";
                $res = mysqli_query($conn, $sql);
                if($res == true){
                    $rows = mysqli_fetch_assoc($res);
                    if ($new_password == $confirm_password and $old_password==$db_pass = $rows['Password']) {
                        $sql2 = "UPDATE tbl_admin set Password='$new_password' where ID = '$id'";
                        $res2 = mysqli_query($conn, $sql2);
                        if ($res2 = TRUE) {
                            $div = "<div class='success'>";
                            $cdiv = "</div>";
                            $_SESSION['change-password'] = "$div Password Changed $cdiv";
                            
                            $sql1 = "INSERT into tbl_admin_report_update_and_delete_and_add set 
                            Action_Title = '$title_action',
                            Date = '$date',
                            Action_user = '$user',
                            Description_action = '$Description'";
                            $result = mysqli_query($conn, $sql1);
            
                            header('location:'.SITEURL.'admin/manage_admin.php');
                        }
                        else{
                            $_SESSION['change-password'] = "<div class='error'>Failed to Change Admin Password. Try Again Later.</div>";
                            header('location:'.SITEURL.'admin/manage_admin.php');
                        }
                        
                    }
                    else{
                        if($new_password != $confirm_password){
                            if($old_password!=$db_pass = $rows['Password']){
                                echo "<div class='error'>Old Passwor is Wrong<br/> And Password not match. Try Again.</div>";
                            }
                            else{
                                echo "<div class='error'>Password not match. Try Again.</div>";
                            }
                            
                        }else{
                            echo "<div class='error'>Old Password is wrong.</div>";
                        }
                        
                    }
                }
                else{
                    $_SESSION['Not-Found'] = "<div class='error'>Not Found. Try Again Later.</div>";
                    header('location:'.SITEURL.'admin/manage_admin.php');
                }
            }

        ?>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Old Password:</td>
                    <td><input type="password" name="old_password" placeholder="Old Password"></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Password" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>
<?php include('partials/footer.php'); ?>
