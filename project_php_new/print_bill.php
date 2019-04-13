 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
     <center>
     <?php
        SESSION_START();
        include("conn.php");
        $sql="select * from customer,category,staff,lable where (lable.STAFF_ID='$_SESSION[STAFF_ID]' and lable.CUS_PHONE='$_SESSION[CUS_PHONE]' and lable.STAFF_ID=staff.STAFF_ID and
              lable.CUS_PHONE=customer.CUS_PHONE and lable.CAT_ID=category.CAT_ID and lable.STATUS='รับงาน') and
              lable.LABLE_CHECK_DEL='1' order by lable.LABLE_ID DESC";
        $res=$conn->query($sql);
        $res_get_name=$conn->query($sql);
        $row_getname=$res_get_name->fetch_assoc();
        $row=$res->fetch_assoc();
      ?>
      <table border="1">
        <tr>
          <th colspan="2">ลิงค์ไอเดีย                              <b>เลขบิล</b><?php echo $row_getname['LABLE_ID']; ?></th>
        </tr>
          <tr>
            <th>ชื่อ-สกุลลูกค้า</th>
            <th><?php echo $row_getname['CUS_FNAME']." ".$row_getname['CUS_LNAME']; ?></th>
          </tr>
          <tr>
            <th>ชื่อ-สกุลพนักงานที่รับงาน</th>
            <th><?php echo $row_getname['FNAME']." ".$row_getname['LNAME']; ?></th>
          </tr>
          <tr>
            <th>ลายละเอียดป้าย</th>
            <th><?php echo $row['DESCRIPTION']; ?><br>
              ขนาด
              ความกว้าง <?php echo $row['LABLE_WIDTH']; ?> เมตร
              ความสูง <?php echo $row['LABLE_HEIGHT']; ?> เมตร<br>
              ประเภทป้ายไวนิล <?php echo $row['CAT_NAME']; ?> เมตร<br>
              ราคาต่อเมตร <?php echo $row['PRICE']; ?> บาท<br>
            </th>
          </tr>
          <tr>
            <th>จำนวน <?php echo $row['LABLE_NUMBER']; ?> ป้าย<br></th>
            <th>ยอดชำระ <?php echo $row['TOTAL']; ?> บาท  <br></th>
          </tr>
      </table>
    </center>
   </body>
 </html>
<script type="text/javascript">
    window.print();
</script>
