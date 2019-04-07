<?php
session_start();
include("conn.php");
$username=$_POST['username'];
$password=$_POST['password'];
$sql="select * from staff where username='$username' and password='$password'";
$res=$conn->query($sql);
$row = $res->fetch_assoc();
//echo $sql;
if ($row['STAFF_ID']!=null){
	$_SESSION['STAFF_ID']=$row['STAFF_ID'];
	$_SESSION['USERNAME']=$row['USERNAME'];
	$_SESSION['FNAME']=$row['FNAME'];
	$_SESSION['DEP_ID']=$row['DEP_ID'];
	$data= array(
		'status'=>'1',
		'username'=>$_SESSION['USERNAME']
	);
}
else{
	$data = array(
		'status'=>'0',
		'username'=>''
	);

}
	echo json_encode($data);
?>
