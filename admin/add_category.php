<?php include("includes/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Add Category</h1>

        <br/>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];//Displays message
                unset($_SESSION['add']);//Removing session message
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];//Displays message
                unset($_SESSION['upload']);//Removing session message
            }
        ?>
        <br/>
        <!-- Add Category Form Starts Here -->
        <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Title: </label>
                <input type="text" name="title" class="form-control" placeholder="Category Title" required>
            </div>

            <div class="form-group">
                <input type="file" name="image">
            </div>

            <div class="form-group">
                <label for="featured">Featured: </label>
                <input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured" value="No">No
            </div>

            <div class="form-group">
                <label for="active">Active: </label>
                <input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
            </div>

            <div class="form-group">
                
                <input type="submit" name="submit" value="Add Category" class="btn-secondary">
            </div>
        </form>
        <!-- Add Category Form Starts Here -->

        <?php 
        //Check whether or not button is clicked
            if(isset($_POST['submit'])){
                //Get values from form
                $title = $_POST['title'];
                //For radio type, we need to check whether button is selected or not
                if(isset($_POST['featured'])){
                    //Get value
                    $featured = $_POST['featured'];
                }else{
                    //Set default value
                    $featured = "No";
                }
                if(isset($_POST['active'])){
                    //Get value
                    $active = $_POST['active'];
                }else{
                    //Set default value
                    $active = "No";
                }
                    //Check whether  or not the image is selected
                    //print_r($_FILES['image']);
                    // die();
                if(isset($_FILES['image']['name'])){
                    //Upload image
                    $image_name = $_FILES['image']['name'];
                        if($image_name!=""){

                        

                        //Auto rename image
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name']; //image source path
                        
                        $destination_path = "../images/Category/".$image_name; //image destination path

                        $upload = move_uploaded_file($source_path,$destination_path);
                        //Check whether or not image is uploaded
                            if($upload==false){
                                //set message
                                $_SESSION['upload'] = "<div class='error text-center'>Image Not Uploaded.</div>";
                                //Redirect
                                header('location:'.SITEURL.'admin/add_category.php');
                                //Stop the process
                                die();
                            }
                        }
                    }
                    else{
                        //Don't upload image
                        //set message
                        // $_SESSION['not-uploaded'] = "<div class='error text-center'>Unable to Upload Image.</div>";
                        // //Redirect
                        // header('location:'.SITEURL.'admin/add_category.php');
                        $image_name = "";
                    }
                
                //Create SQL Query to insert values into database
                $sql = "INSERT INTO category SET 
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'";

                //Execute Query 
                $res = mysqli_query($connection, $sql);

                //Check whether or not the query has been executed
                if($res==true){
                    //Executed
                    $_SESSION['add'] = "<div class='success text-center'>Successfully Added to Category</div>";
                    //Redirect Page
                    header("location:".SITEURL.'admin/category.php');
                }else{
                    //Not Executed
                    $_SESSION['add'] = "<div class='error text-center'>Unsuccessful Operation</div>";
                    //Redirect Page
                    header("location:".SITEURL.'admin/add_category.php');
                }
            }
        ?>
    </div>

</div>

<?php include('includes/footer.php'); ?>