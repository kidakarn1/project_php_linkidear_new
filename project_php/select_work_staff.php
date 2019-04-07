<script src="js/kidakarn.js" charset="utf-8"></script>
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
SESSION_START();
include("conn.php");
//include("menu.php");
$sql="select STAFF.FNAME,STAFF.LNAME,CUSTOMER.CUS_FNAME,CUSTOMER.CUS_LNAME,LABlE.DESCRIPTION,CUSTOMER.CUS_PHONE,LABlE.ORDER_DAY,LABlE.PICK_UP_DATE,
					 LABlE.LABlE_ID,LABlE.STATUS from LABLE left join STAFF
	  on(LABLE.STAFF_ID=STAFF.STAFF_ID) left join CUSTOMER on (LABLE.CUS_PHONE=CUSTOMER.CUS_PHONE) where LABLE.STAFF_ID = '$_SESSION[STAFF_ID]' order by LABLE.PICK_UP_DATE DESC";
$res=$conn->query($sql);
?>
	<center>
	<a class="show_check_product" href="#"><font color="blue">รายการสั่งทำป้าย</font></a> | <a class="show_select_work_staff" href="#"><font color="blue">ป้ายที่รับมอบหมาย</font></a>	</center>
		<table class="container" border="1">
								<tr>
									<th bgcolor="#ffffcc"><font color="#000000">ลำดับ</font></th>
									<th bgcolor="#ffffcc"><font color="#000000">ชื่อพนักงานที่รับงาน</font></th>
									<th bgcolor="#ffffcc"><font color="#000000">ชื่อลูกค้า</font></th>
									<th bgcolor="#ffffcc"><font color="#000000">รายละเอียดของงาน</font></th>
									<th bgcolor="#ffffcc"><font color="#000000">เบอร์โทรลูกค้า</font></th>
									<th bgcolor="#ffffcc"><font color="#000000">วันรับงาน</font></th>
								    <th bgcolor="#ffffcc"><font color="#000000">วันส่งงาน</font></th>
									<th bgcolor="#ffffcc" colspan="2"><font color="#000000">จัดการ</font></th>
								</tr>
								<tr>
								<?php
									$i=1;
									while($row=$res->fetch_array()){
									if ($i%2==0){
									$color='#ccffff';
									}
									else{
									$color='#ffffff';
									}
								?>
									<th bgcolor='<?php echo $color;?>'><?php echo $i;?></th>
									<th bgcolor='<?php echo $color;?>'><?php echo  $row['FNAME']." ".$row['LNAME'];?></th>
									<th bgcolor='<?php echo $color;?>'><?php echo  $row['CUS_FNAME']." ".$row['CUS_LNAME'];?></th>
									<th bgcolor='<?php echo $color;?>'><?php echo  $row['DESCRIPTION'];?></th>
									<th bgcolor='<?php echo $color;?>'><?php echo  $row['CUS_PHONE'];?></th>
									<th bgcolor='<?php echo $color;?>'>
												<?php
												$order_day=$row['ORDER_DAY'];
												echo DateThai_kidakarn($order_day);
												?>
									</th>
									<th bgcolor='<?php echo $color;?>'>
												<?php
												$PICK_UP_DATE=$row['PICK_UP_DATE'];
												echo DateThai_kidakarn($PICK_UP_DATE);
												?>
									</th>
									<?php if($row['STATUS']=="กำลังออกแบบ"){ ?>
									<form method="post" action="update_lable_img.php" enctype="multipart/form-data">
									<input type="hidden" name="lable_id" value="<?php echo  $row['LABLE_ID'];?>">
									<th><input type="file" name="file"></th>
									<th  bgcolor="#ffffcc"><input type="submit" value="ส่งงาน"></th>
									</form>
									<?php }
									else{
									echo "<th>".$row['STATUS']."</th>";
									}
									?>
									</tr>
									<?php $i++;}?>
		</table>

		<?php// include("footer.php");?>
