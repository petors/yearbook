<?php
ob_start();
include_once('../include/common.php'); 
if(!isset($_SESSION['id']))
	die('<h1>You are not logged in. Please log in <a href="login.php">here</a>.</h1>');
?>
<html>
<head>
<title>
Comment/Survey Admin
</title>
</head>
<body>
<a href="showall.php">All Comments to Date</a><br>
<a href="allsurvey.php">All Survey Results to Date</a><br>
<!--<a href="results.php">Counted Survey Results</a><br>!-->
<a href="logout.php">Logout</a>

<h4>THIS PAGE IS A WORK IN PROGRESS</h4>
</body>
<html>