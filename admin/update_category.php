<?php include("includes/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Update Category</h1>
        <br/>
        
        <?php 

            //Get the id of selected category
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                //Create SQL Query to get the details of category
                $sql = "SELECT * FROM category WHERE id='$id'";
            //Execute the Query
                $res = mysqli_query($connection, $sql);

                $count = mysqli_num_rows($res);

                //Check whether or not the Query is executed
                if($count==1){
                    //get details
                    $rows = mysqli_fetch_assoc($res);

                    // $id= $rows['id'];
                    $title= $rows['title'];
                    $current_image= $rows['image_name'];
                    $featured= $rows['featured'];
                    $active= $rows['active'];
                    
                }else{
                    //redirect
                    $_SESSION['no-category-found'] = "<div class='error text-center'>Unsuccessfully Updated</div>";
                    header('location:'.SITEURL.'admin/category.php');
                }
            }else{
                //Redirect
                header('location:'.SITEURL.'admin/category.php');
            }   
        ?>
       
       
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Title: </label>
                <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
            </div>

            <div class="form-group">
                <?php
                    if($current_image !=""){
                        //Display the image
                        ?>
                        <img src="<?php echo SITEURL; ?> images/Category/<?php echo $current_image; ?>" width="150px">
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
               
                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
            </div>
        </form>
    </div>

</div>
<?php

    if(isset($_POST['submit'])){
         //get data from form
        // $id=$_POST['id'];
        $title= $_POST['title'];
        $current_image= $_POST['current_image'];
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
                $ext = explode('.', $image_name);
                $xt = end($ext);
                $image_name = "Food_Category_".rand(000,999).'.'.$xt;

                $source_path = $_FILES['image']['tmp_name']; //image source path
                
                $destination_path = "../images/Category/".$image_name; //image destination path

                $upload = move_uploaded_file($source_path, $destination_path);
                //Check whether or not image is uploaded
                    if($upload==false){
                        //set message
                        $_SESSION['upload'] = "<div class='error text-center'>Image Not Uploaded.</div>";
                        //Redirect
                        header('location:'.SITEURL.'admin/category.php');
                        //Stop the process
                        die();
                    }

                //And remove current image
                if($current_image!=""){
                    $remove_path ="../images/Category/".$current_image;
                    
                    $remove = unlink($remove_path);

                    //Check whether or not Image is removed

                    if($remove==false){
                        $_SESSION['failed-remove'] = "<div class='error text-center'>Failed to remove current image</div>";
                        header('location'.SITEURL.'admin/category.php');
                        die();
                    }
                }

            }else{
                $image_name = $current_image;
            }

        }else{
            //Set the image
            $image_name = $current_image;
        }
        //SQL Query to update data into the database
        $sql = "UPDATE category SET
            title= '$title',
            image_name= '$image_name',
            featured= '$featured',
            active= '$active'
            WHERE id='$id'";

        //Execute Query and saves data into the database
        $res = mysqli_query($connection, $sql);

        if($res==true){
            $_SESSION['update'] = "<div class='success text-center'>Successfully Updated</div>";
            //Redirect Page
            header("location:".SITEURL.'admin/category.php');
        }else{
            $_SESSION['update'] = "<div class='error text-center'>Failed to Update Category</div>";
            //Redirect Page
            header("location:".SITEURL.'admin/update_category.php');
        }

    }
?>

<?php include("includes/footer.php"); ?>