<?php

    // DB COnfiguration Start --> 
    

    $servername = "synergicportal.in";
    $username   = "ykghedfafq";
    $password   = "sss2001";
    $dbname	    = "ykghedfafq";


    // $servername = "localhost";
    // $username   = "root";
    // $password   = "teachers";
    // $dbname	    = "api";

    

    $db_connect = mysqli_connect($servername,$username,$password,$dbname);

	if(!$db_connect) {

		die("Database Connection Failed ".mysqli_connect_error());

	}

	ini_set('session.gc_maxlifetime', 28800);
	ini_set("display_errors","1");
    error_reporting(E_ALL);

    //DB COnfiguration End -->

?>