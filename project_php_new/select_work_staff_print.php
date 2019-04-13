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

    include("conn.php");
    include("menu.php");
    if (empty($_SESSION['STAFF_ID'])) {
        echo "<script>window.location.href = 'index.php';
  	</script>";
    }
    $sql = "select  CUSTOMER.CUS_FNAME,CUSTOMER.CUS_LNAME,LABLE.IMG,CATEGORY.CAT_NAME,LABLE.LABLE_WIDTH,
	  LABLE.LABLE_HEIGHT,LABLE.LABLE_NUMBER,LABLE.ORDER_DAY,LABLE.PICK_UP_DATE,
	  LABLE.STATUS,LABLE.LABLE_ID
	  from LABLE left join STAFF on(LABLE.STAFF_ID=STAFF.STAFF_ID) left join CUSTOMER on(LABLE.CUS_PHONE=CUSTOMER.CUS_PHONE)
	  left join CATEGORY on (LABLE.CAT_ID=CATEGORY.CAT_ID) where LABLE.STAFF_ID='$_SESSION[STAFF_ID]' order by LABLE.PICK_UP_DATE desc";
    $res = $conn->query($sql);
    ?>
    <body>
    <center>
        <a href="print.php"><font color="blue">รอการปริ้นป้าย</font></a> | <a href="select_work_staff_print.php"><font color="blue">ป้ายที่จะปริ้น</font></a>
    </center>
    <div class='container'>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อลูกค้า</th>
                    <th>รูป</th>
                    <th>ประเภทป้าย</th>
                    <th>กว้าง/เมตร</th>
                    <th>สูง/เมตร</th>
                    <th>จำนวน</th>
                    <th>วันรับงาน</th>
                    <th>วันส่งงาน</th>
                    <th>จัดการ</th>
                </tr>
                <tr>
                    <?php
                    $i = 1;
                    while ($row_lable_join = $res->fetch_array()) {
                        if ($i % 2 == 0) {
                            $color = '#ccffff';
                        } else {
                            $color = '#ffffff';
                        }
                        ?>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row_lable_join['CUS_FNAME'] . " " . $row_lable_join['CUS_LNAME']; ?></td>
                        <td><img src="image_lable/<?php echo $row_lable_join['IMG']; ?>" width="100"></td>
                        <td><?php echo $row_lable_join['CAT_NAME']; ?></td>
                        <td><?php echo $row_lable_join['LABLE_WIDTH'] . " " . "เมตร"; ?></td>
                        <td><?php echo $row_lable_join['LABLE_HEIGHT'] . " " . "เมตร"; ?></td>
                        <td><?php echo $row_lable_join['LABLE_NUMBER'] . " " . "ป้าย"; ?></td>
                        <td>
                            <?php
                            $order_day = $row_lable_join['ORDER_DAY'];
                            echo DateThai_kidakarn($order_day);
                            ?>
                        </td>
                        <td>
                            <?php
                            $PICK_UP_DATE = $row_lable_join['PICK_UP_DATE'];
                            echo DateThai_kidakarn($PICK_UP_DATE);
                            ?>
                        </td>
                        <td>
                            <?php if ($row_lable_join['STATUS'] == "กำลังปริ้น") { ?>
                                <a href="update_status_lable.php?id=<?php echo $row_lable_join['LABLE_ID']; ?>&check=check" onclick="return confirm('คุณแน่ใจช่ายมั้ยว่าปริ้นเสร็จแล้ว')"><font color="blue">เสร็จสิ้น</a>
                                <?php
                            } else {
                                ?>
                                <font color="green"><?php echo $row_lable_join['STATUS']; ?>
                            <?php }
                            ?>
                        </td>
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
