<?php
@SESSION_START();
include("conn.php");
$username=$_POST['username'];
$password=$_POST['password'];
$sql="select * from staff where username='$username' and password='$password'";
$res=oci_parse($conn,$sql);
oci_execute ($res,OCI_DEFAULT);
$row = oci_fetch_array($res,OCI_BOTH);
//echo $sql;
if ($row['STAFF_ID']!=null){
	$_SESSION['STAFF_ID']=$row['STAFF_ID'];
	$_SESSION['USERNAME']=$row['USERNAME'];
	$_SESSION['FNAME']=$row['FNAME'];
	$_SESSION['DEP_ID']=$row['DEP_ID'];
echo "<script>window.location.href = 'index.php';
	</script>";
}
else{
	echo "<script> alert('ชื่อผู้ใช้ หรือ รหัสผ่าน ไม่ถูกต้อง');
	window.location.href = 'index.php';
	</script>";
}
?>