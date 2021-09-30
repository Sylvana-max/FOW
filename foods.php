<?php include("includes/menu.php"); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //Create SQL Query to display Food from database
                $sql1 = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' LIMIT 6";
                //Execute the Query
                $res1 = mysqli_query($connection, $sql1);
                //Count rows to check whether or not the food is available
                $count1 = mysqli_num_rows($res1);
                if($count1>0){
                    //Food available
                    while($row1 = mysqli_fetch_assoc($res1)){
                        //Get Food Values by id
                        $id = $row1['id'];
                        $title = $row1['title'];
                        $price = $row1['price'];
                        $description = $row1['description'];
                        $image_name = $row1['image_name'];
                        ?>
                        <div class="food-menu-box">
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
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price">GHC<?php echo $price; ?></p>
                                <p class="food-detail"><?php echo $description; ?></p>
                                <br>
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php                                            
                    }
                }else{
                    //Food not available
                    echo "<div class='error text-center'>Food not available</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include("includes/footer.php"); ?>