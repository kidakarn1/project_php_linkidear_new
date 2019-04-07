<?php
@SESSION_START();
include("conn.php");
$data['status']='';
$data['DEP_ID']='';
$lable_id=$_GET['id'];
$check=(isset($_GET['check'])) ? $_GET['check'] : '';

if ($_SESSION['DEP_ID']=='GP'){
	$data['status']='กำลังออกแบบ';
}
else if ($_SESSION['DEP_ID']=='PS' && $_GET['pinting']!=null){
	$data['status']='กำลังปริ้น';
}
else if ($_SESSION['DEP_ID']=='PS' && $_GET['pinting']==null){
	$data['status']='ปริ้น';
}
if ($check!=null){
	$data['status']='เสร็จสิ้น';
}
if ($lable_id!=null){
	$sql_update="update LABLE set
				 STAFF_ID='$_SESSION[STAFF_ID]',
				 STATUS='$status'
				 where LABLE_ID = '$lable_id'";
	$res_update=$conn->query($sql_update);
		if ($_SESSION['DEP_ID']=='GP'){
			$data['DEP_ID']='GP'
	//	header('location: select_work_staff.php');
		}
	// 	else{
	// //	header('location: select_work_staff_print.php');
	// 	}
}
else{
//header('location: index.php');
}
echo json_encode($data);
?>
