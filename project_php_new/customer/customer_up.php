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
            echo "<script> alert('แก้ไขเรียบร้อย');window.location.href='customer.php';</script>";
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
                                    <form method="post"  action="customer_up.php" >
                                        <input type="hidden" class="form-control" name="CUS_PHONE" value="<?php echo $rowin['CUS_PHONE'] ?>">
                                        <div class="form-group">
                                            <label>ชื่อ</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="CUS_FNAME" value="<?php echo $rowin['CUS_FNAME'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>นามสกุล</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="CUS_LNAME" value="<?php echo $rowin['CUS_LNAME'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ที่อยู่</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="CUS_ADDRESS" value="<?php echo $rowin['CUS_ADDRESS'] ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>อีเมล์</label>
                                            <div class="form-label-group">
                                                <input type="email"  class="form-control" name="CUS_EMAIL" value="<?php echo $rowin['CUS_EMAIL'] ?>">
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
            $sql = 'select * from customer where CUS_PHONE=' . "'$CAT_ID'" . '';
            $res = $conn->query($sql);
            $row = $res->fetch_array();
            return $row;
        }

        function updates_cat($conn) {
            $CUS_PHONE = $_POST['CUS_PHONE'];
            $CUS_FNAME = $_POST['CUS_FNAME'];
            $CUS_LNAME = $_POST['CUS_LNAME'];
            $CUS_ADDRESS = $_POST['CUS_ADDRESS'];
            $CUS_EMAIL = $_POST['CUS_EMAIL'];
            $sql = 'update customer set '
                    . 'CUS_EMAIL=' . "'$CUS_FNAME'" . ','
                    . 'CUS_LNAME=' . "'$CUS_LNAME'" . ','
                    . 'CUS_ADDRESS=' . "'$CUS_ADDRESS'" . ','
                    . 'CUS_EMAIL=' . "'$CUS_EMAIL'" . ' where CUS_PHONE=' . "'$CUS_PHONE'" . '';
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
