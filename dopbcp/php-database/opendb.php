<?php
require_once '../../databaseValues.php';
/*
* Title                   : Booking Calendar PRO (jQuery Plugin)
* Version                 : 1.2
* File                    : opendb.php
* File Version            : 1.0
* Created / Last Modified : 20 May 2013
* Author                  : Dot on Paper
* Copyright               : © 2011 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Connect & create a database.
*/

	
	define("DB_HOST",		$hostName);
	define("DB_NAME",		$databaseName);
	define("DB_USER",		$dbUserName);
	define("DB_PASS",		$dbPassword);
	

// Connect to database.    
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS) or die ('Error connecting to mysql!');
	//echo $conn;
    mysqli_select_db($conn, DB_NAME);
// Test if table exist.
    $query = mysqli_query($conn, 'SELECT 1 FROM schedule'); 
	//echo $query;
    
    if($query === false){
// If table doesn't exist a new one is created.        
        mysqli_query($conn, 'CREATE TABLE schedule (id INT, data TEXT)');
    }

?>