<?php include("includes/menu.php"); ?>

    <!-- Food Search Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Food Search Section Ends Here -->

<?php 

    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }

?>
    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                //Create SQL Query to display categories from database
                $sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //Execute the Query
                $res = mysqli_query($connection, $sql);
                //Count rows to check whether or not the category is available
                $count = mysqli_num_rows($res);
                if($count>0){
                    //Category available
                    while($row = mysqli_fetch_assoc($res)){
                        //Get Category Values by id
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    //Check whether or not image is available
                                    if($image_name==""){
                                        //Display message
                                        echo "<div class='error text-center'>Image Not Available</div>";
                                    }else{
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/Category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }else{
                    //Category not available
                    echo "<div class='error text-center'>Category not available</div>";
                }

            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- Food Menu Section Starts Here -->
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

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- Food Menu Section Ends Here -->

<?php include("includes/footer.php"); ?>