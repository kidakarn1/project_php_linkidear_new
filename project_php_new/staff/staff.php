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
    $sql = "select * from staff where STAFF_CHECK_DEL='1'";
    $res = $conn->query($sql);
    if (isset($_POST['submit'])) {
        $search = $_POST["search"];
        $res = search($conn, $search);
    }
    if (isset($_GET['ID_CHECKS'])) {
        $ID_CHECKS = $_GET['ID_CHECKS'];
        $check = delete($conn, $ID_CHECKS);
        $jump = ($check == true) ? "<script>alert('ลบสำเร็จ');window.location.href='staff.php'; </script>" : "<script>alert('ERROR'); </script>";
        echo $jump;
    }
    ?>
    <body>
        <div class="container">

            <form class="form-horizontal" method="post" action="">
                <div class="form-group">
                    <div class="col-md-offset-7 col-sm-offset-6 col-sm-3 col-md-3 col-xs-offset-1 col-xs-7">
                        <input type="text" name="search" id="search" class="form-control" placeholder="ค้นหา รายละเอียดป้าย" aria-label="Search" aria-describedby="basic-addon2">
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
                            <th><center>ลำดับ</center></th>
                    <th><center>รูป</center></th>
                    <th><center>ชื่อ</center></th>
                    <th><center>นามสกุล</center></th>
                    <th><center>เบอร์มือถือ</center></th>
                    <th><center>อีเมล์</center></th>
                    <th><center>เงินเดือน</center></th>
                    <th><center>แผนก</center></th>
                    <th colspan="2"><center><a class='btn btn-success' href="staff_in.php">เพิ่มข้อมูล</a></center></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = $res->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><center><?php echo $i; ?></center></td>
                        <td><img src="../img/<?php echo $row['IMG']; ?>"width="50px"></td>
                        <td><?php echo $row['FNAME']; ?></td>
                        <td><?php echo $row["LNAME"]; ?></td>
                        <td><?php echo $row['PHONE']; ?></td>
                        <td><?php echo $row['EMAIL']; ?></td>
                        <td><?php echo $row['SALARY']; ?></td>
                        <td><?php echo $row['DEP_ID']; ?></td>
                        <td><center><a class='btn btn-warning' href="staff_up.php?STAFF_ID=<?php echo $row['STAFF_ID']; ?>">แก้ไข</a></center></td>
                        <td><center><a class='btn btn-danger' onclick="alert('คุณได้ลบแล้ว')" href="staff.php?ID_CHECKS=<?php echo $row['STAFF_ID']; ?>">ลบ</a></center></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php include "../footer.php"; ?>
        <?php

        function search($conn, $search) {
            $sql2 = "select * from  staff where (FNAME  like '%$search%' or LNAME  like '%$search%') and STAFF_CHECK_DEL='1'";
            $res2 = $conn->query($sql2);
            return $res2;
        }

        function delete($conn, $ID_CHECKS) {
            $sql1 = "update staff set  STAFF_CHECK_DEL='0' where STAFF_ID='$ID_CHECKS'";
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
