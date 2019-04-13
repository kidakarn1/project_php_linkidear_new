<?php
if (isset($a)) {
    $a = '../';
} else {
    $a = '';
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Lawfirm Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">
        <!-- Animate.css -->
        <link rel="stylesheet" href="<?php echo $a; ?>css/animate.css">
        <!-- Icomoon Icon Fonts-->
        <link rel="stylesheet" href="<?php echo $a; ?>css/icomoon.css">
        <!-- Bootstrap  -->
        <link rel="stylesheet" href="<?php echo $a; ?>css/bootstrap.css">
        <!-- Magnific Popup -->
        <link rel="stylesheet" href="<?php echo $a; ?>css/magnific-popup.css">
        <!-- Owl Carousel  -->
        <link rel="stylesheet" href="<?php echo $a; ?>css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo $a; ?>css/owl.theme.default.min.css">
        <!-- Flexslider  -->
        <link rel="stylesheet" href="<?php echo $a; ?>css/flexslider.css">
        <!-- Flaticons  -->
        <link rel="stylesheet" href="<?php echo $a; ?>fonts/flaticon/font/flaticon.css">
        <!-- Theme style  -->
        <link rel="stylesheet" href="<?php echo $a; ?>css/style.css">
    </head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="<?php echo $a; ?>index.php">LINKIDEAR</a></li>
                        <li><a href="<?php echo $a; ?>index.php"> <img src="<?php echo $a; ?>icon_image/home.png" width="25">หน้าแรก</a></li>
                        <input type="hidden" id="check_path_js" value="<?php echo $a; ?>">
                        <?php
                        @SESSION_START();
                        $user = (isset($_SESSION['STAFF_ID'])) ? $_SESSION['STAFF_ID'] : '';
                        $dep_id = (isset($_SESSION['DEP_ID'])) ? $_SESSION['DEP_ID'] : '';
                        if ($user == '') {
                            ?>
                            <li>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"> <img src="<?php echo $a; ?>icon_image/login.png" width="30">เข้าสู่ระบบ</button>
                            </li>
                            <?php
                        } else {
                            if ($dep_id == "SV" || $dep_id == "MG") {
                                ?>
                                <li><a href="#" data-toggle="modal" data-target="#lable" data-whatever="@mdo">
                                        <img src="<?php echo $a; ?>icon_image/order1.png" width="30">สั่งทำป้าย
                                    </a>
                                </li>
                                <?php
                            }
                            if ($dep_id == "SV" || $dep_id == "GP" || $dep_id == "MG") {
                                ?>
                                <li>
                                    <a href="<?php echo $a; ?>select_lable.php"> <img src="<?php echo $a; ?>icon_image/check_product.png" width="30">รายการสั่งทำป้าย </a>
                                </li>
                                <?php
                            }
                            if ($dep_id == "PS" || $dep_id == "MG") {
                                ?>
                                <li>
                                    <a href="<?php echo $a; ?>print.php"> <<?php echo $a; ?>img src="icon_image/print.gif" width="50">ปริ้นป้าย </a>
                                </li>
                                <?php
                            }
                            if ($dep_id == "MG") {
                                ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $a; ?>icon_image/report.png" width="30">รายงาน<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $a; ?>report_design.php">รายชื่อพนักงานที่กำลังออกแบบ</a></li>
                                        <li><a href="<?php echo $a; ?>report_lable.php">รายชื่อพนักงานปริ้น</a></li>
                                        <li><a href="<?php echo $a; ?>report_all.php">รายละเอียดต่างๆ</a></li>
                                    </ul>
                                </li>
                                <?php
                            }
                            if ($dep_id == 'AC') {
                                ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $a; ?>icon_image/insert_product.png" width="30">จัดการ<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $a; ?>income/income.php">Income</a></li>
                                        <li><a href="<?php echo $a; ?>category/cat.php">Category</a></li>
                                        <li><a href="<?php echo $a; ?>checks/checks.php">Check</a></li>
                                        <li><a href="<?php echo $a; ?>customer/customer.php">customer</a></li>
                                        <li><a href="<?php echo $a; ?>departments/departments.php">departments</a></li>
                                        <li><a href="<?php echo $a; ?>staff/staff.php">staff</a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                            <li>
                                <a href="#"  data-toggle="modal" data-target="#create-item"> <img src="<?php echo $a; ?>icon_image/password.png" width="30">เปลี่ยนรหัสผ่าน</a>
                            </li>
                            <li>
                                <a href="<?php echo $a; ?>logout.php"><img src="<?php echo $a; ?>icon_image/logout.png" width="30">ออกจากระบบ </a>
                            </li>
                        <?php }
                        ?>
                    </ul>
                </div>
            </div><!-- ปิด div show_hide -->
        </nav>

    </body>

</html>
<script src="<?php echo $a; ?>js/modernizr-2.6.2.min.js"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>f
<script src="js/respond.min.js"></script>
<![endif]-->
<script src="<?php echo $a; ?>js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="<?php echo $a; ?>js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="<?php echo $a; ?>js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="<?php echo $a; ?>js/jquery.waypoints.min.js"></script>
<!-- Stellar Parallax -->
<script src="<?php echo $a; ?>js/jquery.stellar.min.js"></script>
<!-- Carousel -->
<script src="<?php echo $a; ?>js/owl.carousel.min.js"></script>
<!-- Flexslider -->
<script src="<?php echo $a; ?>js/jquery.flexslider-min.js"></script>
<!-- countTo -->
<script src="<?php echo $a; ?>js/jquery.countTo.js"></script>
<!-- Magnific Popup -->
<script src="<?php echo $a; ?>js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo $a; ?>js/magnific-popup-options.js"></script>
<!-- Main -->
<script src="<?php echo $a; ?>js/main.js"></script>
<script src="<?php echo $a; ?>js/chengpassword.js"></script>
<?php
include($a . "from_login.php");
include($a . "lable.php");
include($a . "from_cheng_password.php");
?>


