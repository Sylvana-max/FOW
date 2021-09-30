<?php include("includes/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
        <h1 class="text-center">Add Admin</h1>
        <br/><br/>
        
        <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];//Displays message
                        unset($_SESSION['add']);//Removing session message
                    }
        ?>
        <br/><br/>
        <form action="" method="POST" class="center">

            <div class="form-group">
                <label for="full_name">Full Name: </label>
                <input type="text" class="form-control" name="full_name" placeholder="Enter Your Full Name" required>
            </div>

            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" class="form-control" name="username" placeholder="Enter Your Username" required>
            </div>

            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" class="form-control" name="password" placeholder="Enter Your Password" required>
            </div>

            <div class="form-group">
                
                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
            </div>
        </form>

    </div>

</div>


<?php include("includes/footer.php"); ?>

<?php
// Codes to process the form values and save it into the Database
//Also, check whether the submit button is clicked or not

if(isset($_POST['submit'])){
    //get data from form
    $full_name= $_POST['full_name'];
    $username= $_POST['username'];
    $password= ($_POST['password']);//Password Encryption with MD5

    //SQL Query to save data into the database
    $sql = "INSERT INTO admin SET
        full_name= '$full_name',
        username= '$username',
        password= '$password'";

    //Execute Query and saves data into the database
    $res = mysqli_query($connection, $sql);

    //Check whether or not the data is inserted into the database or 
    if($res==true){
        $_SESSION['add'] = "<div class='success text-center'>Successful</div>";
        //Redirect Page
        header("location:".SITEURL.'admin/admin.php');
    }else{
        $_SESSION['add'] = "<div class='error text-center'>Unsuccessful</div>";
        //Redirect Page
        header("location:".SITEURL.'admin/add_admin.php');
    }
}
?>