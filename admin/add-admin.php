<?php include('partials/menu.php') ?>
<div class="main-contant">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br />

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }
        ?>
        <br /> <br/>
        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="Full_Name" required placeholder="Enter Full Name">
                    </td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="Username" required placeholder="Enter Username">
                    </td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>
                        <input type="radio" name="role" checked value="Employee">Employee
                        <input type="radio" name="role" value="Manager">Administrator
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    
                    <td><input type="password" required name="Password" placeholder="Enter Password"></td>
                </tr>
                <tr>
                    <td colspan="2"> 
                        <input type="submit" value="Add Admin" name="submit" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>

<?php 

if (isset($_POST['submit'])) {
    $Full_Name = $_POST['Full_Name'];
    $Username = $_POST['Username'];
    $role = $_POST['role'];
    $Password = md5 ($_POST['Password']);

    $sql2 = "SELECT Username FROM tbl_admin Where Username = '$Username'";
    $result = mysqli_query($conn, $sql2);
    $rows = mysqli_fetch_assoc($result);
    $taken = $rows['Username'];
    if ($taken != $Username) {
        $sql = "INSERT INTO tbl_admin SET 
        Full_Name='$Full_Name', 
        Username='$Username', 
        Password='$Password',
        Role = '$role'";
        
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        if ($res==True) {
            # code...
            // echo "Data inserted";
            $_SESSION['add'] = "Admin Added Successfully";
            header("location:".SITEURL.'admin/manage_admin.php');
        }
        else{
            // echo "failed to insert data";
            $_SESSION['add'] = "Failed to Add Admin";
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
    else{
        $_SESSION['add'] = "<div class='error'>Sorry!!. This <a href='#'>@$Username</a> Username Already Taken!!!</div>";
        header("location:".SITEURL.'admin/add-admin.php');
    }

    
}

?>