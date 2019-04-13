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
        $number = $_POST['number'];
        $check = insert($conn, $CAT_ID, $CAT_NAME, $PRICE, $HEIGHT, $WIDTH, $NUMBER_ROLL, $number);
        $jump = ($check == true) ? "<script>alert('บันทึกสำเร็จ');window.location.href='customer.php'; </script>" : "<script>alert('55'); </script>";
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
                                    <form method="post"  action="customer_in.php" >
                                        <input type="hidden" class="form-control" name="CAT_ID" value="<?php echo $i ?>" >
                                        <div class="form-group">
                                            <label>ชื่อ</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="CAT_NAME" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>นามสกุล</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="PRICE" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ที่อยู่</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="HEIGHT" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>อีเมล์</label>
                                            <div class="form-label-group">
                                                <input type="email" class="form-control" name="WIDTH" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>เบอร์โทร</label>
                                            <div class="form-label-group">
                                                <input type="number" class="form-control" name="number" >
                                            </div>
                                        </div>
                                        <center><input class="btn btn-success" type="submit" name="submit" value="บันทึก"></center>
                                    </form>
                                    <?php

                                    function insert($conn, $CAT_ID, $CAT_NAME, $PRICE, $HEIGHT, $WIDTH, $NUMBER_ROLL, $number) {
                                        $sql = "INSERT INTO customer (CUS_FNAME, CUS_LNAME, CUS_ADDRESS, CUS_EMAIL, CUS_PHONE)  values('$CAT_NAME','$PRICE','$HEIGHT','$WIDTH','$number')";
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
        <?php include "../footer.php"; ?>
    </body>
</html>
