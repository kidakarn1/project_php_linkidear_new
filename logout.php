<?PHP
	session_start();
$check=$_SESSION['STAFF_ID'];
	session_destroy();
if ($check=="AC"){
	header("location: ../index.php");
}
else{
		header("location: index.php");
}
?>
