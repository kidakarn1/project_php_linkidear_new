	<body>	
	<?php 
	include("conn.php");
	include ("menu.php");
	$sql_lable_join="select distinct STAFF.FNAME,STAFF.LNAME,STAFF.PHONE from LABLE,STAFF where LABLE.STAFF_ID=STAFF.STAFF_ID and LABLE.STATUS='กำลังออกแบบ'";
	$res_lable_join=oci_parse($conn,$sql_lable_join);
	oci_execute($res_lable_join,OCI_DEFAULT);
	?>
					<table class="container" border="1">
							<tr>
								<th bgcolor="#ffffcc"><font color="#000000">ลำดับ</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">ชื่อ</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">สกุล</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">เบอร์โทร</font></th>
							</tr>
							<tr>
							<?php
								$i=1;
								while($row_lable_join=oci_fetch_array($res_lable_join,OCI_BOTH)){
							?>
								<th><?php echo $i;?></th>
								<th><?php echo  $row_lable_join['FNAME'];?></th>
								<th><?php echo  $row_lable_join['LNAME'];?></th>
								<th><?php echo  $row_lable_join['PHONE'];?></th>
								</tr>
							<?php $i++;}
							?>
						</table>
		<?php include("footer.php");?>
	</body>
</html>