function check_pass(){
  var check_path_js = $("#check_path_js").val();
  var pass_old=$("#pass_old").val();
  var pass_new=$("#pass_new").val();
  var con_pass=$("#con_pass").val();
  var url="";
  if (check_path_js==''){
   url ="check_pass.php";
  }
  else{
   url ="../check_pass.php";
  }
  console.log(url);
  var path=$.ajax({
    url:url,
    type:"POST",
    dataType:"json",
    data:{pass_old:pass_old,pass_new:pass_new,con_pass:con_pass}
  });
  console.log(path);
  path.done(function(data){
    if (data.check_null_pass=='null_pass_old'){
      alert ("กรุณาใส่รหัสผ่านเก่า");
    }
    if (data.check_null_pass=='null_pass_all'){
      alert ("กรุณาใส่รหัสผ่านใหม่หรือใส่รหัสยืนยัน");
    }
    if (data.status=='NO_OK'){
      alert ("ERROR_0X313_326");
    }
    if (data.check_pass=='NO_OK'){
      alert ("ยืนยันรหัสผิด");
    }
    if (data.check_old=='OK'){
      alert ("แก้ไขรหัสผ่านเสร็จสิ้น");
      window.location.href='logout.php';
    }
    else if(data.check_old=='NO_OK'){
      alert ("รหัสเก่าผิด");
    }
    console.log(data);
  });
  // alert(pass_old);
}
