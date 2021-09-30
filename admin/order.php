<?php include("includes/menu.php"); ?>

        <!-- Main Section Beginning-->
        <div class="main-content">
            <div class="wrapper">

                <h1 class="text-center">Order Management Page</h1>
                <br/>
                <?php

                    if(isset($_SESSION['updated'])){
                        echo $_SESSION['updated'];//Displays message
                        unset($_SESSION['updated']);//Removing session message
                    }

                ?>
                <br>

                <table class="tbl-full">
                    <tr>
                        <th>Id</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>QTY</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                        //Get all orders from database
                        $sql = "SELECT * FROM order_tbl ORDER BY id DESC";
                        //Execute query
                        $res = mysqli_query($connection, $sql);
                        //Count the rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //serial number

                        if($count>0){
                            //Order available
                            while($row = mysqli_fetch_assoc($res)){
                                //Get Order Values
                                $id = $row['id'];
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $food; ?></td>
                                        <td><?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <td><?php echo $order_date; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update_order.php?id=<?php echo $id; ?>" class="btn-secondary">Update</a>
                                            
                                        </td>
                                    </tr>

                                <?php
                            }
                        }else{
                            //Order not available
                            echo "<tr><td colspan='12' class='error'>Order(s) Not Available</td></tr>";
                        }
                    ?>
                </table>
    
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Section End-->

<?php include("includes/footer.php"); ?>