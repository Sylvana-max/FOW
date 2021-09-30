<?php include('includes/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Orders Here</h1>
        <br>
         
        <?php
            //Check whether or not id is set
            if(isset($_GET['id'])){
                //Get Order's details
                $id = $_GET['id'];
                //SQL query to get order details
                $sql = "SELECT * FROM order_tbl WHERE id=$id";
                //Execute Query
                $res = mysqli_query($connection, $sql);
                //Count rows
                $count = mysqli_num_rows($res);

                if($count==1){
                    //Data available
                    $row = mysqli_fetch_assoc($res);
                       
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_address = $row['customer_address'];
                    $food = $row['food'];
                    $qty = $row['qty'];
                    $price = $row['price'];
                    $status = $row['status'];
                }else{
                    //Data not available
                    //Redirect
                    header('location:'.SITEURL.'admin/order.php');
                }
            }else{
                //Redirect to order management page
                header('location:'.SITEURL.'admin/order.php');
            }

        ?>
        <form action="" method="POST" class="tbl-30">

            <div class="form-group">
                <label for="food-name">Food Name: </label>
                <b><?php echo $food; ?></b>
            </div>

            <div class="form-group">
                <label for="price">Price: </label>
                <b>GHC<?php echo $price; ?></b>
            </div>

            <div class="form-group">
                <label for="qty">Quantity: </label>
                <input type="number" class="form-control" name="qty" value="<?php echo $qty; ?>">
            </div>

            <div class="form-group">
                <label for="full-name">Full Name: </label>
                <input type="text" class="form-control" name="full-name" value="<?php echo $customer_name; ?>">
            </div>

            <div class="form-group">
                <label for="contact">Customer's Contact: </label>
                <input type="text" class="form-control" name="contact" value="<?php echo $customer_contact; ?>">
            </div>

            <div class="form-group">
                <label for="address">Customer's Address: </label>
                <input type="text" class="form-control" name="address" value="<?php echo $customer_address; ?>">
            </div>

            <div class="form-group">
                <label for="status">Status: </label>
                    <select name="status">
                        <option class="Ordered" <?php if($status=="Ordered"){echo "selected"; } ?> value="Ordered">Ordered</option>
                        <option class="On-Delivery" <?php if($status=="On Delivery"){echo "selected"; } ?> value="On Delivery">On Delivery</option>
                        <option class="Delivery" <?php if($status=="Delivered"){echo "selected"; } ?> value="Delivered">Delivered</option>
                        <option class="Cancelled" <?php if($status=="Cancelled"){echo "selected"; } ?> value="Cancelled">Cancelled</option>
                    </select>  
            </div>

            <div class="form-group">   
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update Order" class="btn-secondary">
            </div>

        </form>

        <?php
            //check whether or not button is clicked
            if(isset($_POST['submit'])){
                //Get all values from form
                $id = $_POST['id'];
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_address = $_POST['address'];
                $qty = $_POST['qty'];
                $total = $qty * $price;
                $status= $_POST['status'];

                //Update into order_tbl
                $sql2 = "UPDATE order_tbl SET
                qty = $qty,
                total = $total,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_address = '$customer_address'
                WHERE id = $id";

                //Execute query
                $res2 = mysqli_query($connection, $sql2);

                //Check whether or not query is executed
                if($res2==true){
                    //Query updated
                    $_SESSION['updated'] = "<div class='success text-center'>Order Updated Successfully.</div>";
                    //Redirect
                    header('location:'.SITEURL.'admin/order.php');
                }else{
                    //Failed to update message
                    $_SESSION['updated'] = "<div class='error text-center'>Order Updated Unsuccessfully.</div>".mysqli_error($connection);
                    //Redirect
                    header('location:'.SITEURL.'admin/order.php');
                }
            }
        ?>
    </div>
</div>


<?php include('includes/footer.php'); ?>