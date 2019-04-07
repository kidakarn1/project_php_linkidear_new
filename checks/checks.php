<html>
    <head>
        <title></title>
    </head>
    <?php
    $a = 'path';
    require_once('../menu.php');
    if (empty($_SESSION['STAFF_ID'])) {
        echo "<script>window.location.href = '../index.php';
  	</script>";
    }
    require_once('../conn.php');
    $sql = 'select * from CHECKS,STAFF,category where checks.cat_id = category.cat_id and checks.STAFF_ID = staff.STAFF_ID';
    $res = $conn->query($sql);
    if (isset($_POST['submit'])) {
        $search = $_POST["search"];
        $res = search($conn, $search);
    }
    if (isset($_GET['ID_CHECKS'])) {
        $ID_CHECKS = $_GET['ID_CHECKS'];
        $check = delete($conn, $ID_CHECKS);
        $jump = ($check == true) ? "<script>alert('ลบสำเร็จ');window.location.href='checks.php'; </script>" : "<script>alert('ERROR'); </script>";
        echo $jump;
    }
    ?>
    <body>
        <div class="container">
            <form class="form-horizontal" method="post" action="">
                <div class="form-group">
                    <div class="col-md-offset-7 col-sm-offset-6 col-sm-3 col-md-3 col-xs-offset-1 col-xs-7">
                        <input type="text" name="search" id="search" class="form-control" placeholder="ค้นหา เช่น:2019-01-01" aria-label="Search" aria-describedby="basic-addon2">
                    </div>
                    <div class="col-xs-1">
                        <button type="submit" name="submit" class="btn btn-success">ค้นหา</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th><center>รูป</center></th>
                    <th><center>วัน/เดือน/ปี</center></th>
                    <th><center>ชื่อ-นามสกุล</center></th>
                    <th><center>รายละอียด</center></th>
                    <th><center>ความสูง</center></th>
                    <th><center>ความกว้าง</center></th>
                    <th><center>ม้วนป้าย</center></th>
                    <th colspan="2"><center><a class='btn btn-success' href="check_in.php">เพิ่มข้อมูล</a></center></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $res->fetch_assoc()) { ?>
                            <tr>
                                <td><img src="../img/<?php echo $row['IMG']; ?>" width="100"></td>
                                <td><?php echo $row['day_check']; ?></td>
                                <td><?php echo $row["FNAME"]; ?><?php echo $row["LNAME"]; ?></td>
                                <td><?php echo $row['CAT_NAME']; ?></td>
                                <td><?php echo $row['HEIGHT']; ?></td>
                                <td><?php echo $row['WIDTH']; ?></td>
                                <td><?php echo $row['NUMBER_ROLL']; ?></td>
                                <td><center><a class='btn btn-warning' href="check_up.php?ID_CHECKS=<?php echo $row['id_check']; ?>">แก้ไข</a></center></td>
                        <td><center><a class='btn btn-danger' onclick="alert('คุณได้ลบแล้ว')" href="checks.php?ID_CHECKS=<?php echo $row['id_check']; ?>">ลบ</a></center></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php include "../footer.php"; ?>
        <?php

        function search($conn, $search) {
            $sql2 = ' select * from CHECKS,STAFF,category where checks.cat_id = category.cat_id and checks.STAFF_ID = staff.STAFF_ID and day_check like ' . "'%$search%'" . '';
            $res2 = $conn->query($sql2);
            return $res2;
        }

        function delete($conn, $ID_CHECKS) {
            $sql1 = "delete from checks where id_check='$ID_CHECKS'";
            $res1 = $conn->query($sql1);
            if ($res1) {
                $r = true;
            } else {
                $r = false;
            }
            return $r;
        }
        ?>
    </body>
</html>
