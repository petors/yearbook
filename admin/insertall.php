<?php
include_once('../include/common.php');
myconnect();

$fp = fopen("grads.txt", "r") or die("No such file!\n");
while ( !feof($fp) ) {
   $str = trim(fgetss($fp));
   
   $data = explode(",", $str);
   
   $sql_query = "INSERT INTO `2014` ";
   $sql_query .= "(fname, lname, oen) ";
   $sql_query .= "VALUES (";
   $sql_query .= "'$data[1]', ";
   $sql_query .= "'$data[0]', ";
   $sql_query .= "'$data[2]')";
   $result = mysqli_query($link,$sql_query);
}
fclose($fp);
session_destroy();
?>