<?php
include_once('include/common.php'); 
myconnect();

$sql_query="SELECT COUNT(*) FROM `questions`;";
$result = mysqli_query($link,$sql_query);
$list = mysqli_fetch_array($result);
$len = $list['COUNT(*)'];
mysqli_free_result($result);

/*for($i=1;$i<=$len;$i++){
	if(isset($_REQUEST[$i]) && ($_REQUEST[$i]))
		var_dump(!($_REQUEST[$i]));
	else
		echo "&nbsp;";
}*/

$sql_query="SELECT * FROM `questions`;";
$result = mysqli_query($link,$sql_query);
$i=0;
while($list = mysqli_fetch_array($result)){
	$i++;
	/*if(isset($_REQUEST[$i]))
		var_dump(($_REQUEST[$i] === $list['want']));*/
	if(isset($_REQUEST[$i]) && ($_REQUEST[$i] !== $list['want'])){
		echo "{$_REQUEST[$i]} is equal to {$list['want']}<br>";
	}
}

/*for($i=1;$i<=$len;$i++){
	if(isset($_REQUEST[$i]) && ($_REQUEST[$i] == "1"))
		echo $i;
}*/

?>
<html>
	<head><title>Categories</title></head>
	<body>
		<h1>Pick Survey Categories</h1>
		<form action="categories.php" method="POST">
		<table border>
			<tr>
				<th>Category</th>
				<th>Want?</th>
			</tr>
			<?php
			$sql_query = "SELECT * FROM `questions`;";
			$result = mysqli_query($link,$sql_query);
				while($list = mysqli_fetch_array($result)){
					echo "<tr>\n";
					echo "<td>{$list['question']}</td>\n";
					$out = "<td><input type=checkbox name={$list['id']} value=true";
					if ($list['want'] == 'true'){
						$out .= " checked=checked";
					}
					echo $out . "</td></tr>\n";
				}
			?>
			<td colspan=2><button type="submit">Refresh</td>
		</table>
		</form>
	</body>
</html>