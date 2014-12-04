<?php 
    session_start();            //start session
    $_SESSION = NULL ;    //clear session
	header("location: login.php"); // redirect to login page
?>