<?php
$host="localhost";
$user="root";
$pass="12345678";
$db="shop_label";
$conn = new mysqli($host,$user,$pass,$db);
$conn->set_charset('utf8');
if (!$conn){
  echo "CONNECT ERROR";
}
?>
