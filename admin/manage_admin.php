<?php include('partials/menu.php') ?>

    <!-- menu-content section -->
    <div class="menu-content">
        <div class="wrapper">
            <h1>Manage Admin</h1>
            <br />

            <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset ($_SESSION['add']);
                }
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset ($_SESSION['delete']);
                }
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                }
                if(isset($_SESSION['change-password']))
                {
                    echo $_SESSION['change-password'];
                    unset ($_SESSION['change-password']);
                }
                if(isset($_SESSION['Not-Found']))
                {
                    echo $_SESSION['Not-Found'];
                    unset ($_SESSION['Not-Found']);
                }
            ?>
           <br /> <br/>
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br><br>
            <table class="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>


                <?php
                    $sql = "SELECT * FROM tbl_admin";
                    $res = mysqli_query($conn, $sql);
                    if($res == TRUE){
                        $count = mysqli_num_rows($res);
                        if($count>0){
                            while($rows = mysqli_fetch_assoc($res)){
                                $id =$rows['ID'];
                                $full_name = $rows['Full_name'];
                                $username = $rows['Username'];
                                
                                ?>
                                    <tr>
                                        <td><?php echo $id; ?> </td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update_password-admin.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a> 
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a> 
                                            
                                        </td>
                                    </tr>
                                <?php
                               
                            }

                        }
                        else{

                        }
                    }
                ?>
            </table>

            
            <div class="clear-fix"></div>
        </div>
    </div>
    <!-- end section  -->

    <?php include('partials/footer.php'); ?>