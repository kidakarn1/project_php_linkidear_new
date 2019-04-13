<?php
$a = 'path';
require_once('../menu.php');
if (empty($_SESSION['STAFF_ID'])) {
    echo "<script>window.location.href = '../index.php';
  	</script>";
}
require_once('../conn.php');
if (isset($_GET['ID_INCOME'])) {
    $ID_INCOME = $_GET['ID_INCOME'];
    $rowin = get_income($conn, $ID_INCOME);
}
if (isset($_POST["submit"])) {
    $data = $_POST;
    $update_income = updates_income($conn, $data);
    if ($update_income) {
        echo "<script> window.location.href='income.php';</script>";
    } else {
        echo "<script>alert('ERROR')</script>";
    }
}
?>
<div id="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="container">
                        <div class=" card-login mx-auto ">
                            <form method="post" name='form'  action="income_updates.php" >
                                <input type="hidden" name="ID_INCOME" value="<?php echo $rowin['ID_INCOME']; ?>">
                                <div class="form-group">
                                    <label class="control-label">รายรับ</label>
                                    <input class="form-control" type="number" name="RECEIPTS" value="<?php echo $rowin['RECEIPTS']; ?>">
                                </div>
                        </div>
                        <div class="form-group">
                            <label>รายจ่าย</label>
                            <div class="form-label-group">
                                <input class="form-control" type="number" name="DISBURSEMENT" value="<?php echo $rowin['DISBURSEMENT']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>วันที่บันทึก</label>
                            <div class="form-label-group">
                                <input class="form-control" type="date" id="DAY_IN" name="DAY_IN" value="<?php echo $rowin['DAY_IN']; ?>"></button>
                            </div>
                        </div>
                        <center><input class="btn btn-warning" type="submit" name="submit" value="แก้ไข"></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../footer.php'; ?>
<?php

function get_income($conn, $id) {
    $sql = "select * from INCOME where ID_INCOME = '$id' ";
    $res = $conn->query($sql);
    $row = $res->fetch_array();
    return $row;
}

function updates_income($conn, $data) {
    $ID_INCOME = $data['ID_INCOME'];
    $RECEIPTS = $data['RECEIPTS'];
    $DISBURSEMENT = $data['DISBURSEMENT'];
    $DAY_IN = $data['DAY_IN'];
    $year = substr($DAY_IN, 0);
    $sql = "update INCOME set RECEIPTS='$RECEIPTS', DISBURSEMENT='$DISBURSEMENT' ,DAY_IN='$year' where ID_INCOME='$ID_INCOME'";
    $res = $conn->query($sql);
    if ($res) {
        $r = true;
    } else {
        $r = false;
    }
    return $r;
}
?>
</body>
</html>
