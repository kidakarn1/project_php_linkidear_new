	<?php 
	@SESSION_START();
		$limit =(!isset($_SESSION['limit'])) ? $_SESSION['limit']  :20;
		if ($limit>20){
			$pq=$_GET['number_page'];
		}
		echo $limit."<br>";
		//if ($_GET['number_page']!=null){
		//	$limit=20+$_GET['number_page'];
		//}
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
		 $sql_lable_join="select  CUSTOMER.CUS_FNAME,CUSTOMER.CUS_LNAME,LABlE.DESCRIPTION,CUSTOMER.CUS_PHONE,LABlE.ORDER_DAY,LABlE.PICK_UP_DATE,
					 LABlE.LABlE_ID,LABlE.STATUS
					 from LABLE left join STAFF  
					 on(LABLE.STAFF_ID=STAFF.STAFF_ID) left join CUSTOMER on(LABLE.CUS_PHONE=CUSTOMER.CUS_PHONE) where ROWNUM <=$limit and order by LABLE.ORDER_DAY DESC ";
	}
	else{
	$fname=$_POST['fname'];
	$sql_lable_join="select  CUSTOMER.CUS_FNAME,CUSTOMER.CUS_LNAME,LABlE.DESCRIPTION,CUSTOMER.CUS_PHONE,LABlE.ORDER_DAY,LABlE.PICK_UP_DATE,
					 LABlE.LABlE_ID,LABlE.STATUS
					 from LABLE left join STAFF  
					 on(LABLE.STAFF_ID=STAFF.STAFF_ID) left join CUSTOMER on(LABLE.CUS_PHONE=CUSTOMER.CUS_PHONE) where  
					 CUSTOMER.CUS_FNAME like '%$fname%' and ROWNUM <=$limit
					 order by LABLE.ORDER_DAY DESC ";
	}
	$res_lable_join=oci_parse($conn,$sql_lable_join);
	oci_execute($res_lable_join,OCI_DEFAULT);
	?>
	<center>
	<a href="select_lable.php"><font color="blue">รายการสั่งทำป้าย</font></a> | <a href="select_work_staff.php"><font color="blue">ป้ายที่รับมอบหมาย</font></a>

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
					<table class="container" border="1">
							<tr>
								<th bgcolor="#ffffcc"><font color="#000000">ลำดับ</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">ชื่อลูกค้า</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">รายละเอียดของงาน</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">เบอร์โทรลูกค้า</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">วันรับงาน</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">วันส่งงาน</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">สถานะ</font>	</th>
								<th bgcolor="#ffffcc"><font color="#000000">จัดการ</font>	</th>
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
								<th bgcolor='<?php echo $color;?>'><?php echo  $row_lable_join['DESCRIPTION'];?></th>
								<th bgcolor='<?php echo $color;?>'><?php echo  $row_lable_join['CUS_PHONE'];?></th>
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
								<?php if ($_SESSION['DEP_ID']!="SV" && $row_lable_join['STATUS']=="รับงาน"){?>
									<a href="update_status_lable.php?id=<?php echo $row_lable_join['LABLE_ID']?>" onclick="return confirm('คุณแน่ใจช่ายมั้ยที่จะรับงาน?')"><font color="blue"><?php echo $row_lable_join['STATUS'];?></a>
								<?php
								}
									else{
										if ($row_lable_join['STATUS']!="เสร็จสิ้น"){echo "<font color='red'>";}
										else {echo "<font color='green'>";}
										?>
										<?php echo $row_lable_join['STATUS'];?></font>
									<?php
									}?>
								</th>
								<?php if ($_SESSION['DEP_ID']=="SV"  && $row_lable_join['STATUS']=="รับงาน"){?>
								<th><a href="edit_lable.php?id=<?php echo $row_lable_join['LABLE_ID']?>"><img src="icon_image/edit.png" width="30"></a> |
								<a href="delete_lable.php?id=<?php echo $row_lable_join['LABLE_ID']?>" onclick="return confirm('คุณแน่ใจช่ายมั้ยที่จะลบข้อมูล?')"><font color="blue"><img src="icon_image/del.png" width="30"></font></th>
								<?php }
								else if ($_SESSION['DEP_ID']=="MG"  && $row_lable_join['STATUS']=="รับงาน"){
								?>
								<th><a href="edit_lable.php?id=<?php echo $row_lable_join['LABLE_ID']?>"><img src="icon_image/edit.png" width="30"></a> |
								<a href="delete_lable.php?id=<?php echo $row_lable_join['LABLE_ID']?>" onclick="return confirm('คุณแน่ใจช่ายมั้ยที่จะลบข้อมูล?')"><font color="blue"><img src="icon_image/del.png" width="30"></font></th>
								<?php }?>
								</tr>
							<?php 
								$i++;}//end while
								$count_sql="select count(LABLE_ID) AS COUNT_LABLE from LABLE";
								$count_res=oci_parse($conn,$count_sql);
								oci_execute($count_res,OCI_DEFAULT);
								$count_row=oci_fetch_array($count_res,OCI_BOTH);
								$number_page=$count_row['COUNT_LABLE']/20;
								for ($i=1;$i<=$number_page;$i++){
									$_SESSION['limit']=$i;
									echo "<a href='test_limit.php?number_page=$i'>"." ".$i." "."</a>";
								}
							?>

						</table>
						</center>
		<?php 
		$data = array('Monday' => 'จันทร์', 
					  'Tuesday' => 'อังคาร',
					  'Wednesday' => 'พุธ',
					  'Thursday' => 'พฤหัสบดี', 
					  'Friday' => 'ศุกร์', 
					  'Saturday' => 'เสาร์', 
					  'Sunday' => 'อาทิตย์');
		
		
		
		include("footer.php");?>
	</body>
</html>