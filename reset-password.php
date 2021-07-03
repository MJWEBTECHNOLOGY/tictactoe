<?php
include("action.php");

$pagename = "reset-password.php";
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

$password = "";

function encrypt($simple_string)
{
	$ciphering = "AES-128-CTR";
	$iv_length = openssl_cipher_iv_length($ciphering);
	$options = 0;
	$encryption_iv = '1234567891011121';
	$encryption_key = "GeeksforGeeks";
	return $encryption = openssl_encrypt(
		$simple_string,
		$ciphering,
		$encryption_key,
		$options,
		$encryption_iv
	);
}




if (isset($_POST['submit'])) {

	$password = $obj->test_input($_POST['password']);

	$password1 = encrypt($password);	

	$form_data = array('password' => $password1);
	$where = array($tblpkey => $keyvalue);
	$keyvalue = $obj->update_record($tblname, $where, $form_data);
	$action = 2;
	$process = "updated";
	if ($action == '2' || $process == 'updated') {
		// echo "<script>alert('hello')</script>";
		echo "<script>window.location = 'http://localhost/tictactoe/index.php'</script>";
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
						<h2>Reset your password</h2>
						<div class="fxt-form">
							<form method="POST">
							<div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="New Password" required="required">
                                        <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                                    </div>
                                </div>
								<div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                                        <input id="conpassword" onkeyup="checkpass()" type="password" class="form-control" name="conpassword" placeholder="Confirm Password" required="required">
                                        <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                                    </div>
                                </div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-4">
										<button type="submit" id="button" name="submit" class="fxt-btn-fill">Reset</button>
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

	<script>
		$('#button').attr('disabled','disabled');
		function checkpass(){
			const pass1 = $("#password").val();
			const pass2 = $("#conpassword").val();
			if (pass1 == pass2) {
				$('#button'). removeAttr('disabled');
			}
		}
	</script>

</body>

</html>