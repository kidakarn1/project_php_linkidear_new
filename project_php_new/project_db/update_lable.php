<?php
@SESSION_START();
include("conn.php");
$lable_id=$_POST['lable_id'];
$fname=$_POST['firstname'];
$lname=$_POST['lastname'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$address=$_POST['address'];
$descrption=$_POST['descrption'];
$width=$_POST['width'];
$height=$_POST['height'];
$cat_id=$_POST['cat_id'];
$price=$_POST['price'];
$number=$_POST['number'];
if ($number==null || $number<=0){$number=1;}
$width=$width*$number;
$height=$height*$number;
$total=($width*$height)*$price*$number;
	$sql_cus="update CUSTOMER set 
	CUS_FNAME='$fname',
	CUS_LNAME='$lname',
	CUS_ADDRESS='$address',
	CUS_EMAIL='$email'
	where CUS_PHONE='$phone'";
$res_cus=oci_parse($conn,$sql_cus);
$obj_customer=oci_execute($res_cus,OCI_DEFAULT);
$sql_insert_lable="update LABLE set 
STAFF_ID='$_SESSION[STAFF_ID]',
CUS_PHONE='$phone',
LABLE_HEIGHT='$height',
LABLE_WIDTH='$width',
CAT_ID='$cat_id',
LABLE_NUMBER='$number',
DESCRIPTION='$descrption',
TOTAL='$total'
where LABLE_ID='$lable_id'";
$res_insert_lable=oci_parse($conn,$sql_insert_lable);
$obj_lable=oci_execute($res_insert_lable,OCI_DEFAULT);
	if ($obj_lable && $obj_customer){
		oci_commit($conn);
		echo "<script>
				alert('แก้ไขเสร็จสิ้น');
				window.location.href = 'select_lable.php';
			</script>";
	}
	else{
		oci_rollback($conn);
		echo "<script>alert('ERROR แจ้ง IT 0831101923')</script>";
	}
?>