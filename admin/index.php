<?php include("includes/menu.php"); ?>


        <!-- Main Section Beginning-->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
<br/>
                <?php
                    if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];//Displays message
                        unset($_SESSION['login']);//Removing session message
                    }
                ?><br/>
                <div class="col-4 text-center">
                    <?php
                        //Get query
                        $sql = "SELECT * FROM category";
                        //Execute query
                        $res = mysqli_query($connection, $sql);
                        //Count rows
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br/>
                    Categories
                </div>
                <div class="col-4 text-center">
                    <?php
                        //Get query
                        $sql1 = "SELECT * FROM food";
                        //Execute query
                        $res1 = mysqli_query($connection, $sql1);
                        //Count rows
                        $count1 = mysqli_num_rows($res1);
                    ?>
                    <h1><?php echo $count1; ?></h1>
                    <br/>
                    Foods
                </div>
                <div class="col-4 text-center">
                    <?php
                        //Get query
                        $sql2 = "SELECT * FROM order_tbl";
                        //Execute query
                        $res2 = mysqli_query($connection, $sql2);
                        //Count rows
                        $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2; ?></h1>
                    <br/>
                    Total Orders
                </div>
                <div class="col-4 text-center">
                    <?php

                        //Create sql query to get total revenue generated
                        //Aggregate function in sql
                        $sql3 = "SELECT SUM(total) AS Total FROM order_tbl WHERE status='Delivered'";
                        //Execute query
                        $res3 = mysqli_query($connection, $sql3);
                        //Get values from database
                        $row3 = mysqli_fetch_assoc($res3);
                        //Get total revenue generated
                        $total_revenue = $row3['Total'];

                    ?>
                    <h1>GHC<?php echo $total_revenue; ?></h1>
                    <br/>
                    Revenue Generated
                </div>
                
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Section End-->

<?php include("includes/footer.php"); ?>