<?php
SESSION_START();
include("conn.php");
$pass_old=$_POST['pass_old'];
$check_pass_old_null=$_POST['pass_old'];
$pass_old=md5($pass_old);
$pass_new=$_POST['pass_new'];
$con_pass=$_POST['con_pass'];
if ($check_pass_old_null==null){
    $data['check_null_pass']='null_pass_old';
}
else if ($pass_new==null ||  $con_pass==null){
    $data['check_null_pass']='null_pass_all';
}
else if ($pass_new==$con_pass){
    $con_pass=md5($con_pass);
    $sql="select STAFF_ID,PASSWORD from staff where PASSWORD='$pass_old' and STAFF_ID='{$_SESSION['STAFF_ID']}'";
    $res=$conn->query($sql);
    $res_OK=$conn->query($sql);
    $row=$res_OK->fetch_array();
    $data['check_old']=($pass_old==$row['PASSWORD'])? 'OK' : 'NO_OK';
    if ($res && $data['check_old']=='OK'){
      $update="update staff set PASSWORD ='$con_pass' where STAFF_ID='{$_SESSION['STAFF_ID']}'";
      $res_up=$conn->query($update);
      if ($res_up){
      $data['status']='OK';
      }
      else{
        $data['status']='NO_OK';
      }
    }

}
else{
  $data['check_pass']='NO_OK';
}
echo json_encode($data);
 ?>
