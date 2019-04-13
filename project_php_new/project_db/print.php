	<body>	
	<?php 
	function DateThai_kidakarn($strDate){
	$strYear = date("Y",strtotime($strDate))+543;
	$strMonth= date("n",strtotime($strDate));
	$strday_day= date("l",strtotime($strDate));
	$strDay= date("j",strtotime($strDate));
	$strHour= date("H",strtotime($strDate));
	$strMinute= date("i",strtotime($strDate));
	$strSeconds= date("s",strtotime($strDate));
	$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$strMonthThai=$strMonthCut[$strMonth];
	$day = array('Monday' => 'จันทร์', 'Tuesday' => 'อังคาร', 'Wednesday' => 'พุธ', 'Thursday' => 'พฤหัสบดี', 'Friday' => 'ศุกร์', 'Saturday' => 'เสาร์', 'Sunday' => 'อาทิตย์');
	$getday_sql=$day[$strday_day];
	return "$getday_sql $strDay $strMonthThai $strYear";
	}
	include("conn.php");
	include ("menu.php");
	if (!isset($_POST['fname'])){
	$sql_lable_join="select  CUSTOMER.CUS_FNAME,CUSTOMER.CUS_LNAME,LABLE.IMG,CATEGORY.CAT_NAME,LABLE.LABLE_WIDTH,
							 LABLE.LABLE_HEIGHT,LABLE.LABLE_NUMBER,LABLE.ORDER_DAY,LABLE.PICK_UP_DATE,
							 LABLE.STATUS,LABLE.LABLE_ID
							 from LABLE,STAFF,CUSTOMER,CATEGORY where LABLE.STAFF_ID=STAFF.STAFF_ID 
							 and  LABLE.CUS_PHONE=CUSTOMER.CUS_PHONE and LABLE.CAT_ID = CATEGORY.CAT_ID and LABLE.STATUS='ปริ้น' order by LABLE.PICK_UP_DATE desc";
	}
	else{
	$fname=$_POST['fname'];
	$sql_lable_join="select  CUSTOMER.CUS_FNAME,CUSTOMER.CUS_LNAME,LABLE.IMG,CATEGORY.CAT_NAME,LABLE.LABLE_WIDTH,
							 LABLE.LABLE_HEIGHT,LABLE.LABLE_NUMBER,LABLE.ORDER_DAY,LABLE.PICK_UP_DATE,
							 LABLE.STATUS,LABLE.LABLE_ID
							 from LABLE,STAFF,CUSTOMER,CATEGORY where LABLE.STAFF_ID=STAFF.STAFF_ID 
							 and  LABLE.CUS_PHONE=CUSTOMER.CUS_PHONE and LABLE.CAT_ID = CATEGORY.CAT_ID and LABLE.STATUS='ปริ้น' and CUSTOMER.CUS_FNAME like '%$fname%' order by LABLE.PICK_UP_DATE desc";
	}
	$res_lable_join=oci_parse($conn,$sql_lable_join);
	oci_execute($res_lable_join,OCI_DEFAULT);
	?>
	<center>
	<a href="print.php"><font color="blue">รอการปริ้นป้าย</font></a> | <a href="select_work_staff_print.php"><font color="blue">ป้ายที่จะปริ้น</font></a>
			<div class="form-group">
			      <div class="col-sm-offset-8 col-sm-2">
				  <div class="row">	  
				  <form method="post" action="">
					<div class="col-md-10"><input type="text"  class="form-control" id="firstname" name="fname" placeholder="ชื่อลูกค้า"/></div>
					<div class="col-md-2"> <button type="submit"  class="btn btn-success" id="ok">ค้นหา</button></div>
					</form>
				  </div>
				  </div>
				  </div>
	<br>
	<br>
	</center>
					<table class="container" border="1">
							<tr>
								<th bgcolor="#ffffcc"><font color="#000000">ลำดับ</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">ชื่อลูกค้า</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">รูป</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">ประเภทป้าย</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">กว้าง/เมตร</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">สูง/เมตร</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">จำนวน</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">วันรับงาน</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">วันส่งงาน</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">จัดการ</font></th>
							</tr>
							<tr>
							<?php
								$i=1;
								while($row_lable_join=oci_fetch_array($res_lable_join,OCI_BOTH)){
									if ($i%2==0){
									$color='#ccffff';
									}
									else{
									$color='#ffffff';
									}
							?>
								<th bgcolor='<?php echo $color;?>'><?php echo $i;?></th>
								<th bgcolor='<?php echo $color;?>'><?php echo  $row_lable_join['CUS_FNAME']." ".$row_lable_join['CUS_LNAME'];?></th>
								<th bgcolor='<?php echo $color;?>'><img src="image_lable/<?php echo  $row_lable_join['IMG'];?>" width="100"></th>
								<th bgcolor='<?php echo $color;?>'><?php echo  $row_lable_join['CAT_NAME'];?></th>
								<th bgcolor='<?php echo $color;?>'><?php echo  $row_lable_join['LABLE_WIDTH']." "."เมตร";?></th>
								<th bgcolor='<?php echo $color;?>'><?php echo  $row_lable_join['LABLE_HEIGHT']." "."เมตร";?></th>
								<th bgcolor='<?php echo $color;?>'><?php echo  $row_lable_join['LABLE_NUMBER']." "."ป้าย";?></th>
								<th bgcolor='<?php echo $color;?>'>
												<?php 
												$order_day=$row_lable_join['ORDER_DAY'];
												echo DateThai_kidakarn($order_day);
												?>
								</th>
								<th bgcolor='<?php echo $color;?>'>
												<?php 
												$PICK_UP_DATE=$row_lable_join['PICK_UP_DATE'];
												echo DateThai_kidakarn($PICK_UP_DATE);
												?>
								</th>
								<th bgcolor='<?php echo $color;?>'>
								<?php if ($row_lable_join['STATUS']=="ปริ้น"){?>
									<a href="update_status_lable.php?id=<?php echo $row_lable_join['LABLE_ID']?>&pinting=pinting" onclick="return confirm('คุณแน่ใจช่ายมั้ยที่จะรับงาน?')"><font color="blue"><?php echo $row_lable_join['STATUS'];?></a>
								<?php
								}
									else{?>
									<font color="red"><?php echo $row_lable_join['STATUS'];?>
									<?php
									}?>
								</th>
								</tr>
							<?php $i++;}
							?>
						</table>
		<?php include("footer.php");?>
	</body>
</html>