<?php
include ("menu.php");
include("conn.php");

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

if (empty($_SESSION['STAFF_ID'])) {
    echo "<script>window.location.href = 'index.php';
	  	</script>";
}
if (!isset($_POST['fname'])) {
    $sql_lable_join = "select  CUSTOMER.CUS_FNAME,CUSTOMER.CUS_LNAME,LABlE.DESCRIPTION,CUSTOMER.CUS_PHONE,LABlE.ORDER_DAY,LABlE.PICK_UP_DATE,
					 LABlE.LABLE_ID,LABlE.STATUS
					 from LABLE left join STAFF
					 on(LABLE.STAFF_ID=STAFF.STAFF_ID) left join CUSTOMER on(LABLE.CUS_PHONE=CUSTOMER.CUS_PHONE) order by LABLE.ORDER_DAY DESC";
} else {
    $fname = $_POST['fname'];
    $sql_lable_join = "select  CUSTOMER.CUS_FNAME,CUSTOMER.CUS_LNAME,LABlE.DESCRIPTION,CUSTOMER.CUS_PHONE,LABlE.ORDER_DAY,LABlE.PICK_UP_DATE,
					 LABlE.LABLE_ID,LABlE.STATUS
					 from LABLE left join STAFF
					 on(LABLE.STAFF_ID=STAFF.STAFF_ID) left join CUSTOMER on(LABLE.CUS_PHONE=CUSTOMER.CUS_PHONE) where
					 CUSTOMER.CUS_FNAME like '%$fname%'
					 order by LABLE.ORDER_DAY DESC";
}
$res_lable_join = $conn->query($sql_lable_join);
?>
<html>
    <head>
        <title></title>

    </head>

    <body>
    <center>
        <a href="select_lable.php"><font color="blue">รายการสั่งทำป้าย</font></a> | <a href="select_work_staff.php"><font color="blue">ป้ายที่รับมอบหมาย</font></a>



        <form class="form-horizontal" method="post" action="">
            <div class="form-group">
                <div class="col-md-offset-7 col-sm-offset-6 col-sm-3 col-md-3 col-xs-offset-1 col-xs-7">
                    <input type="text"  class="form-control"  name="fname" placeholder="ชื่อลูกค้า"/>
                </div>
                <div class="col-xs-1">
                    <button type="submit"  class="btn btn-success" >ค้นหา</button>
                </div>
            </div>
        </form>
        <div class='container'>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th scope="col">ลำดับ</th>
                        <th scope="col">ชื่อลูกค้า</th>
                        <th scope="col">รายละเอียดของงาน</th>
                        <th scope="col">เบอร์โทรลูกค้า</th>
                        <th scope="col">วันรับงาน</th>
                        <th scope="col">วันส่งงาน</th>
                        <th scope="col">สถานะ</th>
                        <th scope="col" colspan="2">การจัดการ</th>
                    </tr>
                    <tr>
                        <?php
                        $i = 1;
                        while ($row_lable_join = $res_lable_join->fetch_array()) {
                            ?>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row_lable_join['CUS_FNAME'] . " " . $row_lable_join['CUS_LNAME']; ?></td>
                            <td><?php echo $row_lable_join['DESCRIPTION']; ?></td>
                            <td><?php echo $row_lable_join['CUS_PHONE']; ?></td>
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
                                <?php if ($_SESSION['DEP_ID'] != "SV" && $row_lable_join['STATUS'] == "รับงาน") { ?>
                                    <a href="update_status_lable.php?id=<?php echo $row_lable_join['LABLE_ID'] ?>" onclick="return confirm('คุณแน่ใจช่ายมั้ยที่จะรับงาน?')"><font color="blue"><?php echo $row_lable_join['STATUS']; ?></a>
                                    <?php
                                } else {
                                    if ($row_lable_join['STATUS'] != "เสร็จสิ้น") {
                                        echo "<font color='red'>";
                                    } else {
                                        echo "<font color='green'>";
                                    }
                                    ?>
                                    <?php echo $row_lable_join['STATUS']; ?>
                                <?php }
                                ?>
                            </td>
                            <?php if ($_SESSION['DEP_ID'] == "SV" && $row_lable_join['STATUS'] == "รับงาน") { ?>
                                <th><a href="edit_lable.php?id=<?php echo $row_lable_join['LABLE_ID'] ?>">
                                        <img src="icon_image/edit.png" width="30">
                                    </a> |
                                    </td>
                                <td>
                                    <a href="delete_lable.php?id=<?php echo $row_lable_join['LABLE_ID'] ?>" onclick="return confirm('คุณแน่ใจช่ายมั้ยที่จะลบข้อมูล?')">
                                        <font color="blue"><img src="icon_image/del.png" width="30"></font>
                                    </a>
                                </td>
                                <?php
                            } else if ($_SESSION['DEP_ID'] == "MG" && $row_lable_join['STATUS'] == "รับงาน") {
                                ?>
                                <td><a href="edit_lable.php?id=<?php echo $row_lable_join['LABLE_ID'] ?>"><img src="icon_image/edit.png" width="30"></a> |
                                    <a href="delete_lable.php?id=<?php echo $row_lable_join['LABLE_ID'] ?>" onclick="return confirm('คุณแน่ใจช่ายมั้ยที่จะลบข้อมูล?')">
                                        <font color="blue"><img src="icon_image/del.png" width="30"></font>
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </table>
            </div>
        </div>
    </center>
    <?php include 'footer.php'; ?>
</body>
</html>
