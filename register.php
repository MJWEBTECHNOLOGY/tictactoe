<?php
include("action.php");

$pagename = "register.php";
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

$startdate = date('d-m-Y');

$username = $fullname = $email = $mobilenumber = $upiid = $password = "";

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

	$username = $obj->test_input($_POST['username']);
	$fullname = $obj->test_input($_POST['fullname']);
	$email = $obj->test_input($_POST['email']);
	$mobilenumber = $obj->test_input($_POST['mobilenumber']);
	$upiid = $obj->test_input($_POST['upiid']);
	$password = $obj->test_input($_POST['password']);
	$usertype = 'user';

	$password1 = encrypt($password);

	$activateemail = '0';



	//check Duplicate
	$cwhere = array("email" => $_POST['email']);
	$count = $obj->count_method("user_profile", $cwhere);
	if ($count > 0 && $keyvalue == 0) {
		$dup = "<div class='alert alert-danger'>Email Id already exist!.</div>";
	} else {
		if ($keyvalue == 0) {
			$form_data = array('usertype' => $usertype, 'username' => $username, 'password' => $password1, 'fullname' => $fullname, 'email' => $email, 'mobile' => $mobilenumber, 'upiid' => $upiid, 'activateemail' => $activateemail);
			$obj->insert_record($tblname, $form_data);
			$action = 1;
			$process = "insert";
			if ($action == '1' || $process == 'insert') {
				echo "<script>window.location = 'http://localhost/tictactoe/activationmail.php?email=$email'</script>";
			}
		} else {
			//update
			//print_r($keyvalue);die;
			$form_data = array('usertype' => $usertype, 'username' => $username, 'fullname' => $fullname, 'email' => $email, 'mobilenumber' => $mobilenumber, 'upiid' => $upiid, 'password' => $password, 'ipaddress' => $ipaddress, 'lastupdated' => $createdate, 'createdby' => $loginid);
			$where = array($tblpkey => $keyvalue);
			$keyvalue = $obj->update_record($tblname, $where, $form_data);
			// move_uploaded_file($temp_name,$folder);
			$action = 2;
			$process = "updated";
		}
	}
}


?>





<!doctype html>
<html class="no-js" lang="">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>TIC TAC TOE | Register</title>
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
				<div class="col-lg-6 col-12">
					<div class="fxt-content">
						<h2>Register</h2>
						<h2><?php echo $dup ?></h2>
						<input type="hidden" name="one" id="one" value="<?php echo $password1 ?>">
						<div class="fxt-form">
							<form method="POST">
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-1">
										<input type="text" id="username" class="form-control" name="username" placeholder="Username" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-1">
										<input type="text" id="fullname" class="form-control" name="fullname" placeholder="Full Name" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-1">
										<input type="email" id="email" class="form-control" name="email" placeholder="Email" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-1">
										<input type="number" id="mobilenumber" class="form-control" name="mobilenumber" placeholder="Phonepe, Paytm, Google Pay link number" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-1">
										<input type="text" id="upiid" class="form-control" name="upiid" placeholder="UPI-ID (Optional)" required="required">
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-2">
										<input id="password" type="password" class="form-control" name="password" placeholder="********" required="required">
										<i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
									</div>
								</div>
								<div class="form-group">
									<div class="fxt-transformY-50 fxt-transition-delay-4">
										<button type="submit" name="submit" class="fxt-btn-fill">Register</button>
									</div>
								</div>
							</form>
						</div>
						<div class="fxt-footer">
							<div class="fxt-transformY-50 fxt-transition-delay-9">
								<p>Already have an account?<a href="index.php" class="switcher-text2 inline-text">Log in</a></p>
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