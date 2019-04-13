<?php 
@SESSION_START();
include("conn.php");
$lable_id=$_GET['id'];
$check=$_GET['check'];

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
if ($lable_id!=null){
	$sql_update="update LABLE set 
				 STAFF_ID='$_SESSION[STAFF_ID]',
				 STATUS='$status'
				 where LABLE_ID = '$lable_id'";
	$res_update=oci_parse($conn,$sql_update);
	$obj_res_update=oci_execute($res_update,OCI_DEFAULT);
		if ($obj_res_update){
			oci_commit($conn);
		}
		else{
		oci_rollback($conn);
		}
		if ($_SESSION['DEP_ID']=='GP'){
		header('location: select_work_staff.php');
		}
		else{
		header('location: select_work_staff_print.php');
		}
}
else{
header('location: index.php');
}
?>