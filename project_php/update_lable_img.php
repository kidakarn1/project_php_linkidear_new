<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php
include("conn.php");
$lable_id=$_POST['lable_id'];
$img=$_FILES["file"]["name"];
//กำหนด directory สำหรับเก็บ file ที่จะ upload เข้าไป
$limitfile=10000000000; 
//กำหนด ขนาด file ที่อนุญาติให้โหลดเข้ามาเก็บได้ (ต่อ 1 file) หน่วยเป็น byte
$a="image_lable/".$_FILES["file"]["name"] ;
copy($_FILES["file"]["tmp_name"],$a); 
$sql="update LABLE set IMG='$img',STATUS='ปริ้น' where LABLE_ID = '$lable_id'";
$res=oci_parse($conn,$sql);
$obj=oci_execute($res,OCI_DEFAULT);
	if ($obj){
		oci_commit($conn);
	}
	else{
	oci_rollback($conn);
	}
		echo "<script>
				alert('ส่งงานเสร็จสิ้น');
				window.location.href = 'index.php';
			</script>";
?>
</body>
</html>