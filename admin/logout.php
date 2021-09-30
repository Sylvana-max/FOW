<?php
    include('../config/constants.php');
    //Destroy sessions
    session_destroy(); //Unset users as well

    //Redirect to Login page
    header('location:'.SITEURL.'admin/login.php');

?>