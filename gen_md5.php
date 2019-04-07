<?php
include("conn.php");
$sql="select * from staff";
$res=$conn->query($sql);
$loop=$conn->query($sql);
$i=1;
while ($row=$res->fetch_assoc()){
  echo $i." ";
  echo $md5= md5($row['PASSWORD']);
  echo "<br>";
  $i++;
}
 ?>
