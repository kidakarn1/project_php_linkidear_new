<html>
    <head>
        <title></title>
    </head>
    <?php
    $a = 'path';
    include '../conn.php';
    include '../menu.php';
    if (empty($_SESSION['STAFF_ID'])) {
        echo "<script>window.location.href = '../index.php';
  	</script>";
    }

    $sql = "select * from INCOME";
    $res = $conn->query($sql);
    if (isset($_POST['submit'])) {
        $search = $_POST["search"];
        $res = search($conn, $search);
    }
    if (isset($_GET['ID_INCOME'])) {
        $ID_INCOME = $_GET['ID_INCOME'];
        $check_delete = (delete($conn, $ID_INCOME));
        if ($check_delete) {
            echo "<script> window.location.href='income.php';</script>";
        } else {
            echo "<script>alert('ลบไม่สำเร็จ')</script>";
        }
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
                            <th class="text-center">ลำดับ</th>
                    <th class="text-center">รายรับ</th>
                    <th class="text-center">รายจ่าย</th>
                    <th class="text-center">วัน/เดือน/ปี</th>
                    <th colspan="2" class="text-center"><a class='btn btn-success' href="f_in.php">เพิ่มข้อมูล</a></th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $i = 1;
                        while ($rowin = $res->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $rowin['RECEIPTS']; ?></td>
                                <td><?php echo $rowin['DISBURSEMENT']; ?></td>
                                <td><?php echo $rowin['DAY_IN']; ?></td>
                                <td><a class='btn btn-warning' href="income_updates.php?ID_INCOME=<?php echo $rowin['ID_INCOME']; ?>">แก้ไข</a></td>
                        <td><a class='btn btn-danger' onclick="alert('คุณได้ลบแล้ว')" href="income.php?ID_INCOME=<?php echo $rowin['ID_INCOME']; ?>">ลบ</a></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>


        <?php include '../footer.php'; ?>
    </body>
</html>
<?php

function search($conn, $search) {
    $sql2 = "select * from INCOME where DAY_IN LIKE '%$search%'";
    $res2 = $conn->query($sql2);
    return $res2;
}

function delete($conn, $ID_INCOME) {
    $sql1 = "delete from INCOME where ID_INCOME='$ID_INCOME'";
    $res1 = $conn->query($sql1);
    if ($res1) {
        $r = true;
    } else {
        $r = false;
    }
    return $r;
}
?>
