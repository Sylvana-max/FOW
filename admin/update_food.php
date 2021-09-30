<?php include("includes/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Update Food</h1>
        <br/>
        
        <?php 

            if(isset($_SESSION['no-food-found'])){
                echo $_SESSION['no-food-found'];//Displays message
                unset($_SESSION['no-food-found']);//Removing session message
            }

            //Get the id of selected category
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                //Create SQL Query to get the details of category
                $sql = "SELECT * FROM food WHERE id='$id'";
            //Execute the Query
                $res = mysqli_query($connection, $sql);

                $count = mysqli_num_rows($res);

                //Check whether or not the Query is executed
                if($count==1){
                    //get details
                    $rows = mysqli_fetch_assoc($res);

                    // $id= $rows['id'];
                    $title= $rows['title'];
                    $description= $rows['description'];
                    $price= $rows['price'];
                    $current_image= $rows['image_name'];
                    $current_category= $rows['category_id'];
                    $featured= $rows['featured'];
                    $active= $rows['active'];
                    
                }else{
                    //redirect
                    $_SESSION['no-food-found'] = "<div class='error text-center'>Unsuccessfully Updated</div>";
                    header('location:'.SITEURL.'admin/food.php');
                }
            }else{
                //Redirect
                header('location:'.SITEURL.'admin/food.php');
            }   
        ?>
       
       
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Title: </label>
                <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
            </div>

            <div class="form-group">
                <label for="description">Description: </label>
                <textarea class="form-control" cols="30" rows="5" name="description"><?php echo $description; ?></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price: </label>
                <input type="number" class="form-control" name="price" value="<?php echo $price; ?>">
            </div>

            <div class="form-group">
                <?php
                    if($current_image !=""){
                        //Display the image
                        ?>
                        <img src="<?php echo SITEURL; ?> images/Food/<?php echo $current_image; ?>" width="150px">
                        <?php
                        
                    }else{
                        //Display the error message
                        echo "<div class='error'>Image Not Added. </div>";
                    }
                ?>
            </div>

            <div class="form-group">
                <input type="file" name="image">
            </div>

            <div class="form-group">
                <label for="category">Category: </label>
                <select name="category" class="form-control">

                    <?php
                        //Create PHP code to display active categories from database
                        //1. SQL query
                        $sql = "SELECT * FROM category WHERE active='Yes'";
                        //Execute query
                        $res = mysqli_query($connection, $sql);
                        //Count to check whether or not we have categories
                        $count = mysqli_num_rows($res);
                        if($count>0){
                            while($row = mysqli_fetch_assoc($res)){
                                //Get details of categories
                                $category_id = $row['id'];
                                $category_title = $row['title'];
                                ?>
                                <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                            }
                        }else{
                            //We do not have categories
                            ?>
                            <option value="0">No Category Found</option>
                            <?php
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="featured">Featured: </label>
                <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
            </div>

            <div class="form-group">
                <label for="active">Active: </label>
                <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
            </div>

            <div class="form-group">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
               
                <input type="submit" name="submit" value="Update Food" class="btn-secondary">
            </div>
        </form>
    </div>

</div>
<?php

    if(isset($_POST['submit'])){
         //get data from form
        // $id=$_POST['id'];
        $title= $_POST['title'];
        $description= $_POST['description'];
        $price= $_POST['price'];
        $current_image= $_POST['current_image'];
        $current_category= $_POST['category'];
        $featured= $_POST['featured'];
        $active= ($_POST['active']);
        
        //Check whether or not image is selected
        if(isset($_FILES['image']['name'])){
            //Get the Image
            $image_name = $_FILES['image']['name'];

            //Check whether or not Image is available
            if($image_name !=""){
                //Image available. Then, upload image
                //Auto rename image
                $ext = (explode('.', $image_name));
                $xt = end($ext);
                $image_name = "Food-Name".rand(000,999).'.'.$xt;

                $source_path = $_FILES['image']['tmp_name']; //image source path
                
                $destination_path = "../images/Food/".$image_name; //image destination path

                $upload = move_uploaded_file($source_path, $destination_path);
                //Check whether or not image is uploaded
                    if($upload==false){
                        //set message
                        $_SESSION['upload'] = "<div class='error text-center'>Image Not Uploaded.</div>";
                        //Redirect
                        header('location:'.SITEURL.'admin/food.php');
                        //Stop the process
                        die();
                    }

                //And remove current image
                if($current_image!=""){
                    $remove_path ="../images/Food/".$current_image;
                    
                    $remove = unlink($remove_path);

                    //Check whether or not Image is removed

                    if($remove==false){
                        $_SESSION['failed-remove'] = "<div class='error text-center'>Failed to remove current image</div>";
                        header('location'.SITEURL.'admin/food.php');
                        die();
                    }
                }

            }else{
                $image_name = $current_image; //Default Image when image is not selected
            }
            }else{
                $image_name = $current_image; //Default image when button is not clicked
        }
        
        //SQL Query to update data into the database
        $sql = "UPDATE food SET
            title= '$title',
            description = '$description',
            price = '$price',
            image_name= '$image_name',
            category_id='$category_id',
            featured= '$featured',
            active= '$active'
            WHERE id='$id'";

        //Execute Query and saves data into the database
        $res = mysqli_query($connection, $sql);

        if($res==true){
            $_SESSION['update'] = "<div class='success text-center'>Successfully Updated</div>";
            //Redirect Page
            header("location:".SITEURL.'admin/food.php');
        }else{
            $_SESSION['update'] = "<div class='error text-center'>Failed to Update Food</div>";
            //Redirect Page
            header("location:".SITEURL.'admin/update_food.php');
        }

    }
?>

<?php include("includes/footer.php"); ?>