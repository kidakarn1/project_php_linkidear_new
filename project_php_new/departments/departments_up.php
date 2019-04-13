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
    if (isset($_GET['ID_CHECKS'])) {
        $_SESSION['id'] = $_GET['ID_CHECKS'];
        $ID = $_GET['ID_CHECKS'];
    } else {
        $ID = $_SESSION['id'];
    }
    $rowin = get_cat($conn, $ID);
    if (isset($_POST["submit"])) {
        $update_cat = updates_cat($conn);
        if ($update_cat) {
            echo "<script> alert('แก้ไขเรียบร้อย');window.location.href='departments.php';</script>";
        } else {
            echo "<script>alert('ERROR')</script>";
        }
    }
    ?>
    <body>
        <div id="content-wrapper">
            <div class="container-fluid">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="container">
                                <div class=" card-login mx-auto ">
                                    <form method="post"  action="departments_up.php" >
                                        <input type="hidden" class="form-control" name="DEP_ID" value="<?php echo $rowin['DEP_ID'] ?>">
                                        <div class="form-group">
                                            <label>ชื่อ</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="DEP_NAME" value="<?php echo $rowin['DEP_NAME'] ?>">
                                            </div>
                                        </div>
                                        <center><input class="btn btn-success" type="submit" name="submit" value="บันทึก"></center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../footer.php"; ?>
        <?php

        function get_cat($conn, $CAT_ID) {
            $sql = 'select * from departments where DEP_ID =' . "'$CAT_ID'" . '';
            $res = $conn->query($sql);
            $row = $res->fetch_array();
            return $row;
        }

        function updates_cat($conn) {
            $DEP_ID = $_POST['DEP_ID'];
            $DEP_NAME = $_POST['DEP_NAME'];
            $sql = 'update departments set '
                    . 'DEP_NAME=' . "'$DEP_NAME'" . ' where DEP_ID=' . "'$DEP_ID'" . '';
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
