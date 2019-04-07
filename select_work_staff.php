<html>
    <head>
        <title></title>
    </head>
    <?php

    function DateThai_kidakarn($strDate) {
        $strYear = date("Y", strtotime($strDate)) + 543;
        $strMonth = date("n", strtotime($strDate));
        $strday_day = date("l", strtotime($strDate));
        $strDay = date("j", strtotime($strDate));
        $strHour = date("H", strtotime($strDate));
        $strMinute = date("i", strtotime($strDate));
        $strSeconds = date("s", strtotime($strDate));
        $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        $strMonthThai = $strMonthCut[$strMonth];
        $day = array('Monday' => 'จันทร์', 'Tuesday' => 'อังคาร', 'Wednesday' => 'พุธ', 'Thursday' => 'พฤหัสบดี', 'Friday' => 'ศุกร์', 'Saturday' => 'เสาร์', 'Sunday' => 'อาทิตย์');
        $getday_sql = $day[$strday_day];
        return "$getday_sql $strDay $strMonthThai $strYear";
    }

    @SESSION_START();
    include("conn.php");
    include("menu.php");
    if (empty($_SESSION['STAFF_ID'])) {
        echo "<script>window.location.href = 'index.php';
  	</script>";
    }
    $sql = "select STAFF.FNAME,STAFF.LNAME,CUSTOMER.CUS_FNAME,CUSTOMER.CUS_LNAME,LABlE.DESCRIPTION,CUSTOMER.CUS_PHONE,LABlE.ORDER_DAY,LABlE.PICK_UP_DATE,
					 LABlE.LABLE_ID,LABlE.STATUS from LABLE left join STAFF
	  on(LABLE.STAFF_ID=STAFF.STAFF_ID) left join CUSTOMER on (LABLE.CUS_PHONE=CUSTOMER.CUS_PHONE) where LABLE.STAFF_ID = '$_SESSION[STAFF_ID]' order by LABLE.PICK_UP_DATE DESC";
    $res = $conn->query($sql);
    ?>
    <body>
    <center>
        <a href="select_lable.php"><font color="blue">รายการสั่งทำป้าย</font></a> | <a href="select_work_staff.php"><font color="blue">ป้ายที่รับมอบหมาย</font></a>
    </center>
    <div class="container">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อพนักงานที่รับงาน</th>
                    <th>ชื่อลูกค้า</th>
                    <th>รายละเอียดของงาน</th>
                    <th>เบอร์โทรลูกค้า</th>
                    <th>วันรับงาน</th>
                    <th>วันส่งงาน</th>
                    <th>จัดการ</th>
                </tr>
                <tr>
                    <?php
                    $i = 1;
                    while ($row = $res->fetch_array()) {
                        if ($i % 2 == 0) {
                            $color = '#ccffff';
                        } else {
                            $color = '#ffffff';
                        }
                        ?>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['FNAME'] . " " . $row['LNAME']; ?></td>
                        <td><?php echo $row['CUS_FNAME'] . " " . $row['CUS_LNAME']; ?></td>
                        <td><?php echo $row['DESCRIPTION']; ?></td>
                        <td><?php echo $row['CUS_PHONE']; ?></td>
                        <td>
                            <?php
                            $order_day = $row['ORDER_DAY'];
                            echo DateThai_kidakarn($order_day);
                            ?>
                        </td>
                        <td>
                            <?php
                            $PICK_UP_DATE = $row['PICK_UP_DATE'];
                            echo DateThai_kidakarn($PICK_UP_DATE);
                            ?>
                        </td>
                        <?php if ($row['STATUS'] == "กำลังออกแบบ") { ?>
                        <form method="post" action="update_lable_img.php" enctype="multipart/form-data">
                            <input type="hidden" name="lable_id" value="<?php echo $row['LABLE_ID']; ?>">
                            <th><input type="file" name="file"></th>
                            <th><input type="submit" value="ส่งงาน"></th>
                        </form>
                        <?php
                    } else {
                        echo "<th>" . $row['STATUS'] . "</th>";
                    }
                    ?>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </table>
        </div>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>
