<?php include("includes/menu.php"); ?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php

                //Get the Search Keyword
                $search = $_POST['search'];

            ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //SQL Query to get searched food
                $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                //Execute Query
                $res = mysqli_query($connection, $sql);
                //Count rows
                $count = mysqli_num_rows($res);
                //Check whether or not food is available
                if($count>0){
                    //Get food
                    while($row = mysqli_fetch_assoc($res)){
                        //Get Food Values by id
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
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
                                <a href="<?php echo SITEURL; ?>order.html" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php   
                    }
                }else{
                    //Display message that food isn't available
                    echo "<div class='error text-center'>Food Not Available</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php include("includes/footer.php"); ?>