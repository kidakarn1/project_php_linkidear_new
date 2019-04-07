<?php
include("conn.php");
$id=$_GET['id'];
$sql="delete from LABLE where LABLE_ID = '$id'";
$res=$conn->query($sql);
	if ($res){
		$data['status']='1';
		// echo "<script>alert('ลบรายการสั่งทำป้ายเรียบร้อย');
		// 		window.location.href = 'select_lable.php';
		// </script>";
	}
	else{
				$data['status']='0';
	//	echo "<script>alert('ERROR แจ้ง IT 0831101923')</script>";
	}
	$sql_lable_join="select  CUSTOMER.CUS_FNAME,CUSTOMER.CUS_LNAME,LABlE.DESCRIPTION,CUSTOMER.CUS_PHONE,LABlE.ORDER_DAY,LABlE.PICK_UP_DATE,
					 LABlE.LABLE_ID,LABLE.STATUS
					 from LABLE left join STAFF
					 on(LABLE.STAFF_ID=STAFF.STAFF_ID) left join CUSTOMER on(LABLE.CUS_PHONE=CUSTOMER.CUS_PHONE) order by LABLE.ORDER_DAY DESC";
	$res_lable=$conn->query($sql_lable_join);
	while($row_lable=$res_lable->fetch_assoc()){
			$json=$row_lable;
	}
	$data['data']=$json;
	$data['total'] = $result->num_rows;
	echo json_encode($data);
	//echo json_encode($data);
?>
