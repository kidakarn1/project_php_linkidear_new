<html>
  <head>
    <title></title>
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700" rel="stylesheet">
	<!-- Animate.css -->
		<link rel="stylesheet" href="css/animate.css">
		<!-- Icomoon Icon Fonts-->
		<link rel="stylesheet" href="css/icomoon.css">
		<!-- Bootstrap  -->
		<link rel="stylesheet" href="css/bootstrap.css">

		<!-- Magnific Popup -->
		<link rel="stylesheet" href="css/magnific-popup.css">

		<!-- Owl Carousel  -->
		<link rel="stylesheet" href="css/owl.carousel.min.css">
		<link rel="stylesheet" href="css/owl.theme.default.min.css">
		<!-- Flexslider  -->
		<link rel="stylesheet" href="css/flexslider.css">
		<!-- Flaticons  -->
		<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

		<!-- Theme style  -->
		<link rel="stylesheet" href="css/style.css">
  </head>
  <body>
	<div class="colorlib-loader"></div>
	<div id="page">
	<nav class="colorlib-nav" role="navigation">
		<div class="top-menu">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<div id="colorlib-logo"><a class="show_index" href="index.php">LINK<span>IDEAR</span></a></div>
					</div>
					<div class="show_hide">
					<div class="col-md-10 text-right menu-1">
						<ul>
							<li class="active"><a class="show_index" href="index.php"> <img src="icon_image/home.png" width="25">หน้าแรก</a></li>
							<li>
							<?php
						session_start();
						  $user =(isset($_SESSION['STAFF_ID'])) ? $_SESSION['STAFF_ID'] : '';
							$dep_id = (isset($_SESSION['DEP_ID'])) ? $_SESSION['DEP_ID'] : '';
							if ($user==''){
							?>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"> <img src="icon_image/login.png" width="30">เข้าสู่ระบบ</button>
							<?php
							}
							else{
								if ($dep_id=="SV" ||  $dep_id=="MG"){
									?>
							<a href="#" data-toggle="modal" data-target="#lable" data-whatever="@mdo">
							<img src="icon_image/order1.png" width="30">สั่งทำป้าย</a>
							<?php }
								if ($dep_id=="SV" || $dep_id=="GP" || $dep_id=="MG"){
							?>
							<a class="show_check_product" href="#"> <img src="icon_image/check_product.png" width="30">รายการสั่งทำป้าย </a>
							<?php }
								if ($dep_id=="PS" || $dep_id=="MG"){
							?>
							<a class="show_print" href="#"> <img src="icon_image/print.gif" width="50">ปริ้นป้าย </a>
							<?php }
								if  ($dep_id=="MG"){
							?>
						   <li class="has-dropdown">
								<a href="#"><img src="icon_image/report.png" width="30">รายงาน</a>
								<ul class="dropdown">
									<li><a class="show_report_design" href="#">รายชื่อพนักงานที่กำลังออกแบบ</a></li>
									<li><a class="show_report_lable"href="#">รายชื่อพนักงานปริ้น</a></li>
									<li><a class="show_report_all"href="#">รายละเอียดต่างๆ</a></li>
								</ul>
							</li>
							<?php
								}
							?>
							<a class="logout"href="#">ออกจากระบบ <img src="icon_image/logout.png" width="30"></a>
							<?php
							}
							?>
							</li>
						</ul>
						</div>
					</div><!-- ปิด div show_hide -->
				</div>
			</div>
		</div>
	</nav>
		<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
</body>
</html>
<script src="js/modernizr-2.6.2.min.js"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->
<script src="js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="js/jquery.waypoints.min.js"></script>
<!-- Stellar Parallax -->
<script src="js/jquery.stellar.min.js"></script>
<!-- Carousel -->
<script src="js/owl.carousel.min.js"></script>
<!-- Flexslider -->
<script src="js/jquery.flexslider-min.js"></script>
<!-- countTo -->
<script src="js/jquery.countTo.js"></script>
<!-- Magnific Popup -->
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/magnific-popup-options.js"></script>
<!-- Main -->
<script src="js/main.js"></script>
<script src="js/kidakarn.js"></script>

	<!-- jQuery -->
	<?php
		include("from_login.php");
		include("lable.php");
	?>
