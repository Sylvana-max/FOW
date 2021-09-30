<?php include("includes/menu.php"); ?>

<?php
    //Check whether or not food id is set
    if(isset($_GET['food_id'])){
        //Get the food id and details 
        $food_id = $_GET['food_id'];
        //Get details
        $sql = "SELECT * FROM food WHERE id=$food_id";
        //echo $sql; die();
        //Execute query
        $res = mysqli_query($connection, $sql);
        //Count rows
        $count = mysqli_num_rows($res);
        //Check whether or not data is available
        if($count==1){
            //We have data
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }else{
            //Data not available
            echo "<div class='error text-center'>Food Not Available</div>";
            //Redirect to home page
            header('location:'.SITEURL);
        }
    }else{
        //Redirect to home page
        header('location:'. SITEURL);
    }
?>
    <!-- Food Search Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order" enctype="multipart/form-data">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                    <?php
                        //Check whether or not image is available
                        if($image_name==""){
                            //Display message
                            echo "<div class='error text-center'>Food Not Available</div>";
                        }else{
                            //Image Available
                    ?>
                            <img src="<?php echo SITEURL; ?>images/Food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                            <?php
                        }
                            ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <p class="food-price">GHC<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Sylvana Adusei" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. +233xxxxxxxxx OR 024xxxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. sylvana@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php

            //Check whether or not button is clicked
            if(isset($_POST['submit'])){
                //Get all the details from database
                
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty; //Calculates the total price
                $order_date = date("d m Y H:i:s"); //Displays the date and time purchase is made
                $status = "Ordered";
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                //Saves the order in database
                //Create sql to save data
                $sql2 = "INSERT INTO order_tbl SET
                    
                    food = '$food',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = now(),
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact ='$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'";

                    //echo $sql2; die();
                    //Execute the query
                    $res2 = mysqli_query($connection, $sql2);
                    
                    //Check whether or not query is executed
                    if($res2!=false){
                        //Query executed successfully
                        $_SESSION['order'] = "<div class='success text-center'>Thank you for ordering from us.</div>";
                        header("location:".SITEURL);
                    }
                    else{
                        //Failed. Redirect to order page
                        $_SESSION['order'] = "<div class='error text-center'>Sorry, your order was unsuccessful.</div>".mysqli_error($connection);
                        header("location:".SITEURL.'order.php');
                    }
            }

            ?>
        </div>
    </section>
    
    <!-- fOOD sEARCH Section Ends Here -->

<?php include("includes/footer.php"); ?>