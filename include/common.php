<?php
define('ADMIN_USERNAME', 'yrbkAdmin');
define('ADMIN_PASSWORD', 'yrbkPassword');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'justabou_yearbook');
function myconnect()
{
  global $link;
  $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

  if (!$link) {
      die('Connect Error (' . mysqli_connect_errno() . ') '
              . mysqli_connect_error());
  }
  //echo 'Success... ' . mysqli_get_host_info($link) . "\n";
  
  mysqli_set_charset($link, "utf8");

};

function mydc()
{
mysqli_close($link);
};

if((session_id() == '') || (session_status() == PHP_SESSION_NONE)) {
    session_start();
}
?>