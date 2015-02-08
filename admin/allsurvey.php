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

$sql_query="SELECT COUNT(*) FROM questions;";
$result = mysqli_query($link,$sql_query);
$list = mysqli_fetch_array($result);
$len = $list['COUNT(*)'];
mysqli_free_result($result); //frees space

$sql_query="SELECT question FROM `questions`;";
$result = mysqli_query($link,$sql_query);
$i = 0;
while($list = mysqli_fetch_array($result)){
$categories[$i] = $list[0];
$i++;
}
?>
<html>
<head>
<title>ALL EXISTING SURVEY RESULTS</title>
<link rel="icon" type="image/gif" href="../img/tabicon.gif" />
</head>
<body>
<b>There is a total of 
<font color="FF0000">
<?php echo $length['COUNT(*)']; ?></font>
 students who have accessed the survey program.</b>
 <table border>
 <tr>
 <th>Name</th>
 <th>Rank 1</th>
 <th>Rank 2</th>
 <th>Rank 3</th>
 <th>Rank 4</th>
 <th>Rank 5</th>
 </tr>
 <?php
 for($i=0;$i<$len;$i++){
 echo "<tr><td>" . $categories[$i] . " (Male)</td>\n";
$sql_query="
SELECT       `sm{$i}`,
             COUNT(`sm{$i}`) AS `value_occurrence` 
    FROM     `2014`
    GROUP BY `sm{$i}`
    ORDER BY `value_occurrence` DESC
    limit 1,5";
$result = mysqli_query($link,$sql_query);
while($list = mysqli_fetch_array($result)){
$out = "sm" . $i;
echo "<td>" . $list[$out] . " (" . $list['value_occurrence'] . ")</td>\n";
}
echo "</tr><tr><td>" . $categories[$i] . " (Female)</td>\n";
$sql_query="
SELECT       `sf{$i}`,
             COUNT(`sf{$i}`) AS `value_occurrence` 
    FROM     `2014`
    GROUP BY `sf{$i}`
    ORDER BY `value_occurrence` DESC
    limit 1,5";
$result = mysqli_query($link,$sql_query);
while($list = mysqli_fetch_array($result)){
$out = "sf" . $i;
echo "<td>" . $list[$out] . " (" . $list['value_occurrence'] . ")</td>\n";
}
echo "</tr>\n";
}
?>
</table>

<table border>
<tr>
<th>First</th>
<th>Last</th>
<?php
for($i=0;$i<$len;$i++){
	$ii = $i + 1;
	echo "<th>Q$ii(M)</th>\n";
	echo "<th>Q$ii(F)</th>\n";
}
?>
</tr>

<?php
  $sql_query="SELECT * FROM `2014` WHERE accessed='1' AND deleted = '0' ORDER BY lname ASC, fname ASC";
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