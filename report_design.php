<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php
        include("conn.php");
        include ("menu.php");
        if (empty($_SESSION['STAFF_ID'])) {
            echo "<script>window.location.href = 'index.php';
	  	</script>";
        }
        $sql_lable_join = "select distinct STAFF.FNAME,STAFF.LNAME,STAFF.PHONE from LABLE,STAFF where LABLE.STAFF_ID=STAFF.STAFF_ID and LABLE.STATUS='กำลังออกแบบ'";
        $res_lable_join = $conn->query($sql_lable_join);
        ?>
        <div class='container'>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>ลำดับ</th>
                        <th>ชื่อ</th>
                        <th>สกุล</th>
                        <th>เบอร์โทร</th>
                    </tr>
                    <tr>
                        <?php
                        $i = 1;
                        while ($row_lable_join = $res_lable_join->fetch_array()) {
                            ?>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row_lable_join['FNAME']; ?></td>
                            <td><?php echo $row_lable_join['LNAME']; ?></td>
                            <td><?php echo $row_lable_join['PHONE']; ?></td>
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
