<?php
include("action.php");

$pagename = "forget-password.php";
$keyvalue = 0;
$tblname = "user_profile";
$tblpkey = "userid";


if (isset($_GET['userid']))
	$keyvalue = $_GET['userid'];
else
	$keyvalue = 0;


if (isset($_GET['action']))
	$action = addslashes(trim($_GET['action']));
else
	$action = "";
$status = "";
$dup = "";


$email = "";





if (isset($_POST['submit'])) {

	$email = $obj->test_input($_POST['email']);
	

	//check Duplicate
	$cwhere = array("email" => $_POST['email']);
	$count = $obj->count_method("user_profile", $cwhere);
	if ($count > 0 && $keyvalue == 0) {
		$sql2 = $obj->executequery("select * from user_profile where email='$email'");
		foreach ($sql2 as $key2) {
			$userid= $key2['userid'];
		}
		// echo "<script>alert('check email')</script>";
		echo "<script>window.location = 'http://localhost/tictactoe/forgetpass.php?userid=$userid'</script>";
	}
}


?>




<!doctype html>
<html class="no-js" lang="">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>TIC TAC TOE | Forget Password</title>
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
						<h2>Recover your password</h2>
						<div class="fxt-form">
							<form method="POST">
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-1">
										<input type="email" id="email" class="form-control" name="email" placeholder="Email" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-4">
										<button type="submit" name="submit" class="fxt-btn-fill">Send Me Email</button>
									</div>
								</div>
							</form>
						</div>
						<div class="fxt-footer">
							<div class="fxt-transformY-50 fxt-transition-delay-9">
								<p>Don't have an account?<a href="register-9.html" class="switcher-text2 inline-text">Register</a></p>
							</div>
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

</html>