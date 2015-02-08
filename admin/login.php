<?php
include_once('../include/common.php');

$errorstr = "";

//**CHECK FOR SOME SORT OF INPUT
if((empty($_REQUEST['pw']) || !isset($_REQUEST['pw'])) || (empty($_REQUEST['uname']) || !isset($_REQUEST['uname'])))
	$errorstr = "Please Fill All Fields";
else{
	if(!($_REQUEST['pw'] === ADMIN_PASSWORD) || !($_REQUEST['uname'] === ADMIN_USERNAME))
		$errorstr = "u r rong";
	else{
		$_SESSION['id'] = "admin";
		header('Location: mainmenu.php');
		die('Redirecting...');
	}
}
if(!isset($_REQUEST['uname']) && !isset($_REQUEST['pw']))
	$errorstr = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
body
{
margin-left:40%;
margin-right:40%;

}
</style>
    <meta charset="utf-8">

    <title>MAC Yearbook Admin</title>
</head>
<body>
                <form action="login.php" method="post">
<?php echo "<h4><font color=\"ff0000\">" . $errorstr . "</font></h4>\n";?>

<table>
<tr>
<td>Username:</td>
<td><input type="text" name="uname" value="" size="15"></td>
</tr><tr>
<td>Password:</td>
<td><input type="password" name="pw" value="" size="15"></td>
</tr><tr>
                        <td colspan="2"><input type="submit" value="Submit"></td>
</tr>
</table>
                </form>
 
</body>
</html>