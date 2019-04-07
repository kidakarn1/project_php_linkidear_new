<?php
@SESSION_START();
if (empty($_SESSION['STAFF_ID'])){
  echo "<script>window.location.href = 'index.php';
  	</script>";
}
include("conn.php");
echo $_SESSION['DEP_ID'];
$lable_id=$_GET['id'];
$check=(isset($_GET['check'])) ? $_GET['check'] : '';
echo $check_status="select * from lable where LABLE_ID='$lable_id'";
$check_res_status=$conn->query($check_status);
$row=$check_res_status->fetch_assoc();
if ($_SESSION['DEP_ID']=='GP'){
	$status='กำลังออกแบบ';
}
else if ($_SESSION['DEP_ID']=='PS' && $_GET['pinting']!=null){
	$status='กำลังปริ้น';
}
else if ($_SESSION['DEP_ID']=='PS' && $_GET['pinting']==null){
$status='ปริ้น';
}
if ($check!=null){
	$status='เสร็จสิ้น';
}
if ($_SESSION['DEP_ID']=='MG'){
	if ($row['STATUS']=='รับงาน'){
			echo $status='กำลังออกแบบ';
	}
	else if ($row['STATUS']=='กำลังออกแบบ'){
		  echo $status='ปริ้น';
	}
	else if ($row['STATUS']=='ปริ้น'){
		  echo $status='กำลังปริ้น';
	}
	else if ($row['STATUS']=='กำลังปริ้น'){
			echo $status='เสร็จสิ้น';
	}
}
if ($lable_id!=null){
	$sql_update="update LABLE set
				 STAFF_ID='$_SESSION[STAFF_ID]',
				 STATUS='$status'
				 where LABLE_ID = '$lable_id'";
	$res_update=$conn->query($sql_update);
		if ($_SESSION['DEP_ID']=='GP' || $_SESSION['DEP_ID']=='MG'){
		// echo 'เข้า';
		header('location: select_work_staff.php');
		}
		else{
			// echo 'ไม่เข้า';
		header('location: select_work_staff_print.php');
		}

}
else{
header('location: index.php');
}
?>
