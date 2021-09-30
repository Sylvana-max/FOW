<?php include("includes/menu.php"); ?>


        <!-- Main Section Beginning-->
        <div class="main-content">
            <div class="wrapper">
                
                <h1 class="text-center">Admin Management Page</h1>
                <br/>

                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];//Displays message
                        unset($_SESSION['add']);//Removing session message
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];//Displays message
                        unset($_SESSION['delete']);//Removing session message
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];//Displays message
                        unset($_SESSION['update']);//Removing session message
                    }

                    if(isset($_SESSION['not_found'])){
                        echo $_SESSION['not_found'];//Displays message
                        unset($_SESSION['not_found']);//Removing session message
                    }

                    if(isset($_SESSION['not_matched'])){
                        echo $_SESSION['not_matched'];//Displays message
                        unset($_SESSION['not_matched']);//Removing session message
                    }

                    if(isset($_SESSION['change_password'])){
                        echo $_SESSION['change_password'];//Displays message
                        unset($_SESSION['change_password']);//Removing session message
                    }

                    

                ?>
                <br/><br/><br/>
                <!-- Button to Add Admin -->
                <a href="add_admin.php" class="btn-primary">Add Admin</a>
                <br/><br/>
                <table class="tbl-full">
                    <tr>
                        <th>ID</th>
                        <th>FULL NAME</th>
                        <th>USERNAME</th>
                        <th>ACTIONS</th>
                    </tr>

                    <?php
                    //Query to get all admins
                        $sql = "SELECT * FROM admin";
                    //Exercute the Query
                        $res = mysqli_query($connection, $sql);
                    //Check whether or not the query is exercuted
                        if($res == true){
                            $count = mysqli_num_rows($res);

                            $sn = 1;
                            if($count>0){
                                while($rows = mysqli_fetch_assoc($res)){


                                    $id= $rows['id'];
                                    $full_name= $rows['full_name'];
                                    $username= $rows['username'];
                                    ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/change_password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                        <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>
                                <?php
                                    
                                }
                            }

                        }
                    ?>
                </table>
                
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Section End-->

<?php include("includes/footer.php"); ?>