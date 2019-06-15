<?php

    ini_set("display_errors","1");
    error_reporting(E_ALL);

    require ("db_connect.php");
    require("session.php");

    require("nav.php");

    $getDateSql = "SELECT date_range FROM td_date_range ";
    $dateResult = mysqli_query($db_connect,$getDateSql);
    $dateRange = mysqli_fetch_assoc($dateResult);
    
    echo $dateRange['date_range']; die;


?>

<html>

    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <body>



    </body>

</html>