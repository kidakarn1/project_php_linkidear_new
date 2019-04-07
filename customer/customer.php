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
    $sql = 'select * from customer';
    $res = $conn->query($sql);
    if (isset($_POST['submit'])) {
        $search = $_POST["search"];
        $res = search($conn, $search);
    }
    if (isset($_GET['ID_CHECKS'])) {
        $ID_CHECKS = $_GET['ID_CHECKS'];
        $check = delete($conn, $ID_CHECKS);
        $jump = ($check == true) ? "<script>alert('ลบสำเร็จ');window.location.href='customer.php'; </script>" : "<script>alert('ERROR'); </script>";
        echo $jump;
    }
    ?>
    <body>
        <div class="container">

            <form class="form-horizontal" method="post" action="">
                <div class="form-group">
                    <div class="col-md-offset-7 col-sm-offset-6 col-sm-3 col-md-3 col-xs-offset-1 col-xs-7">
                        <input type="text" name="search" id="search" class="form-control" placeholder="ค้นหา ชื่อ-นามสกุล" aria-label="Search" aria-describedby="basic-addon2">
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
                    <th><center>ชื่อ</center></th>
                    <th><center>นามสกุล</center></th>
                    <th><center>ที่อยู่</center></th>
                    <th><center>อีเมล์</center></th>
                    <th><center>เบอร์มือถือ</center></th>
                    <th colspan="2"><center><a class='btn btn-success' href="customer_in.php">เพิ่มข้อมูล</a></center></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = $res->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['CUS_FNAME']; ?></td>
                                <td><?php echo $row["CUS_LNAME"]; ?></td>
                                <td><?php echo $row['CUS_ADDRESS']; ?></td>
                                <td><?php echo $row['CUS_EMAIL']; ?></td>
                                <td><?php echo $row['CUS_PHONE']; ?></td>
                                <td><center><a class='btn btn-warning' href="customer_up.php?ID_CHECKS=<?php echo $row['CUS_PHONE']; ?>">แก้ไข</a></center></td>
                        <td><center><a class='btn btn-danger' onclick="alert('คุณได้ลบแล้ว')" href="customer.php?ID_CHECKS=<?php echo $row['CUS_PHONE']; ?>">ลบ</a></center></td>
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
            $sql2 = ' select * from  customer where CUS_FNAME  like ' . "'%$search%'" . ' or CUS_LNAME  like ' . "'%$search%'" . ' or  CUS_PHONE  like ' . "'%$search%'" . '';
            $res2 = $conn->query($sql2);
            return $res2;
        }

        function delete($conn, $ID_CHECKS) {
            $sql1 = "delete from customer where CUS_PHONE='$ID_CHECKS'";
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
