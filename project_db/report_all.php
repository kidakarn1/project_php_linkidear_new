	<body>	
	<?php 
	include("conn.php");
	include ("menu.php");
	$sql_lable_join="select count(LABLE_ID) as NB from LABLE ";
	$sql_max="select max(TOTAL) as MAXH from LABLE";
	$sql_min="select min(TOTAL) as MINH from LABLE";
	$sql_salary="select FNAME || ' ' || LNAME as FLN from STAFF where SALARY=(select
				 max(SALARY) from STAFF )";
	$res_salary=oci_parse($conn,$sql_salary);
	oci_execute($res_salary,OCI_DEFAULT);
	$rowsalary=oci_fetch_array($res_salary,OCI_BOTH);
	$res_lable_join=oci_parse($conn,$sql_lable_join);
	oci_execute($res_lable_join,OCI_DEFAULT);
	$row_lable_join=oci_fetch_array($res_lable_join,OCI_BOTH);
	$resmax=oci_parse($conn,$sql_max);
	oci_execute($resmax,OCI_DEFAULT);
	$rowmax=oci_fetch_array($resmax,OCI_BOTH);
	$resmin=oci_parse($conn,$sql_min);
	oci_execute($resmin,OCI_DEFAULT);
	$rowmin=oci_fetch_array($resmin,OCI_BOTH);
	?>
					<table class="container" border="1">
							<tr>
								<th bgcolor="#ffffcc"><font color="#000000">จำนวนการสั่งซื้อ</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">ราคาการสั่งทำป้ายที่สูงที่สุด</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">ราคาการสั่งทำป้ายที่น้อยที่สุด</font></th>
								<th bgcolor="#ffffcc"><font color="#000000">พนักงานที่มีเงินเดือนสูงที่สุด</font></th>
							</tr>
							<tr>
								<th><?php echo 	$row_lable_join['NB'];?> รายการ</th>
								<th><?php echo 	$rowmax['MAXH'];?>บาท</th>
								<th><?php echo 	$rowmin['MINH'];?>บาท</th>
								<th><?php echo 	$rowsalary['FLN'];?>บาท</th>
							</tr>
						</table>
		<?php include("footer.php");?>
	</body>
</html>