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
    $_SESSION['i'] += 1;
    $i = $_SESSION['i'];
    $date_time = date('Ymdhis');
    date_default_timezone_set('Asia/Bangkok');
    if (isset($_POST['submit'])) {
        $DEP_ID = $_POST['DEP_ID'];
        $DEP_NAME = $_POST['DEP_NAME'];
        $check = insert($conn, $DEP_ID, $DEP_NAME);
        $jump = ($check == true) ? "<script>alert('บันทึกสำเร็จ');window.location.href='departments.php'; </script>" : "<script>alert('กรุณาเปลี่ยนชื่อย่อ'); </script>";
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
                                    <form method="post"  action="departments_in.php" >
                                        <div class="form-group">
                                            <label>ชื่อย่อ</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="DEP_ID" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ชื่อเต็ม</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="DEP_NAME" >
                                            </div>
                                        </div>
                                        <center><input class="btn btn-success" type="submit" name="submit" value="บันทึก"></center>
                                    </form>
                                    <?php

                                    function insert($conn, $DEP_ID, $DEP_NAME) {
                                        $sql = "INSERT INTO departments (DEP_ID, DEP_NAME)  values('$DEP_ID','$DEP_NAME')";
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
