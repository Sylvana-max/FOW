<?php
include('../config/constants.php');
    //Get the id of the admin to be deleted
    $id = $_GET['id'];
    //Create SQL Query to delete admin
    $sql = "DELETE FROM category WHERE id=$id";
    //Execute the Query
    $res = mysqli_query($connection, $sql);
    //Check whether or not the query executed successfully
    if($res==true){
        $_SESSION['delete'] = "<div class='success text-center'>Category Deleted Successfully</div>";
        //Redirect Page
        header("location:".SITEURL.'admin/category.php');
    }else{
        $_SESSION['delete'] = "<div class='error text-center'>Category Deleted Unsuccessfully</div>";
        //Redirect Page
        header("location:".SITEURL.'admin/category.php');
    }

?>