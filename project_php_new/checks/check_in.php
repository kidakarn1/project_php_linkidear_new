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
    date_default_timezone_set('Asia/Bangkok');
    if (isset($_POST['submit'])) {
        $ID_CHECKS = $_POST['ID_CHECKS'];
        $STAFF_ID = $_POST['STAFF_ID'];
        $CAT_ID = $_POST['CAT_ID'];
        $DAY_CHECKS = $_POST['DAY_CHECKS'];
        $check = insert($conn, $ID_CHECKS, $STAFF_ID, $CAT_ID, $DAY_CHECKS);
        $jump = ($check == true) ? "<script>alert('บันทึกสำเร็จ');window.location.href='checks.php'; </script>" : "<script>alert('ERROR'); </script>";
        echo $jump;
    }
    $sql = 'select * from CATEGORY';
    $res = $conn->query($sql);
    ?>
    <body>
        <div id="content-wrapper">
            <div class="container-fluid">
                <div class="card mb-3">
                    <div class="container">
                        <div class=" card-login mx-auto mt-5">
                            <form method="post" name='form'  action="check_in.php" >
                                <input type="hidden" name="ID_CHECKS" value="<?php echo $i; ?>">
                                <input type="hidden" name="STAFF_ID" value="<?php echo $_SESSION['STAFF_ID']; ?>">
                                <div class="form-group">
                                    <label>ประเภทป้าย</label>
                                    <select class="form-control" name="CAT_ID">
                                        <?php while ($row = $res->fetch_array()) { ?>
                                            <option value="<?php echo $row['CAT_ID']; ?>"><?php echo $row['CAT_NAME']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="date" id="DAY_IN" name="DAY_CHECKS" required>
                                </div>
                        </div>
                        <center><input class="btn btn-success" type="submit" name="submit" value="บันทึก"></center>
                        </form>
                        <?php

                        function insert($conn, $ID_CHECKS, $STAFF_ID, $CAT_ID, $DAY_CHECKS) {
                            $sql = "insert into CHECKS (`id_check`, `staff_id`, `cat_id`) values('$ID_CHECKS','$STAFF_ID','$CAT_ID ')";
                            $res = $conn->query($sql);
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
        <?php include '../footer.php'; ?>
    </body>
</html>
