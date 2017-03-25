<?php

/*
* Title                   : Booking Calendar PRO (jQuery Plugin)
* Version                 : 1.2
* File                    : save.php
* File Version            : 1.0
* Created / Last Modified : 20 May 2013
* Author                  : Dot on Paper
* Copyright               : © 2011 Dot on Paper
* Website                 : http://www.dotonpaper.net
* Description             : Save booking data in database.
*/
   // print_r($_POST);die;
    if (isset($_POST['dopbcp_calendar_id'])){ // If calendar ID is received.
        require_once 'opendb.php';
    
// Test if calendar is added to the database.        
        $query = mysqli_query($conn, 'SELECT * FROM schedule WHERE id="'.$_POST['dopbcp_calendar_id'].'"');

			
			$propId = $_POST['dopbcp_calendar_id'];
			//echo $propId;die;
			$values = json_decode($_POST['dopbcp_schedule']);
			$dat_arr = get_object_vars($values);
			
			
        if (mysqli_fetch_array($query) !== false){
// Update if calendar already in the database.            
            mysqli_query($conn, "UPDATE schedule SET data='".$_POST['dopbcp_schedule']."' WHERE id=".$_POST['dopbcp_calendar_id']);
			
			foreach($dat_arr as $key=>$val)
				{
					if($val->status == 'booked')
						{  
						  $query1 = mysqli_query($conn, 'SELECT * FROM bookings WHERE PropId="'.$propId.'" and the_date ="'.$key.'" ');
						  $num_rows = mysqli_num_rows($query1);
						  if($num_rows == 0)
						  	{
							$query = "INSERT INTO  `bookings` (  `PropId` ,  `the_date` , `id_state` ,`id_item` ) VALUES (".$propId.", '".$key."',1,1)";
							mysqli_query($conn, $query);
							}else{
								$query = "delete from `bookings` where  `PropId`=".$propId." and `the_date`='".$key."'";
								mysqli_query($conn, $query);
								
								$query = "INSERT INTO  `bookings` (  `PropId` ,  `the_date` , `id_state` ,`id_item` ) VALUES (".$propId.", '".$key."',1,1)";
								mysqli_query($conn, $query);
							}
						}else if($val->status == 'available'){
							$query = "delete from `bookings` where  `PropId`=".$propId." and `the_date`='".$key."'";
							mysqli_query($conn, $query);
						}else if ($val->status == 'unavailable'){
							$query = "delete from `bookings` where  `PropId`=".$propId." and `the_date`='".$key."'";
							mysqli_query($conn, $query);
							
							$query = "INSERT INTO  `bookings` (  `PropId` ,  `the_date` , `id_state` ,`id_item` ) VALUES (".$propId.", '".$key."',4,1)";
							mysqli_query($conn, $query);
						}
				}
        }
        else{
// Insert calendar in the database if it doesn't exist.   

            mysqli_query($conn, "INSERT INTO  `schedule` (  `id` ,  `data` ) VALUES (".$_POST['dopbcp_calendar_id'].", '".$_POST['dopbcp_schedule']."')");
			
			foreach($dat_arr as $key=>$val)
				{
					//echo $key.'<br/>'; die;
						if($val->status == 'booked')
						{
							$query = "delete from `bookings` where  `PropId`=".$propId." and `the_date`='".$key."'";
							mysqli_query($conn, $query);
							
							$query = "INSERT INTO  `bookings` (  `PropId` ,  `the_date` , `id_state` ,`id_item` ) VALUES (".$propId.", '".$key."',1,1)";
							mysqli_query($conn, $query);
						}else if ($val->status == 'unavailable'){
						
							$query = "delete from `bookings` where  `PropId`=".$propId." and `the_date`='".$key."'";
							mysqli_query($conn, $query);
							
							$query = "INSERT INTO  `bookings` (  `PropId` ,  `the_date` , `id_state` ,`id_item` ) VALUES (".$propId.", '".$key."',4,1)";
							mysqli_query($conn, $query);
						}
					//echo $query;die;
				}
				
        }
    }
    
?>