<?php
include("conn.php");
$id=$_GET['id'];
$sql="delete from LABLE where LABLE_ID = '$id'";
$res=oci_parse($conn,$sql);
$obj_delete=oci_execute($res,OCI_DEFAULT);
	if ($obj_delete){
		oci_commit($conn);
		echo "<script>alert('ลบรายการสั่งทำป้ายเรียบร้อย');
				window.location.href = 'select_lable.php';
		</script>";
	}
	else{
		oci_rollback($conn);
		echo "<script>alert('ERROR แจ้ง IT 0831101923')</script>";
	}
?>