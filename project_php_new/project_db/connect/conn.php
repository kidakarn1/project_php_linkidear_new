<?php
@SESSION_START();
$db="(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=202.44.47.69)(PORT=1521)))(CONNECT_DATA=(SID=oraclesv0)))";
$user='6106021420029';
$pass='1209501100690';
$conn=oci_connect($user,$pass,$db,'AL32UTF8');
/*if ($conn){
echo "CONNECT OK";
	?>
	<br>
	<?php
	}
else {
echo "CONNECT_ERROR";
}*/
?>