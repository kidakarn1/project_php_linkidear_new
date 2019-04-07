<?php 
include("conn.php");
$sql="select * from CUSTOMER";
$res=oci_parse($conn,$sql);
oci_execute($res,OCI_DEFAULT);
$sql1="select * from STAFF";
$res1=oci_parse($conn,$sql1);
oci_execute($res1,OCI_DEFAULT);
$sql2="select * from LABLE";
$res2=oci_parse($conn,$sql2);
oci_execute($res2,OCI_DEFAULT);
?>
<?php $i=1;while ($row=oci_fetch_array($res,OCI_BOTH)){echo $i;?>
insert into CUSSTOMER values ('<?php echo $row['CUS_FNAME']?>','<?php echo $row['CUS_LNAME']?>','<?php echo $row['CUS_ADDRESS']?>','<?php echo $row['CUS_EMAIL']?>','<?php echo $row['CUS_PHONE']?>');
<br>
<?php $i++;}?>
<br>
<br>
<br>
<?php $i=1;while ($row1=oci_fetch_array($res1,OCI_BOTH)){echo $i;?>
insert into STAFF values ('<?php echo $row1['STAFF_ID']?>','<?php echo $row1['USERNAME']?>','<?php echo $row1['PASSWORD']?>','<?php echo $row1['FNAME']?>','<?php echo $row1['LNAME']?>','<?php echo $row1['PHONE']?>','<?php echo $row1['EMAIL']?>','<?php echo $row1['ADDRESS']?>','<?php echo $row1['SALARY']?>','<?php echo $row1['DEP_ID']?>','<?php echo $row1['IMG']?>');
<br>
<?php $i++;}?>
<br>
<br>
<br>
<?php $i=1;
	$lable_id_new=1811071;
	$img=31;
	while ($row2=oci_fetch_array($res2,OCI_BOTH)){
?>
insert into LABLE values ('<?php echo $lable_id_new;?>','<?php echo $row2['STAFF_ID']?>','<?php echo $row2['CUS_PHONE']?>','<?php echo $row2['LABLE_HEIGHT']?>','<?php echo $row2['LABLE_WIDTH']?>','<?php echo $row2['CAT_ID']?>','<?php echo $row2['LABLE_NUMBER']?>','<?php echo $row2['DESCRIPTION']?>','<?php echo $row2['TOTAL']?>','<?php echo $row2['ORDER_DAY']?>','<?php echo $row2['PICK_UP_DATE']?>','<?php echo $img.'.jpg';?>','<?php echo $row2['STATUS']?>');
<br>
<?php $img++;$lable_id_new++;$i++;}?>