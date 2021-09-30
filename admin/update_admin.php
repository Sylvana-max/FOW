<?php include("includes/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Update Admin</h1>
        <br/><br/>
        
        <?php 

            //Get the id of selected admin
            $id = $_GET['id'];
            //Create SQL Query to get the details of admin
            $sql = "SELECT * FROM admin WHERE id='$id'";
            //Execute the Query
            $res = mysqli_query($connection, $sql);
            //Check whether or not the Query is executed
            if($res == true){
                $count = mysqli_num_rows($res);

                if($count==1){
                    //get details
                    while($rows = mysqli_fetch_assoc($res)){


                        $id= $rows['id'];
                        $full_name= $rows['full_name'];
                        $username= $rows['username'];
                        $password= $rows['password'];
                }
                    }else{
                    //redirect
                    header('location:'.SITEURL.'admin/admin.php');
                }
            }
        ?>
       
        <form action="" method="POST">

            <div class="form-group">
                <label for="full_name">Full Name: </label>
                <input type="text" class="form-control" name="full_name" placeholder="Enter Your Full Name" value="<?php echo $full_name; ?>">
            </div>

            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" class="form-control" name="username" placeholder="Enter Your Username" value="<?php echo $username; ?>">
            </div>

            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" class="form-control" name="password" placeholder="Enter Your Password" value="<?php echo $password; ?>">
            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
            </div>
        </form>

    </div>

</div>
<?php

    if(isset($_POST['submit'])){
        //get data from form
        $full_name= $_POST['full_name'];
        $username= $_POST['username'];
        $password= ($_POST['password']);//Password Encryption with MD5
    
        //SQL Query to update data into the database
        $sql = "UPDATE admin SET
        full_name= '$full_name',
        username= '$username',
        password= '$password'
        WHERE id='$id'";

        //Execute Query and saves data into the database
        $res = mysqli_query($connection, $sql);

        if($res==true){
            $_SESSION['update'] = "<div class='success text-center'>Successfully Updated</div>";
            //Redirect Page
            header("location:".SITEURL.'admin/admin.php');
        }else{
            $_SESSION['update'] = "<div class='error text-center'>Unsuccessful</div>";
            //Redirect Page
            header("location:".SITEURL.'admin/update_admin.php');
        }

    }
?>

<?php include("includes/footer.php"); ?>