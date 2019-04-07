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
    if (isset($_GET['ID_CHECKS'])) {
        $ID_CHECKS = $_GET['ID_CHECKS'];
        $sql = 'select * from  checks where  id_check=' . "'$ID_CHECKS'" . '';
        $res = $conn->query($sql);
        $row1 = $res->fetch_array();
    }
    if (isset($_POST['submit'])) {
        $ID_CHECKS = $_POST['ID_CHECKS'];
        $CAT_ID = $_POST['CAT_ID'];
        $check = update($conn, $ID_CHECKS, $CAT_ID);
        $jump = ($check == true) ? "<script>alert('แก้ไขสำเร็จ');window.location.href='checks.php'; </script>" : "<script>alert('ERROR'); </script>";
        echo $jump;
    }
    $sql1 = 'select * from category';
    $res1 = $conn->query($sql1);
    ?>
    <body>
        <div id="content-wrapper">
            <div class="container-fluid">
                <div class="card mb-3">
                    <div class="container">
                        <div class=" card-login mx-auto mt-5">
                            <form method="post" name='form'  action="check_up.php" >
                                <input type="hidden" name="ID_CHECKS" value="<?php echo $row1['id_check']; ?>">
                                <div class="form-group">
                                    <label>ประเภทป้าย</label>
                                    <select class="form-control" name="CAT_ID">
                                        <?php while ($row = $res1->fetch_array()) { ?>
                                            <option value="<?php echo $row['CAT_ID']; ?>"><?php echo $row['CAT_NAME']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <center><input class="btn btn-success" type="submit" name="submit" value="บันทึก"></center>
                            </form>
                            <?php

                            function update($conn, $ID_CHECKS, $CAT_ID) {
                                $sql = "update checks set cat_id='$CAT_ID' where id_check='$ID_CHECKS'";
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
   <?php include "../footer.php";?>
</body>
</html>
