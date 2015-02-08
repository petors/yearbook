<?php include_once('../include/common.php'); ?>
<!doctype html><!--http://www.htmlblog.us/jquery-autocomplete!-->
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAC Yearbook Survey</title>
<link rel="stylesheet" href="../include/pure.css">
<link rel="stylesheet" href="../include/main-grid.css">
<link rel="stylesheet" href="../include/marketing.css">
<link rel="stylesheet" href="../include/astyle.css">
<link rel="icon" type="image/gif" href="../img/tabicon.gif" />
<script src="../include/jquery.js"></script>
<script src="../include/jquery-ui.js"></script>
<script>
<?php
myconnect();

if(!isset($_SESSION['id']))
	die('</script><h1>You are not logged in. Please log in <a href="login.php">here</a>.</h1>');

$id = $_SESSION['id'];

echo "$(function() {\n";

echo "var students = new Array();\n";

$sql_query="SELECT fname,lname FROM `2014`";
$result = mysqli_query($link,$sql_query);
$i = 0;
while($list = mysqli_fetch_array($result)){
	echo "students[{$i}] = \"{$list['fname']} {$list['lname']}\";\n";
	$i++;
}
?>
$( ".students" ).autocomplete({
source: students
});
});
</script>
</head>
<body>
<?php
if(isset($_REQUEST['sf']))
$females=$_REQUEST['sf'];
if(isset($_REQUEST['sm']))
$males=$_REQUEST['sm'];

if(isset($_REQUEST['sm']) && isset($_REQUEST['sf'])){
	$sql_query = "UPDATE `2014` SET ";
	for($i=0;$i<count($males);$i++){
		if(!empty($males[$i]))
			$sql_query .= "sm{$i} = '" . mysqli_real_escape_string($link,$males[$i]) . "', ";
		if(!empty($females[$i]))
			$sql_query .= "sf{$i} = '" . mysqli_real_escape_string($link,$females[$i]) . "', ";
	}
	$sql_query = rtrim($sql_query, " ,") . ", accessed = '1' WHERE id = {$id}";
	mysqli_query($link,$sql_query);
	$updated = 1;
}
else
	$updated=0;

$sql_query = "SELECT * FROM `2014` WHERE id = {$id}";
$result = mysqli_query($link,$sql_query);
$ovalues = mysqli_fetch_array($result);
//var_dump($ovalues);

?>
<div class="header">
    <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
        <h4 class="pure-menu-heading">MAC Yearbook</h4>

        <ul>
            <li><a href="mainedit.php">Comment</a></li>
            <li class="pure-menu-selected"><a href="survey.php">Survey</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>

<div class="splash-container">
    <div class="splash">
	<?php
		if($updated == 1){
			echo "<p class=\"splash-subhead\"><strong>Your Information has been updated.<br>\n";
			echo "<a href=\"mainedit.php\">Go back to your comment</a> or <a href=\"logout.php\">Logout</a></strong><br>\n";
			echo "<i>Help us by sharing this link (<a href=\"http://bit.do/macyearbook\">http://bit.do/macyearbook</a>) to all grade 12's that need to submit a comment.</i></p>\n";
		}
	?>
        <h1 class="splash-head"><?php echo $ovalues['fname'] . " " . $ovalues['lname'];?></h1>
		<p class="splash-subhead">
            <?php echo "<b>OEN:</b> " . $ovalues['oen'];?>
        </p>
    </div>
</div>
<div class="content-wrapper">
    <div class="content is-center">
<div class="ui-widget">
<form action="survey.php" method="post">
<table cellpadding="3" width=75% >
<tr>
	<th colspan="2">Question</th>
	<th>Males</th>
	<th>Females</th>
</tr>
<?php

$sql_query="SELECT question FROM `questions`;";
$result = mysqli_query($link,$sql_query);
$i = 0;
while($list = mysqli_fetch_array($result)){
$ii = $i + 1;
echo "<tr>\n";
echo "<th colspan=\"2\">{$ii}. {$list['question']}</th>\n";
echo /*"<td><label for=\"males\">*/"<td>";//</label>\n";
$index = "sm{$i}";
if(empty($ovalues[$index]))
	$mvalue = "";
else
	$mvalue = $ovalues[$index];
$index = "sf{$i}";
if(empty($ovalues[$index]))
	$fvalue = "";
else
	$fvalue = $ovalues[$index];
echo "<input class=\"students\" name=\"sm[]\" value=\"{$mvalue}\"></td>\n";
echo /*"<td><label for=\"females\">*/"<td>";//</label>\n";
echo "<input class=\"students\" name=\"sf[]\" value=\"{$fvalue}\"></td>\n";
echo "</tr>\n";
$i++;
}
?>

<button type="submit">Submit All</button>

</form>
</div>
</div>
</div>
</body>
</html>