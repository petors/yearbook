<?php
include_once('include/common.php');
myconnect();

if(isset($_REQUEST['first'])){
$sql_query = "SELECT * FROM `questions`;";
$result = mysqli_query($link,$sql_query);
while($list = mysqli_fetch_array($result)){
	$db[] = $list['want'];
	$num = $list['id'];
	if(!(isset($_REQUEST[$num])))
		$want[] = 'false';
	else
		$want[] = 'true';
}
var_dump($_REQUEST['first']);
var_dump($db);
var_dump($want);
}
/*$query = "UPDATE `questions` SET ";
while($list = mysqli_fetch_array($result)){
	$num = $list['id'];
	if(!(isset($_REQUEST[$num])))
		$want = false;
	else
		$want = true;
	$query .= 
}*/

?>
<html>
	<head></head>
	<body>
		<form action="pick_cat.php" method="POST">
		<table border align="center">
			<tr>
				<th>Categories</th>
				<th>Include?</th>
			</tr>

<?php
$sql_query="SELECT * FROM `questions`;";
$result = mysqli_query($link,$sql_query);
while($list = mysqli_fetch_array($result)){
	echo "<tr>";
	echo "<td>{$list['question']}</td>";
	$out = "<td><input type=\"checkbox\" name=\"{$list['id']}\" value=\"true\"";
	if ($list['want'] == 'true'){
		$out .= " checked";
	}
	echo $out . "></td></tr>\n";
}
?>

			<tr>
				<td colspan="2">
					<input type="hidden" name="first" value="1">
					<button type="submit">Refresh</button>
				</td>
			</tr>
		</table>
		</form>
	</body>
</html>