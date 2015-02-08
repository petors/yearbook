<?php
include_once('../include/common.php');
myconnect();
$questions = array(
"Best Musician",
"Most Athletic",
"Best Dressed",
"Best Dancer",
"Best Smile",
"Most Artistic",
"Best Actress/Actor",
"Best Sense of Humour",
"Most Friendly",
"Most Talkative",
"Most Changed since grade 9",
"Most Likely to be late for Graduation",
"Drama Queen/King",
"Most Likely to become famous",
"Most Addicted to their phone * > phonoholic",
"Most Likely to win the lottery then lose the ticket",
"Best Laugh",
"Most Likely to Win a nobel prize"
);


/*$sql_query="CREATE TABLE questions (
id INT( 3 ) NOT NULL AUTO_INCREMENT ,
question VARCHAR( 75 ) NOT NULL ,
want INT( 3 ),
PRIMARY KEY ( id )
) ENGINE = MYISAM ;";
$result = mysqli_query($link,$sql_query);*/
//mysqli_free_result($result); /*frees space*/

/*for($i=0;$i<count($questions);$i++){
	$sql_query="INSERT INTO questions (question, want) VALUES ('{$questions[$i]}','1');";
	$result = mysqli_query($link,$sql_query);
	//mysqli_free_result($result); //frees space
}*/

/*$sql_query="SELECT COUNT(*) FROM questions;";
$result = mysqli_query($link,$sql_query);
$length = mysqli_fetch_array($result);
mysqli_free_result($result); //frees space

for($i=0;$i<$length['COUNT(*)'];$i++){
  $sql_query="ALTER TABLE `2014` ADD `sf{$i}` VARCHAR(50) NOT NULL, ADD `sm{$i}` VARCHAR(50) NOT NULL;";
  $result = mysqli_query($link,$sql_query);
}*/

?>
<!--
<html>
<body>
<table border>
<tr>
<th>id</th>
<th>question</th>
<th>y/n</th>
</tr>
<?php/*
  
  $sql_query="SELECT * FROM `questions`";
$result = mysqli_query($link,$sql_query);
while($list = mysqli_fetch_array($result)){
	if($list['want'] == 0)
		$want = "N";
	else
		$want = "Y";
		
	echo "<tr>";
	echo "<td>{$list['id']}</td>";
	echo "<td>{$list['question']}</td>";
	echo "<td>{$want}</td>";
	echo "</tr>";
}
*/
//mydc();
?>
</table>
</body>
</html>!-->