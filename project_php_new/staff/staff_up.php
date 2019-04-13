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
    if (isset($_GET['STAFF_ID'])) {
        $_SESSION['id'] = $_GET['STAFF_ID'];
        $ID = $_GET['STAFF_ID'];
    } else {
        $ID = $_SESSION['id'];
    }
    $sql_data = "select * from staff where STAFF_ID = '$ID'";
    $res_data = $conn->query($sql_data);
    $row_data = $res_data->fetch_assoc();
    if (isset($_POST["submit"])) {
        $_SESSION['i'] += 1;
        $i = $_SESSION['i'];
        $date_time = date('Ymdhis');
        date_default_timezone_set('Asia/Bangkok');
        if (isset($_POST['submit'])) {
            $img = $_FILES["file"]["name"];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $salary = $_POST['salary'];
            $dep_id = $_POST['DEP_ID'];
            $check = update($ID, $conn, $img, $username, $password, $fname, $lname, $address, $email, $phone, $salary, $dep_id);
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
                                    <form method="post"  action="staff_up.php" enctype="multipart/form-data">
                                        <input type="hidden" class="form-control" name="CAT_ID" value="<?php echo $i ?>" >
                                        <div class="form-group">
                                            <label>รูป</label>
                                            <div class="form-label-group">
                                                <center><img src="../img/<?php echo $row_data['IMG']; ?>" width='100'></center>
                                                <input type="file" class="form-control" name="file" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ชื่อ</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="fname" value="<?php echo $row_data["FNAME"]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>นามสกุล</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="lname" value="<?php echo $row_data["LNAME"]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>ที่อยู่</label>
                                            <div class="form-label-group">
                                                <input type="text" class="form-control" name="address" value="<?php echo $row_data["ADDRESS"]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>อีเมล์</label>
                                            <div class="form-label-group">
                                                <input type="email" class="form-control" name="email" value="<?php echo $row_data["EMAIL"]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>เบอร์โทร</label>
                                            <div class="form-label-group">
                                                <input type="number" class="form-control" name="phone" value="<?php echo $row_data["PHONE"]; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>เงินเดือน</label>
                                            <div class="form-label-group">
                                                <input type="number" class="form-control" name="salary" value="<?php echo $row_data["SALARY"]; ?>" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>depID</label>
                                            <select class="form-control" name="DEP_ID">
                                                <?php while ($row = $res->fetch_array()) { ?>
                                                    <option value="<?php echo $row['DEP_ID']; ?>" <?php
                                                    if ($row["DEP_ID"] == $row_data["DEP_ID"]) {
                                                        echo "selected";
                                                    }
                                                    ?>>
                                                                <?php echo $row['DEP_NAME']; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <center><input class="btn btn-success" type="submit" name="submit" value="บันทึก"></center>
                                    </form>
                                    <?php

                                    function update($ID, $conn, $img, $username, $password, $fname, $lname, $address, $email, $phone, $salary, $dep_id) {
                                        if ($img == null) {
                                            $sql_img = "select * from staff where STAFF_ID = '$ID'";
                                            $res_img = $conn->query($sql_img);
                                            $row_img = $res_img->fetch_assoc();
                                            $img = $row_img["IMG"];
                                        }
                                        //กำหนด directory สำหรับเก็บ file ที่จะ upload เข้าไป
                                        $limitfile = 10000000000;
                                        //กำหนด ขนาด file ที่อนุญาติให้โหลดเข้ามาเก็บได้ (ต่อ 1 file) หน่วยเป็น byte
                                        $a = "../img/" . $_FILES["file"]["name"];
                                        copy($_FILES["file"]["tmp_name"], $a);
                                        $sql = "update staff set
                                            FNAME='$fname',
                                            LNAME='$lname',
                                            PHONE='$phone',
                                            EMAIL='$email',
                                            ADDRESS='$address',
                                            SALARY='$salary',
                                            DEP_ID='$dep_id',
                                            IMG='$img'
                                            where STAFF_ID='$ID'";
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
