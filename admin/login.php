<?php include('../config/constants.php') ;?>
<!DOCTYPE html>
<html>
    <head>
        <title>Log into Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
    
        <!-- Login form starts here -->

        <form action="" method="post" class="login">
            
            <h1 class="text-center">Login Form</h1>
            <br/><br/>
            <?php
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];//Displays message
                    unset($_SESSION['login']);//Removing session message
                }
                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset ($_SESSION['no-login-message']);
                }
            ?>
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Enter Username" required>

            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Enter Password" required>

            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Login" class="btn-primary">

            </div>
        </form>
        <!-- Login form ends here -->
    </body>
</html>
<?php include("includes/footer.php"); ?>
<?php

//Check whether or not the login button is clicked
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Check whether or not user exist
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

    //Execute the Query
    $res = mysqli_query($connection, $sql);

    $count = mysqli_num_rows($res);

    if($count==1){
        $_SESSION['login'] = "<div class='success text-center'>Successfully Logged in</div>";
        $_SESSION['user'] = $username;
        //Redirect Page
        header("location:".SITEURL.'admin/index.php');
    }else{
        $_SESSION['login'] = "<div class='error text-center'>Username or Password Does Not Match.</div>";
        //Redirect Page
        header("location:".SITEURL.'admin/login.php');
    }

}

?>