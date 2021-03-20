<?php 
	//----------------------------------------------------------------------------------//	
	//                               COMPULSORY SETTINGS
	//----------------------------------------------------------------------------------//
	
	/*  Set the URL to your Sendy installation (without the trailing slash) */
	define('APP_PATH', 'http://localhost/conexionagroecologica/sendy');
	
	/*  MySQL database connection credentials (please place values between the apostrophes) */
	/*$dbHost = 'localhost'; //MySQL Hostname
	$dbUser = 'usrdbconrec'; //MySQL Username
	$dbPass = 'usrco3!Codnet'; //MySQL Password
	$dbName = 'dbconrec'; //MySQL Database Name*/

	$dbHost = '163.10.35.34'; //MySQL Hostname
	$dbUser = 'root'; //MySQL Username
	$dbPass = 'secyt'; //MySQL Password
	$dbName = 'conexion_agroecologica'; //MySQL Database Name
	
	
	//----------------------------------------------------------------------------------//	
	//								  OPTIONAL SETTINGS
	//----------------------------------------------------------------------------------//	
	
	/* 
		Change the database character set to something that supports the language you'll
		be using. Example, set this to utf16 if you use Chinese or Vietnamese characters
	*/
	$charset = 'utf8';
	
	/*  Set this if you use a non standard MySQL port.  */
	$dbPort = 3306;	
	
	/*  Domain of cookie (99.99% chance you don't need to edit this at all)  */
	define('COOKIE_DOMAIN', '');
	
	//----------------------------------------------------------------------------------//
?>