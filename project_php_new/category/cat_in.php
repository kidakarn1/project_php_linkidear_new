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

    $date_time = date('Ymdhis');
    date_default_timezone_set('Asia/Bangkok');
    if (isset($_POST['submit'])) {
        $CAT_ID = $_POST['CAT_ID'];
        $CAT_NAME = $_POST['CAT_NAME'];
        $PRICE = $_POST['PRICE'];
        $HEIGHT = $_POST['HEIGHT'];
        $WIDTH = $_POST['WIDTH'];
        $NUMBER_ROLL = $_POST['NUMBER_ROLL'];
        $check = insert($conn, $CAT_ID, $CAT_NAME, $PRICE, $HEIGHT, $WIDTH, $NUMBER_ROLL);
        $jump = ($check == true) ? "<script>alert('บันทึกสำเร็จ');window.location.href='cat.php'; </script>" : "<script>alert('55'); </script>";
        echo $jump;
    }
    ?>
    <body>
        <div id="content-wrapper">
            <div class="container-fluid">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="container">
                                <div class=" card-login mx-auto mt-5">
                                    <form method="post"  action="cat_in.php" >
                                        <div class="form-group">
                                            <label>รายละเอียดป้าย</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="CAT_NAME" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ราคา</label>
                                            <div class="form-label-group">
                                                <input type="number" class="form-control" name="PRICE" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ความสูง</label>
                                            <div class="form-label-group">
                                                <input type="number" class="form-control" name="HEIGHT" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ความกว้าง</label>
                                            <div class="form-label-group">
                                                <input type="number" class="form-control" name="WIDTH" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ม้วนป้าย</label>
                                            <div class="form-label-group">
                                                <input type="number"  class="form-control" name="NUMBER_ROLL" >
                                            </div>
                                        </div>
                                        <center><input class="btn btn-success" type="submit" name="submit" value="บันทึก"></center>
                                    </form>
                                    <?php

                                    function insert($conn, $CAT_ID, $CAT_NAME, $PRICE, $HEIGHT, $WIDTH, $NUMBER_ROLL) {
                                        $sql = 'insert into CATEGORY (CAT_NAME, PRICE, HEIGHT, WIDTH, NUMBER_ROLL) values(' . "'$CAT_NAME'" . ',' . "'$PRICE'" . ',' . "'$HEIGHT'" . ',' . "'$WIDTH'" . ',' . "'$NUMBER_ROLL'" . ')';
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
                </div>
            </div>
        </div>
        <?php require_once('../footer.php'); ?>
    </body>
</html>
