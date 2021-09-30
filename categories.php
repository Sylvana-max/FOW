<?php include("includes/menu.php"); ?>
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                //Create SQL Query to display categories from database
                $sql = "SELECT * FROM category WHERE active='Yes'";
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
                                        echo "<div class='error text-center'>Category Not Available</div>";
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

    <?php include("includes/footer.php"); ?>