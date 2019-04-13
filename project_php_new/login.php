<?php
@SESSION_START();
include("conn.php");
$username=$_POST['username'];
$p=$_POST['password'];
$password=md5($p);
$sql="select * from staff where username='$username' and password='$password'";
$res=$conn->query($sql);
$row = $res->fetch_array();
//echo $sql;
// if ($row['DEP_ID'] == 'AC') {
//     $_SESSION['STAFF_ID'] = $row['STAFF_ID'];
//     $_SESSION['USERNAME'] = $row['USERNAME'];
//     echo $_SESSION['STAFF_ID'];
//     echo $_SESSION['USERNAME'];
//     echo "OK";
//     header("location: AC/income/income.php");
// }
if ($row['status']=="O"){
  echo "<script>alert('ผู้ใช้นี้กำลังใช้งานอยู่');window.location.href = 'index.php';
  	</script>";
}
 else if ($row['STAFF_ID']!=null){
	$_SESSION['STAFF_ID']=$row['STAFF_ID'];
  $sql_up_status="update staff set status = 'O' where STAFF_ID = '$_SESSION[STAFF_ID]'";
  $res_up_status=$conn->query($sql_up_status);
    if(!$res_up_status){
      echo "<script>alert('การupdate status มีปัญหา');
      	</script>";
    }
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
