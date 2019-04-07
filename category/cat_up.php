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
    $ID = $_GET['CAT_ID'];
    $rowin = get_cat($conn, $ID);
    if (isset($_POST["submit"])) {
        $update_cat = updates_cat($conn, $data);
        if ($update_cat) {
            echo "<script> window.location.href='cat.php';</script>";
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
                                    <form method="post"  action="cat_up.php" >
                                        <input type="hidden" class="form-control" name="CAT_ID" value="<?php echo $rowin['CAT_ID'] ?>">
                                        <input type="hidden" class="form-control" name="CAT_NAME" value="<?php echo $rowin['CAT_NAME'] ?>">
                                        <div class="form-group">
                                            <label>ราคา</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="PRICE" value="<?php echo $rowin['PRICE'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ความสูง</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="HEIGHT" value="<?php echo $rowin['HEIGHT'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ความกว้าง</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="WIDTH" value="<?php echo $rowin['WIDTH'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ม้วนป้าย</label>
                                            <div class="form-label-group">
                                                <input type="text"  class="form-control" name="NUMBER_ROLL" value="<?php echo $rowin['NUMBER_ROLL'] ?>">
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
            $sql = 'select * from CATEGORY where CAT_ID=' . "'$CAT_ID'" . '';
            $res = $conn->query($sql);
            $row = $res->fetch_array();
            return $row;
        }

        function updates_cat($conn) {
            $CAT_ID = $_POST['CAT_ID'];
            $CAT_NAME = $_POST['CAT_NAME'];
            $PRICE = $_POST['PRICE'];
            $HEIGHT = $_POST['HEIGHT'];
            $WIDTH = $_POST['WIDTH'];
            $NUMBER_ROLL = $_POST['NUMBER_ROLL'];
            $sql = 'update CATEGORY set '
                    . 'CAT_NAME=' . "'$CAT_NAME'" . ','
                    . 'PRICE=' . "'$PRICE'" . ','
                    . 'HEIGHT=' . "'$HEIGHT'" . ','
                    . 'WIDTH=' . "'$WIDTH'" . ','
                    . 'NUMBER_ROLL=' . "'$NUMBER_ROLL'" . ' where CAT_ID=' . "'$CAT_ID'" . '';
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
