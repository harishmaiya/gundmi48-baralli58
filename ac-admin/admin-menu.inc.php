<?php
//	MENU WILL BECOME DB BASED - TO DO
$menu=array();
//echo $_SESSION['PropId']; die;
//	Main ADMIN level
//$menu[1]["local"]["items"]		= array('href'=>'','txt'=>''.$lang["admin_items"].'','icon'=>'');
$menu[1]["local"]["bookings"]	= array('href'=>'','txt'=>''.$lang["admin_bookings"].'','icon'=>'');
$menu[1]["local"]["states"]	= array('href'=>'','txt'=>''.$lang["admin_states"].'','icon'=>'');
//$menu[1]["local"]["languages"]	=	array('txt'=>''.$lang["admin_languages"].'');

//	icons
$menu[1]["common"]["config"]		= array('href'=>'','txt'=>''.$lang["admin_config"].'','icon'=>'<img src="icons/icon_process.png" alt="config">');
$menu[1]["common"]["admin_users"]	= array('href'=>'','txt'=>''.$lang["admin_admin_users"].'','icon'=>'<img src="icons/icon_users.png" alt="user">');
$menu[1]["common"]["see_web"]		= array('href'=>''.AC_CALENDAR_PUBLIC.'','txt'=>''.$lang["see_web"].'','icon'=>'<img src="icons/icon_calendar.png" alt="web">');
$menu[1]["common"]["logout"]		= array('href'=>'admin-logout.php','txt'=>''.$lang["logout"].'','icon'=>'<img src="icons/icon_shut_down.png" alt="logout">');


//	USER menu
$menu[2]["local"]["items"]		= array('href'=>'','txt'=>''.$lang["admin_items"].'','icon'=>'');
$menu[2]["local"]["bookings"]	= array('href'=>'','txt'=>''.$lang["admin_bookings"].'','icon'=>'');

//	icons
$menu[2]["common"]["profile"]		= array('href'=>'','txt'=>''.$lang["admin_profile"].'','icon'=>'<img src="icons/icon_user.png" alt="user">');
$menu[2]["common"]["see_web"]		= array('href'=>''.AC_CALENDAR_PUBLIC.'','txt'=>''.$lang["see_web"].'','icon'=>'<img src="icons/icon_calendar.png" alt="web">');
$menu[2]["common"]["logout"]		= array('href'=>'admin-logout.php','txt'=>''.$lang["logout"].'','icon'=>'<img src="icons/icon_shut_down.png" alt="logout">');

//echo $_SESSION['PropId']; die;

?>