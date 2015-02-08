<?php
 ob_start();
    // First we execute our common code to connection to the database and start the session
    include_once("../include/common.php");
    
    // We remove the user's data from the session
    unset($_SESSION['comment']);
	unset($_SESSION['id']);
	session_destroy();
    
    // We redirect them to the login page
    header("Location: login.php");
    die("Redirecting to: login.php");