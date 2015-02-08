<?php include_once('../include/common.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAC Yearbook Comment</title>
<link rel="stylesheet" href="../include/pure.css">
<link rel="stylesheet" href="../include/main-grid.css">
<link rel="stylesheet" href="../include/marketing.css">
<link rel="icon" type="image/gif" href="../img/tabicon.gif" />
<!--<link rel="stylesheet" href="../include/style.css">!-->
</head>
<?php
myconnect();

if(!isset($_SESSION['id']))
	die('<h1>You are not logged in. Please log in <a href="login.php">here</a>.</h1>');

$id = $_SESSION['id'];

if(!isset($_REQUEST['comment']) || empty($_REQUEST['comment']))
	$comment = $_SESSION['comment'];
else
	$comment = $_REQUEST['comment'];

if($_SESSION['comment'] == $comment){
	$updated = 0;
}else{
	$updated = 1;

	$comment = mysqli_real_escape_string($link,$_REQUEST['comment']);
	
	$sql_query="UPDATE `2014` SET comment='{$comment}', accessed ='1' WHERE id = '{$id}'";
	$result = mysqli_query($link,$sql_query);
}
//**GRABS INFO
$sql_query="SELECT * FROM `2014` WHERE id = '{$id}'";
$result = mysqli_query($link,$sql_query);
$list = mysqli_fetch_array($result);
mysqli_free_result($result); /*frees space*/

if($list['gender'] == 0)
	$gender = "M";
else
	$gender = "F";
?>
<body>

<div class="header">
    <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
        <h4 class="pure-menu-heading">MAC Yearbook</h4>

        <ul>
            <li class="pure-menu-selected"><a href="mainedit.php">Comment</a></li>
            <!--<li><a href="survey.php">Survey</a></li>!-->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>
<div class="splash-container">
    <div class="splash">
	<?php
		if($updated == 1){
			echo "<p class=\"splash-subhead\"><strong>Your Information has been updated.<br>\n";
			//echo "<a href=\"survey.php\">Do the Survey</a> or ";
			echo "<a href=\"logout.php\">Logout here</a></strong><br>\n";
			//echo "<i>Help us by sharing this link (<a href=\"http://bit.do/macyearbook\">http://bit.do/macyearbook</a>) to all grade 12's that need to submit a comment.</i></p>\n";
		}
	?>
        <h1 class="splash-head"><?php echo $list['fname'] . " " . $list['lname'];?></h1>
		<p class="splash-subhead">
            <?php echo "<b>OEN:</b> " . $list['oen'];?>
        </p>
    </div>
</div>
<div class="content-wrapper">
    <div class="content is-center">
        <!--<div class="pure-g">!-->
			<div class="box-lrg pure-u-1 pure-u-med-2-5">
    <form action="mainedit.php" method="POST" class="pure-form">
	<fieldset>
        <label for="comment">Your Yearbook Comment (250 char limit):</label>
		<textarea id="comment" name="comment" cols="50" rows="10" maxlength="250"><?php echo $list['comment'] ?></textarea>
	  <button type="submit" class="pure-button">Submit</button>
	  <button type="reset" class="pure-button">Reset</button>
	  </fieldset>
    </form>
	</div>
	</div>

    <div class="footer l-box is-center">
        &copy;2014 MAC YEARBOOK
    </div>

</div>
</body>
</html>