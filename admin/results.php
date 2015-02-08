<?php
ob_start();
include_once('../include/common.php'); 
myconnect();

if(!isset($_SESSION['id']))
	die('<h1>You are not logged in. Please log in <a href="login.php">here</a>.</h1>');

$sql_query="SELECT COUNT(*) FROM `2014` WHERE accessed='1';";
$result = mysqli_query($link,$sql_query);
$length = mysqli_fetch_array($result);
mysqli_free_result($result); //frees space
?>
<html>
<head>
<title>SURVEY RESULTS</title>
<link rel="icon" type="image/gif" href="../img/tabicon.gif" />
</head>
<body>
<b>There is a total of 
<font color="FF0000">
<?php echo $length['COUNT(*)']; ?></font>
 students who have accessed the survey program.</b>
<table border>
<tr>
<th>Question</th>
<th>Person with most votes</th>
</tr>
<?php
$sql_query="SELECT COUNT(*) FROM questions;";
$result = mysqli_query($link,$sql_query);
$list = mysqli_fetch_array($result);
$len = $list['COUNT(*)'];
mysqli_free_result($result); //frees space

for($i=0;$i<$len;$i++){
	$ii = $i + 1;
	echo "<th>Q$ii(M)</th>\n";
	echo "<th>Q$ii(F)</th>\n";
}
?>
</tr>
<?php
  $sql_query="SELECT * FROM `2014` WHERE accessed='1' ORDER BY lname ASC, fname ASC";
$result = mysqli_query($link,$sql_query);
while($list = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>{$list['fname']}</td>\n";
	echo "<td>{$list['lname']}</td>\n";
	for($i=0;$i<$len;$i++){
		$index = "sm{$i}";
		if(!empty($list[$index]))
			$out = $list[$index];
		else
			$out = "&nbsp;";
		echo "<td>$out</td>\n";
		$index = "sf{$i}";
		if(!empty($list[$index]))
			$out = $list[$index];
		else
			$out = "&nbsp;";
		echo "<td>$out</td>\n";
	}
	echo "</tr>";
}

//mydc();
?>
</table>
</body>
</html>