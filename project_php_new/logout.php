<?PHP
	session_start();
if (isset($_SESSION['STAFF_ID'])){
	include("conn.php");
	$sql_up_status="update staff set status = 'F' where STAFF_ID = '$_SESSION[STAFF_ID]'";
	$res_up_status=$conn->query($sql_up_status);
		if(!$res_up_status){
			echo "<script>alert('การupdate status มีปัญหา');
				</script>";
		}
}
$check=$_SESSION['DEP_ID'];
	session_destroy();
if ($check=="AC"){
	header("location: index.php");
}
else{
		header("location: index.php");
}
?>
