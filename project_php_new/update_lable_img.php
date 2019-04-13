<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php
include("conn.php");
session_start();
if (empty($_SESSION['STAFF_ID'])){
  echo "<script>window.location.href = 'index.php';
  	</script>";
}
$lable_id=$_POST['lable_id'];
$img=$_FILES["file"]["name"];
if (empty($img)){
  echo "<script> alert('กรุณาเลือกไฟล์เพื่อส่งไปปริ้น');window.location.href = 'select_work_staff.php';
  	</script>";
}
else {
  //กำหนด directory สำหรับเก็บ file ที่จะ upload เข้าไป
  $limitfile=10000000000;
  //กำหนด ขนาด file ที่อนุญาติให้โหลดเข้ามาเก็บได้ (ต่อ 1 file) หน่วยเป็น byte
  $a="image_lable/".$_FILES["file"]["name"] ;
  copy($_FILES["file"]["tmp_name"],$a);
  $sql="update LABLE set IMG='$img',STATUS='ปริ้น' where LABLE_ID = '$lable_id'";
  $res=$conn->query($sql);
  	if ($res){
  		echo "<script>
  				alert('ส่งงานเสร็จสิ้น');
  				window.location.href = 'index.php';
  			</script>";
  	}
  	else{
  		echo "<script>
  				alert('ส่งงานไม่สำเร็จX0313_326');
  				window.location.href = 'index.php';
  			</script>";
  	}
}
?>
</body>
</html>
