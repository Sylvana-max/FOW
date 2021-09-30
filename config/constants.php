<?php

    // Start session

    session_start();

    //Create Contants to store non repeating values
    define('SITEURL', 'http://localhost/Food_Order_Website/');
    define('LOCALHOST', 'localhost:3307');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food_order');
    

    $connection = mysqli_connect(LOCALHOST, DB_USERNAME,DB_PASSWORD); //Database connection
    $db_select = mysqli_select_db($connection,DB_NAME); // Selecting the database

?>