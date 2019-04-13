<?php
@SESSION_START();
if (empty($_SESSION['STAFF_ID'])){
  echo "<script>window.location.href = 'index.php';
  	</script>";
}
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
// $width=$width*$number;
// $height=$height*$number;
$total=($width*$height)*$price*$number;
$sql_count_lable ="select count(lable_id) as LB from lable";
$res_count_lable=$conn->query($sql_count_lable);
$row_count_lable=$res_count_lable->fetch_array();
date_default_timezone_set('asia/bangkok');
$lable_id=date('ymd').$row_count_lable['LB']+1;
$order_day=date('Y/m/d');
$pick_up_date=date('Y/m');
$d=date('d')+4;
$pick_up_date=$pick_up_date.'/'.$d;
$sql_check_customer ="select CUS_PHONE from CUSTOMER";
$res_check_customer=$conn->query($sql_check_customer);
$sql_category="select CAT_ID,WIDTH,HEIGHT from category";
$res_width=$conn->query($sql_category);
	while ($row_width=$res_width->fetch_array()){
		if ($row_width['CAT_ID']==$cat_id){
			if ($row_width['WIDTH']>=$width && $row_width['HEIGHT']>=$height){
				$up_width= $row_width['WIDTH']-$width;
				$up_height= $row_width['HEIGHT']-$height;
				$sql_up_cat="update CATEGORY set WIDTH='$up_width',HEIGHT='$up_height' where CAT_ID='$cat_id'";
				$res_up_cat=$conn->query($sql_up_cat);
				if (!$res_up_cat){
					echo "<script>
					alert('ไม่สำเร็จ')
				    window.location.href = 'index.php';
				    </script>";
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
while ($row_check_customer=$res_check_customer->fetch_array()){
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
			$sql_cus="insert into CUSTOMER (CUS_FNAME, CUS_LNAME, CUS_ADDRESS, CUS_EMAIL, CUS_PHONE) VALUES
      (
			'$fname',
			'$lname',
			'$address',
			'$email',
			'$phone')";
		}
$res_cus=$conn->query($sql_cus);
$sql_insert_lable="insert into LABLE (LABLE_ID, STAFF_ID, CUS_PHONE, LABLE_HEIGHT, LABLE_WIDTH, CAT_ID, LABLE_NUMBER,DESCRIPTION, TOTAL, ORDER_DAY, PICK_UP_DATE, IMG, STATUS)
values(
'$lable_id',
'$_SESSION[STAFF_ID]',
'$phone',
'$height',
'$width',
'$cat_id',
'$number',
'$descrption',
'$total',
'$order_day',
'$pick_up_date',
'',
'รับงาน')";
$_SESSION['CUS_PHONE']=$phone;//ใช้เพื่ออกบิล
$res_insert_lable=$conn->query($sql_insert_lable);
if ($res_cus && $res_insert_lable){
		echo "<script>
				alert('ทำรายการเสร็จสิ้น');
				window.location.href = 'print_bill.php';
			</script>";
	}
	else{
		echo "<script>alert('ERROR แจ้ง IT 0831101923')</script>";
	}
?>
