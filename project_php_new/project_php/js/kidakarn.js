$(document).ready(function(){
  //link การaction BY KIDAKARN
  $(".show_check_product").click(function(){
    $(".show_data").load("select_lable.php");
  });
  $(".show_print").click(function(){
    $(".show_data").load("print.php");
  });
  $(".show_report_design").click(function(){
    $(".show_data").load("report_design.php");
  });
  $(".show_report_lable").click(function(){
    $(".show_data").load("report_lable.php");
  });
  $(".show_report_all").click(function(){
    $(".show_data").load("report_all.php");
  });
  $(".logout").click(function(){
      $(".show_data").load("logout.php");
  });
  //จบการลิงค์
  //ลิงค์ภายในไฟล์รายการสั่งป้าย
  $(".show_select_work_staff").click(function(){
    $(".show_data").load("select_work_staff.php");
  });
  //จบลิงค์ลิงค์ภายในไฟล์
  //ลิงค์ภายในปริ้นป้าย
  $(".show_select_work_staff_print").click(function(){
    $(".show_data").load("select_work_staff_print.php");
  });
  //จบลิงค์ลิงค์ภายในไฟล์
  //updata status lable
  $(".update_status_lable").click(function(){
  //  alert('222');
    var path = $.ajax({
      type:"GET",
      dataType:"json",
      url:"update_status_lable.php",
      data:{id:id}
    });
    path.done(function(data){
      alert(data);
    });
  });

  $(".edit_lable").click(function(){
    var id = $(this).attr("sites");
    //console.log(id);
    //console.log(id);
    // var path = $.ajax({
    //   type:"GET",
    //   dataType:"json",
    //   url:"edit_lable.php",
    //   data:{id:id}
    // });
    // path.done(function(data){
    //   alert(data);
      $(".show_data").load("edit_lable.php?id="+id);
    // });
  });

  $(".delete_lable").click(function(){
    var id = $(this).attr("sites");
    var path = $.ajax({
      type:"GET",
      dataType:"json",
      url:"delete_lable.php",
      data:{id:id}
    });
    path.done(function(data){
      alert(data);
    });
//  $(".show_data").load("delete_lable.php?id="+id);
  });

  //end updata status lable
  $("#ok").click(function(){
    var username = $("#username").val();
    var password = $("#password").val();
    //alert (username+" "+password);
    if (username==""){
      $(".show_error").html("<font color='red'>กรุณาใส่ชื่อผู้ใช้</font>");
      $(".check").stop();
    }
    else if (password==""){
      $(".show_error").html("<font color='red'>กรุณาใส่รหัสผ่าน</font>");
    }
    else{
      login(username,password);
    }
    function login(username,password){
        var path = $.ajax({
          type:"POST",
          dataType:'json',
          url:"login.php",
          data:{username:username,password:password}
        });
        path.done(function(data){
            //console.log(data);
            //alert(data.username);
            if (data.status=='1'){
              alert("สำเร็จ"+" "+data.username);
              window.location.href='index.php';
            }
            else{
                $(".show_error").html("<font color='red'>ชื่อผู้ใช้หรือรหัสผิด</font>");
                $(".check").stop();
            }
          });
      }
  });
  $("#cal").click(function(){
      var width = $("#width").val();
      var height = $("#height").val();
      var number = $("#number").val();
      var price = $("#price").val();
      var checkwidth = $("#checkwidth").val();
      var checkheight = $("#checkheight").val();
        if (number==null || number<=0)
        {
          number=1;
        }
      var total = (width*height)*price*number;
  //$("#username").val()
      $("#total").html(total+"บาท");
    });
  $("#print").click(function(){
    $(".show_hide").hide();
    $(".show_hide_index").hide();
    $(".footer_show_hide").hide();
    $(".hide_naja").hide();
    $(".modal-footer").hide();
    window.print();
    $(".show_hide").show();
    $(".show_hide_index").show();
    $(".footer_show_hide").show();
    $(".hide_naja").show();
    $(".modal-footer").show();
  });
  $("#save").click(function(){
    var path_insert="";
    var fname=$("#firstname").val();
    var lname=$("#lastname").val();
    var phone=$("#phone").val();
    var email=$("#email").val();
    var address=$("#address").val();
    var descrption=$("#descrption").val();
    var width=$("#width").val();
    var height=$("#height").val();
    var cat_id=$("#cat_id").val();
    var price=$("#price").val();
    var number=$("#number").val();
    var path_insert=$.ajax({
                type:"POST",
                dataType:"json",
                url:"insert_lable.php",
                data:
                  {
                  firstname:fname,
                  lastname:lname,
                  phone:phone,
                  email:email,
                  address:address,
                  descrption:descrption,
                  width:width,
                  height:height,
                  cat_id:cat_id,
                  price:price,
                  number:number
                  }
                });
    path_insert.done(function(data){
         alert(data);
       console.log(data);
        if (data.update_CATEGORY=='0'){
            alert('ไวนิลไม่พอสำหรับการปริ้น');
        }
        if (data.check_insert_lable=='1'){
            alert('ทำรายการเสร็จสิ้น');
        }
        if (data.status=='no_success'){
          alert('ERROR แจ้ง IT 0957591823');
        }
    });
  });
});
