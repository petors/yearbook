<?php
include_once('../include/common.php');
myconnect();

$errorstr = "";
$oen = "";

//**CHECK FOR SOME SORT OF INPUT
if(empty($_REQUEST['oen']) || !isset($_REQUEST['oen']))
	$errorstr = "Please Enter an OEN";
elseif(!is_numeric($_REQUEST['oen']))
	$errorstr = "Please Enter a Valid OEN";
else{
	$oen = mysqli_real_escape_string($link,$_REQUEST['oen']);
}
//**CHECK IF STUDENT NUMBER IS IN DATABASE
	$sql_query="SELECT id,comment,accessed FROM `2014` WHERE oen = '{$oen}'";
	$result = mysqli_query($link,$sql_query);
	$list = mysqli_fetch_array($result);
	mysqli_free_result($result); /*frees space*/

	if(!isset($list))
		$errorstr = "Please Enter a Valid OEN";
	elseif($list['accessed'] == "1"){
		$errorstr = "You have already accessed your comment";
	}else{
		$_SESSION['comment'] = $list['comment'];
		$_SESSION['id'] = $list['id'];
		header('Location: mainedit.php');
		die('Redirecting...');
	}
}
if(!isset($_REQUEST['oen']))
	$errorstr = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta property="og:title" content="MAC Yearbook" />
<meta name="description" content="MAC Yearbook Graduate Comment/Survey input page.">

    <title>MAC Yearbook Comment/Survey</title>
<link rel="stylesheet" href="../include/pure.css">

        <link rel="stylesheet" href="../include/main-grid.css">

        <link rel="stylesheet" href="../include/marketing.css">
		<link rel="icon" type="image/gif" href="../img/tabicon.gif" />
</head>
<body>
<div class="header">
    <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
        <h4 class="pure-menu-heading">MAC Yearbook</h4>

        <ul>
            <li class="pure-menu-selected"><a href="#form">Home</a></li>
        </ul>
    </div>
</div>

<div class="splash-container">
    <div class="splash">
        <h1 class="splash-head">Grad<br>Comments/Survey</h1>
		<p class="splash-subhead">
			<!--<a href="#form">Submit your grad comment & survey responses here</a><br>!-->
			<font color="ff0000"><u>A reminder that the deadline is <b>March 20th</b>.</u></font><br>
			<!--<i>Help us by sharing this link (<a href="http://bit.do/macyearbook">http://bit.do/macyearbook</a>) to all grade 12's that need to submit a comment.</i></p>!-->
		</p>
    </div>
</div>

<div class="content-wrapper" id="form">
    <div class="content">
        <div class="pure-g">
            <div class="l-box-lrg pure-u-1 pure-u-med-2-5">
				<?php echo "<h4><font color=\"ff0000\">" . $errorstr . "</font></h4>\n";?>
                <form action="#form" method="post" class="pure-form pure-form-stacked">
                    <fieldset>

                        <label for="oen">Your Ontario Education Number</label>
                        <input id="oen" name="oen" size="40" maxlength="9" placeholder="Your OEN">
                        <button type="submit" class="pure-button">Get Started</button>
						<!--<input id="oen" name="oen" size="40" placeholder="Comments and Survey are now closed">
                        <button type="reset" class="pure-button">Closed</button>!-->
                    </fieldset>
                </form>
            </div>

            <div class="l-box-lrg pure-u-1 pure-u-med-3-5">
                <h4>This Website</h4>
                <p>
                    This website was developed by the MAC Yearbook Committee as an easily accessible site for graduates to input their graduate comments and survey responses for their yearbook.
					<br><font color="000000"><b><i><u>Please be advised that your comment will only be in the yearbook if you took a graduation photo. If you did not take one, your comment will not be in the yearbook, regardless of your use of this website.</u></i></b></font>
                </p>

                <h4>How to Login</h4>
                <p>
                    Login requires your Ontario <b>Education Number (OEN)</b> that is personal to you. This way, we can ensure that only you can access your comment and survey results. Your OEN should be on any official school document, such as your report card. If you aren't sure where to obtain yours, email us at <u><b>its.yearbook@gmail.com</b></u> or contact your guidance counselor.
                </p>
            </div>
        </div>

    </div>
	
    <div class="ribbon l-box-lrg pure-g">
        <div class="l-box-lrg is-center pure-u-1 pure-u-med-1-2 pure-u-lrg-2-5">
            <img class="pure-img-responsive" alt="File Icons" width="300" src="../img/file-icons.png">
        </div>
        <div class="pure-u-1 pure-u-med-1-2 pure-u-lrg-3-5">

            <h2 class="content-head content-head-ribbon">CONTACT US</h2>

            <p>
                If you have any issues or questions regarding this website or about the graduate comment/survey, please feel free to email us at <u><b>its.yearbook@gmail.com</b></u>.
            </p>
        </div>
    </div>


    <div class="footer l-box is-center">
        &copy;2014 MAC YEARBOOK
    </div>

</div>
</body>
</html>