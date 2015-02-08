<?php
ob_start();
include_once('../include/common.php'); 
myconnect();

if(!isset($_SESSION['id']))
	die('<h1>You are not logged in. Please log in <a href="login.php">here</a>.</h1>');

$sql_query="SELECT COUNT(*) FROM `2014` WHERE accessed='1' AND deleted = '0';";
$result = mysqli_query($link,$sql_query);
$length = mysqli_fetch_array($result);
mysqli_free_result($result); //frees space
?>
<html>
<head>
<style>
table
{
table-layout:auto;
width:100%;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ALL EXISTING COMMENTS</title>
<link rel="icon" type="image/gif" href="../img/tabicon.gif" />
</head>
<body>
<b>There is a total of 
<font color="FF0000">
<?php echo $length['COUNT(*)']; ?></font>
 students who have accessed the comment program.</b>
<table border>
<tr>
<th>First</th>
<th>Last</th>
<th>Comment</th>
</tr>
<?php
myconnect();

  
  $sql_query="SELECT fname, lname, comment FROM `2014` WHERE accessed='1' AND deleted = '0' ORDER BY lname ASC, fname ASC";
$result = mysqli_query($link,$sql_query);
while($list = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td><font color=\"00ff00\">{$list['fname']}</font></td>";
	echo "<td><font color=\"0000ff\">{$list['lname']}</font></td>";
	if(!empty($list['comment']))
		$out = nl2br(htmlspecialchars($list['comment']));
	else
		$out = "&nbsp;";
	echo "<td>" . $out . "</td>";
	echo "</tr>";
}

//mydc();
?>
</table>
</body>
</html>