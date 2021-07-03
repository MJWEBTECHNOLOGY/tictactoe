<?php
include("action.php");

$tblname = "user_profile";
$tblpkey = "userid";


if (isset($_GET['userid']))
  $keyvalue = $_GET['userid'];
else
  $keyvalue = 0;



if (isset($_POST['submit'])) {

  $activateemail = '1';

      $form_data = array('activateemail' => $activateemail);
      $where = array($tblpkey => $keyvalue);
      $keyvalue = $obj->update_record($tblname, $where, $form_data);
      // move_uploaded_file($temp_name,$folder);
      $action = 2;
      $process = "updated";
      echo "<script>window.location = 'http://localhost/tictactoe/index.php'</script>";
}

?>


<!doctype html>
<html class="no-js" lang="">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>TIC TAC TOE | Activate Your Account</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Fontawesome CSS -->
	<link rel="stylesheet" href="css/fontawesome-all.min.css">
	<!-- Flaticon CSS -->
	<link rel="stylesheet" href="font/flaticon.css">
	<!-- Google Web Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<section class="fxt-template-animation fxt-template-layout9" data-bg-image="img/figure/bg9-l.jpg">
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<div class="col-lg-6">
					<div class="fxt-content">
						<h2>Activate Your Account</h2>
						<div class="fxt-form">
							<form method="POST">
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-4">
										<button type="submit" name="submit" class="fxt-btn-fill">Activate</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- jquery-->
	<script src="js/jquery-3.5.0.min.js"></script>
	<!-- Popper js -->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap js -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Imagesloaded js -->
	<script src="js/imagesloaded.pkgd.min.js"></script>
	<!-- Validator js -->
	<script src="js/validator.min.js"></script>
	<!-- Custom Js -->
	<script src="js/main.js"></script>

</body>


<!-- Mirrored from affixtheme.com/html/xmee/demo/forgot-password-9.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Jul 2021 17:04:17 GMT -->
</html>