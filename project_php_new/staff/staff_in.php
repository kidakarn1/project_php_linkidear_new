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
        $img = $_FILES["file"]["name"];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $conpassword = $_POST['conpassword'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $salary = $_POST['salary'];
        $dep_id = $_POST['dep_id'];
        if ($password != $conpassword) {
            echo "<script>alert('รหัสผ่านกับการยืนยันรหัสผ่านไม่ตรงกัน');</script>";
        } else {
            $check = insert($conn, $img, $username, $password, $fname, $lname, $address, $email, $phone, $salary, $dep_id);
            $jump = ($check == true) ? "<script>alert('บันทึกสำเร็จ');window.location.href='staff.php'; </script>" : "<script>alert('ERROR'); </script>";
            echo $jump;
        }
    }
    $sql = 'select * from departments';
    $res = $conn->query($sql);
    ?>
    <body>
        <div id="content-wrapper">
            <div class="container-fluid">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="container">
                                <div class=" card-login mx-auto mt-5">
                                    <form method="post"  action="staff_in.php" enctype="multipart/form-data">
                                        <input type="hidden" class="form-control" name="CAT_ID" value="<?php echo $i ?>" >
                                        <div class="form-group">
                                            <label>รูป</label>
                                            <div class="form-label-group">
                                                <input type="file" class="form-control" name="file" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ชื่อผู้ใช้</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="username" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>รหัสผ่าน</label>
                                            <div class="form-label-group">
                                                <input type="password" class="form-control" name="password" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ยืนยันรหัสผ่าน</label>
                                            <div class="form-label-group">
                                                <input type="password" class="form-control" name="conpassword" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ชื่อ</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="fname" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>นามสกุล</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="lname" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ที่อยู่</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="address" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>อีเมล์</label>
                                            <div class="form-label-group">
                                                <input type="email" class="form-control" name="email" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>เบอร์โทร</label>
                                            <div class="form-label-group">
                                                <input type="number" class="form-control" name="phone" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>เงินเดือน</label>
                                            <div class="form-label-group">
                                                <input type="number" class="form-control" name="salary" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>depID</label>
                                            <select class="form-control" name="dep_id" required>
                                                <?php while ($row = $res->fetch_array()) { ?>
                                                    <option value="<?php echo $row['DEP_ID']; ?>"><?php echo $row['DEP_NAME']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <center><input class="btn btn-success" type="submit" name="submit" value="บันทึก"></center>
                                    </form>
                                    <?php

                                    function insert($conn, $img, $username, $password, $fname, $lname, $address, $email, $phone, $salary, $dep_id) {
                                        $sql = "select count(STAFF_ID) as staff_id from staff";
                                        $res_count = $conn->query($sql);
                                        $row = $res_count->fetch_assoc();
                                        echo $today = date("Ym");
                                        $count_query = $row['staff_id'] + 1;
                                        $STAFF_ID = $today . $count_query;
                                        $password = md5($password);
                                        //กำหนด directory สำหรับเก็บ file ที่จะ upload เข้าไป
                                        $limitfile = 10000000000;
                                        //กำหนด ขนาด file ที่อนุญาติให้โหลดเข้ามาเก็บได้ (ต่อ 1 file) หน่วยเป็น byte
                                        $a = "../img/" . $_FILES["file"]["name"];
                                        copy($_FILES["file"]["tmp_name"], $a);
                                        echo $sql = "INSERT INTO staff(STAFF_ID,USERNAME,PASSWORD,FNAME,LNAME,PHONE,EMAIL,ADDRESS,SALARY,DEP_ID,IMG)  values('$STAFF_ID','$username','$password','$fname','$lname','$phone','$email','$address','$salary','$dep_id','$img')";
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
