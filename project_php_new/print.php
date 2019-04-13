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
    include ("menu.php");
    if (empty($_SESSION['STAFF_ID'])) {
        echo "<script>window.location.href = 'index.php';
	  	</script>";
    }
    if (!isset($_POST['fname'])) {
        $sql_lable_join = "select  CUSTOMER.CUS_FNAME,CUSTOMER.CUS_LNAME,LABLE.IMG,CATEGORY.CAT_NAME,LABLE.LABLE_WIDTH,
							 LABLE.LABLE_HEIGHT,LABLE.LABLE_NUMBER,LABLE.ORDER_DAY,LABLE.PICK_UP_DATE,
							 LABLE.STATUS,LABLE.LABLE_ID
							 from LABLE,STAFF,CUSTOMER,CATEGORY where LABLE.STAFF_ID=STAFF.STAFF_ID
							 and  LABLE.CUS_PHONE=CUSTOMER.CUS_PHONE and LABLE.CAT_ID = CATEGORY.CAT_ID and LABLE.STATUS='ปริ้น' order by LABLE.PICK_UP_DATE desc";
    } else {
        $fname = $_POST['fname'];
        $sql_lable_join = "select  CUSTOMER.CUS_FNAME,CUSTOMER.CUS_LNAME,LABLE.IMG,CATEGORY.CAT_NAME,LABLE.LABLE_WIDTH,
							 LABLE.LABLE_HEIGHT,LABLE.LABLE_NUMBER,LABLE.ORDER_DAY,LABLE.PICK_UP_DATE,
							 LABLE.STATUS,LABLE.LABLE_ID
							 from LABLE,STAFF,CUSTOMER,CATEGORY where LABLE.STAFF_ID=STAFF.STAFF_ID
							 and  LABLE.CUS_PHONE=CUSTOMER.CUS_PHONE and LABLE.CAT_ID = CATEGORY.CAT_ID and LABLE.STATUS='ปริ้น' and CUSTOMER.CUS_FNAME like '%$fname%' order by LABLE.PICK_UP_DATE desc";
    }
    $res_lable_join = $conn->query($sql_lable_join);
    ?>
    <body>
        <div class="text-center">
            <a href="print.php"><font color="blue">รอการปริ้นป้าย</font></a> | <a href="select_work_staff_print.php"><font color="blue">ป้ายที่จะปริ้น</font></a>
        </div>
        <form class="form-horizontal" method="post" action="">
            <div class="form-group">
                <div class="col-md-offset-7 col-sm-offset-6 col-sm-3 col-md-3 col-xs-offset-1 col-xs-7">
                    <input type="text"  class="form-control"  name="fname" placeholder="ชื่อลูกค้า">
                </div>
                <div class="col-xs-1">
                    <button type="submit" class="btn btn-success">ค้นหา</button>
                </div>
            </div>
        </form>
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
                        while ($row_lable_join = $res_lable_join->fetch_array()) {
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
                            <td bgcolor='<?php echo $color; ?>'>
                                <?php
                                $PICK_UP_DATE = $row_lable_join['PICK_UP_DATE'];
                                echo DateThai_kidakarn($PICK_UP_DATE);
                                ?>
                            </td>
                            <th bgcolor='<?php echo $color; ?>'>
                                <?php if ($row_lable_join['STATUS'] == "ปริ้น") { ?>
                                    <a href="update_status_lable.php?id=<?php echo $row_lable_join['LABLE_ID'] ?>&pinting=pinting" onclick="return confirm('คุณแน่ใจช่ายมั้ยที่จะรับงาน?')"><font color="blue"><?php echo $row_lable_join['STATUS']; ?></a>
                                    <?php
                                } else {
                                    ?>
                                    <font color="red"><?php echo $row_lable_join['STATUS']; ?>
                                <?php }
                                ?>
                            </th>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </table>
            </div>
        </div>
        <?php include "footer.php" ?>
    </body>
</html>

