<?php
$a = 'path';
include("../menu.php");
if (empty($_SESSION['STAFF_ID'])) {
    echo "<script>window.location.href = '../index.php';
  	</script>";
}
include("../conn.php");
$date_time = date('Ymdhis');
if (isset($_POST['submit'])) {
    $ID_INCOME = $_POST['ID_INCOME'];
    $RECEIPTS = $_POST['RECEIPTS'];
    $DISBURSEMENT = $_POST['DISBURSEMENT'];
    $DAY_IN = $_POST['DAY_IN'];
    $check = insert($conn, $ID_INCOME, $RECEIPTS, $DISBURSEMENT, $DAY_IN);
    $jump = ($check == true) ? "<script>alert('บันทึกสำเร็จ');window.location.href='income.php'; </script>" : "<script>alert('ERROR_OX123'); </script>";
    echo $jump;
}
?>
<div id="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="container">
                        <div class=" card-login mx-auto mt-5">
                            <form method="post" name='form'  action="f_in.php" >
                                <input type="hidden" name="ID_INCOME" value="<?php echo $date_time . $i ?>">
                                <div class="form-group">
                                    <label>รายรับ</label>
                                    <div class="form-label-group">
                                        <input type="number" class="form-control" name="RECEIPTS" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>รายจ่าย</label>
                                    <div class="form-label-group">
                                        <input type="number"  class="form-control" name="DISBURSEMENT" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>วันที่</label>
                                    <div class="form-label-group">
                                        <input type="date" class="form-control" name="DAY_IN" required>
                                    </div>
                                </div>
                                <center><input class="btn btn-success" type="submit" name="submit" value="บันทึก"></center>
                            </form>
                            <?php

                            function insert($conn, $ID_INCOME, $RECEIPTS, $DISBURSEMENT, $DAY_IN) {
                                $sql = "insert into INCOME (`ID_INCOME`, `RECEIPTS`, `DISBURSEMENT`, `DAY_IN`) values('$ID_INCOME','$RECEIPTS',' $DISBURSEMENT ', '$DAY_IN')";
                                $res = $conn->query($sql);
                                //echo $sql;
                                if ($res) {
                                    $r = true;
                                } else {
                                    $r = false;
                                }
                                return $r;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../footer.php'; ?>
