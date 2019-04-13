<?php
@SESSION_START();
include("conn.php");
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
$sql_count_lable ="select count(lable_id) as LB from lable";
$res_count_lable=oci_parse($conn,$sql_count_lable);
oci_execute($res_count_lable,OCI_DEFAULT);
$row_count_lable=oci_fetch_array($res_count_lable,OCI_BOTH);
date_default_timezone_set('asia/bangkok');
$lable_id=date('ymd').$row_count_lable['LB']+1;
$order_day=date('d/m/Y');
$pick_up_date=date('d')+4;
$pick_up_date=$pick_up_date.'/'.date('m/Y');
$sql_check_customer ="select CUS_PHONE from CUSTOMER";
$res_check_customer=oci_parse($conn,$sql_check_customer);
oci_execute($res_check_customer,OCI_DEFAULT);
$sql_category="select CAT_ID,WIDTH,HEIGHT from category";
$res_width=oci_parse($conn,$sql_category);
oci_execute($res_width,OCI_DEFAULT);
	while ($row_width=oci_fetch_array($res_width,OCI_BOTH)){
		if ($row_width['CAT_ID']==$cat_id){
			if ($row_width['WIDTH']>=$width && $row_width['HEIGHT']>=$height){
				$up_width= $row_width['WIDTH']-$width;
				$up_height= $row_width['HEIGHT']-$height;
				$sql_up_cat="update CATEGORY set WIDTH='$up_width',HEIGHT='$up_height' where CAT_ID='$cat_id'";
				$res_up_cat=oci_parse($conn,$sql_up_cat);
				$obj_up_cat=oci_execute($res_up_cat,OCI_DEFAULT);
				if ($obj_up_cat){
					oci_commit($conn);
				}
				else{
					oci_rollback($conn);
				}
		}
		else{
			echo "<script>
			alert('ไวนิลไม่พอสำหรับการปริ้น')
		    window.location.href = 'index.php';
		    </script>";
		}
	}
}
$check=0;
while ($row_check_customer=oci_fetch_array($res_check_customer,OCI_BOTH)){
		if ($row_check_customer['CUS_PHONE']==$phone){
			$check=1;
		}
}
		if ($check==1){
			$sql_cus="update CUSTOMER set 
			CUS_FNAME='$fname',
			CUS_LNAME='$lname',
			CUS_ADDRESS='$address',
			CUS_EMAIL='$email'
			where CUS_PHONE='$phone'";
		}
		else{
			$sql_cus="insert into CUSTOMER values(
			'$fname',
			'$lname',
			'$address',
			'$email',
			'$phone')";
		}

$res_cus=oci_parse($conn,$sql_cus);
$obj_customer=oci_execute($res_cus,OCI_DEFAULT);
$sql_insert_lable="insert into LABLE values(
'$lable_id',
'$_SESSION[STAFF_ID]',
'$phone',
'$height',
'$width',
'$cat_id',
'$number',
'$descrption',
'$total',
to_date('$order_day','DD/MM/YYYY'),
to_date('$pick_up_date','DD/MM/YYYY'),
'',
'รับงาน')";
$res_insert_lable=oci_parse($conn,$sql_insert_lable);
$obj_lable=oci_execute($res_insert_lable,OCI_DEFAULT);
	if ($obj_lable && $obj_customer){
		oci_commit($conn);
		echo "<script>
				alert('ทำรายการเสร็จสิ้น');
				window.location.href = 'index.php';
			</script>";
	}
	else{
		oci_rollback($conn);
		echo "<script>alert('ERROR แจ้ง IT 0831101923')</script>";
	}
?>