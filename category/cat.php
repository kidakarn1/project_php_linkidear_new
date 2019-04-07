<html>
    <head>
        <title></title>
    </head>
    <?php
    $a = 'path';
    require_once('../conn.php');
    require_once('../menu.php');
    if (empty($_SESSION['STAFF_ID'])) {
        echo "<script>window.location.href = '../index.php';
  	</script>";
    }
    $sql = "select * from CATEGORY";
    $res = $conn->query($sql);
    if (isset($_POST['submit'])) {
        $search = $_POST["search"];
        $res = search($conn, $search);
    }
    if (isset($_GET['CAT_ID'])) {
        $CAT_ID = $_GET['CAT_ID'];
        $check = delete($conn, $CAT_ID);
        $jump = ($check == true) ? "<script>alert('ลบสำเร็จ');window.location.href='cat.php'; </script>" : "<script>alert('ERROR_OX123'); </script>";
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


                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">รายละเอียดป้าย</th>
                    <th class="text-center">ราคา</th>
                    <th class="text-center">ความสูง</th>
                    <th class="text-center">ความกว้าง</th>
                    <th class="text-center">ม้วนป้าย</th>

                    <th colspan="2" class="text-center"><a class='btn btn-success' href="cat_in.php">เพิ่มข้อมูล</a></th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                        $i = 1;
                        while ($row = $res->fetch_array()) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['CAT_NAME']; ?></td>
                                <td><?php echo $row['PRICE']; ?></td>
                                <td><?php echo $row['HEIGHT']; ?></td>
                                <td><?php echo $row['WIDTH']; ?></td>
                                <td><?php echo $row['NUMBER_ROLL']; ?></td>
                                <td><a class='btn btn-warning' href="cat_up.php?CAT_ID=<?php echo $row['CAT_ID']; ?>">แก้ไข</a></td>
                                <td><a class='btn btn-danger' onclick="alert('คุณได้ลบแล้ว')" href="cat.php?CAT_ID=<?php echo $row['CAT_ID']; ?>">ลบ</a></td>
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
    $sql2 = 'select * from CATEGORY where CAT_NAME like ' . "'%$search%'" . '';
    $res2 = $conn->query($sql2);
    return $res2;
}

function delete($conn, $CAT_ID) {
    $sql1 = 'delete from CATEGORY where CAT_ID=' . "'$CAT_ID'" . '';
    $res1 = $conn->query($sql1);
    if ($res1) {
        $r = true;
    } else {
        $r = false;
    }
    return $r;
}
?>

