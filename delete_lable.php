<?php

include("conn.php");
$id=$_GET['id'];
$sql="delete from LABLE where LABLE_ID = '$id'";
$res=$conn->query($sql);
	if ($res){
		echo "<script>alert('ลบรายการสั่งทำป้ายเรียบร้อย');
				window.location.href = 'select_lable.php';
		</script>";
	}
	else{
		echo "<script>alert('ERROR แจ้ง IT 0831101923')</script>";
	}
?>
