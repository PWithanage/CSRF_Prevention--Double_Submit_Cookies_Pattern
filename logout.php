<?php
//logout function
	session_start();
	//destroy session and unset all session variables
	session_unset();
	session_destroy();
	unset($_COOKIE['session_cookie']);
	//expire all the other session cookies
	setcookie('PHPSESSID', '', time() - 3600, '/');
    setcookie('session_cookie', '', time() - 3600, '/');
    setcookie('csrf_token', '', time() - 3600, '/','www.assignment02.com',true);
	
	header("Location:index.php");
   	exit;
?>