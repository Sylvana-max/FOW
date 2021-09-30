<?php include("includes/menu.php"); ?>

        <!-- Main Section Beginning-->
        <div class="main-content">
            <div class="wrapper">

                <h1 class="text-center">Food Management Page</h1>
                <br/><br/>
                <!-- Button to Add Food -->
                <a href="<?php echo SITEURL; ?>admin/add_food.php" class="btn-primary">Add Food</a>
                <br/><br/>

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

                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];//Displays message
                        unset($_SESSION['upload']);//Removing session message
                    }

                    if(isset($_SESSION['failed-remove'])){
                        echo $_SESSION['failed-remove'];//Displays message
                        unset($_SESSION['failed-remove']);//Removing session message
                    }

                ?>
                <table class="tbl-full">
                    <tr>
                        <th>I.D</th>
                        <th>TITLE</th>
                        <th>PRICE</th>
                        <th>IMAGE NAME</th>
                        <th>FEATURED</th>
                        <th>ACTIVE</th>
                        <th>ACTIONS</th>
                    </tr>

                    <?php

                        //Query to get data from database
                        $sql = "SELECT * FROM food";

                        //Execute query
                        $res = mysqli_query($connection, $sql);

                        //count rows
                        $count = mysqli_num_rows($res);

                        $sn = 1;

                        //Check whether or not 
                        if($count>0){
                            //Data is in database
                            //Get data and display
                            while($row=mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active= $row['active'];

                                ?>
                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td>
                                        <?php 
                                            //Check whether or not image is available
                                            if($image_name != ""){
                                                //Display image
                                        ?>
                                                <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name; ?>&image_name=<?php echo $image_name; ?>" width="100px">;
                                                <?php
                                            }else{
                                                //Display the error message
                                                echo "<div class='error text-center'>No Image Here.</div>";  
                                            }
                                                ?>
                                        </td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update_food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete_food.php?id=<?php echo $id; ?>" class="btn-danger">Delete Food</a>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }else{
                            //There is no data in the database
                            ?>

                            <!-- <tr>
                                <td colspan="6"><div class="error">No Category Added.</div></td>
                            </tr> -->
                            <?php
                        }

                    ?>
                </table>
    
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Section End-->

<?php include("includes/footer.php"); ?>