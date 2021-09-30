<?php include("includes/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Add Food</h1>
       
        
        <?php 
                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];//Displays message
                        unset($_SESSION['upload']);//Removing session message
                    }
        ?>
       
        <form action="" method="POST" class="tbl-30" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title">Title: </label>
                <input type="text" class="form-control" name="title" placeholder="Enter The Title" required>
            </div>

            <div class="form-group">
                <label for="description">Description: </label>
                <textarea class="form-control" cols="30" rows="5" name="description" placeholder="Enter Your Description"></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price: </label>
                <input type="number" class="form-control" name="price" placeholder="Enter Your Price" required>
            </div>

            <div class="form-group">
                <input type="file" name="image" class="form-control">
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
                                $id = $row['id'];
                                $title = $row['title'];
                                ?>
                                <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
                <input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured" value="No">No
            </div>

            <div class="form-group">
                <label for="active">Active: </label>
                <input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
            </div>

            <div class="form-group">
                
                <input type="submit" name="submit" value="Add Food" class="btn-secondary">
            </div>
        </form>

    </div>

</div>

<?php
// Codes to process the form values and save it into the Database
//Also, check whether the submit button is clicked or not

if(isset($_POST['submit'])){
    //get data from form
    $title= $_POST['title'];
    $description= $_POST['description'];
    $price= $_POST['price'];
    $category= $_POST['category'];

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

    //Check whether or not image is selected and upload image
    if(isset($_FILES['image']['name'])){
        //Upload image
        $image_name = $_FILES['image']['name'];
            //Check whether or not image is selected
            if($image_name!=""){

            //Auto rename image
            $ext = (explode('.', $image_name));
            $xt = end($ext);
            //Create New image name as DEFAULT
            $image_name = "Food-Name".rand(000,999).".".$xt;
            //Image source path
            $source_path = $_FILES['image']['tmp_name']; 
            //Image destination path
            $destination_path = "../images/Food/".$image_name; 
            //Finally upload the image of food
            $upload = move_uploaded_file($source_path, $destination_path);
            //Check whether or not image is uploaded
                if($upload==false){
                    //set message
                    $_SESSION['upload'] = "<div class='error text-center'>Image Not Uploaded.</div>";
                    //Redirect
                    header('location:'.SITEURL.'admin/add_food.php');
                    //Stop the process
                    die();
                }
            }
        }else{
            //Don't upload image
            //set message
            //$_SESSION['not-uploaded'] = "<div class='error text-center'>Unable to Upload Image.</div>";
            //Redirect
            //header('location:'.SITEURL.'admin/add_category.php');
            $image_name = "";
        }

    //SQL Query to save data into the database
    $sql = "INSERT INTO food SET
        title = '$title',
        description = '$description',
        price = '$price',
        image_name = '$image_name',
        category_id = '$category',
        featured = '$featured',
        active = '$active'";

    //Execute Query and saves data into the database
    $res = mysqli_query($connection, $sql);

    //Check whether or not the data is inserted into the database or 
    if($res==true){
        $_SESSION['add'] = "<div class='success text-center'>Food Added Successful</div>";
        //Redirect Page
        header("location:".SITEURL.'admin/food.php');
    }else{
        $_SESSION['add'] = "<div class='error text-center'>Food Added Unsuccessful</div>";
        //Redirect Page
        header("location:".SITEURL.'admin/add_food.php');
    }
}
?>
<?php include("includes/footer.php"); ?>