<?php 

    //Authorization - Access control
    //Check whether or not user is logged in
    if(!isset($_SESSION['user'])){
        //User not logged in
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to have access.</div>";
        //Redirect to the login page
        header('location:'.SITEURL.'admin/login.php');
    }
    
?>