<?php
include("action.php");

error_reporting(0);

if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
} else {
    $username = "";
    $password = "";
}

$dup = "";




if (isset($_POST['submit'])) {

    $username = $obj->test_input($_POST['username']);
    $password = $obj->test_input($_POST['password']);

    $sql2 = $obj->executequery("select * from user_profile where username='$username'");
    foreach ($sql2 as $key2) {
        $activateemail = $key2['activateemail'];
        // echo $activateemail;die;
    }




    if ($username != "" && $password != "") {
        $is_exist = $obj->login_method("user_profile", $username, $password);
        if ($is_exist > 0) {
            if ($activateemail == 0) {
                $dup = "<div class='alert alert-danger'>
                        Activate your Email-ID.
                        </div>";
            } elseif ($activateemail == 1) {
                echo "<script>alert('loggedin');</script>";
            }
        } else {
            echo "<script>alert('failed')</script>";
        }
    }
}


if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = "";
}
?>



<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>TIC TAC TOE | Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
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
                        <h2>Login</h2>
                        <h2><?php echo $dup?></h2>
                        <div class="fxt-form">
                            <form method="POST">
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">
                                        <input type="text" id="username" class="form-control" name="username" placeholder="Username" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-2">
                                        <input id="password" type="password" class="form-control" name="password" placeholder="********" required="required">
                                        <i toggle="#password" class="fa fa-fw fa-eye toggle-password field-icon"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-3">
                                        <div class="fxt-checkbox-area">
                                            <a href="forgot-password.php" class="switcher-text">Forgot Password</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-4">
                                        <button type="submit" name="submit" class="fxt-btn-fill">Log in</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="fxt-footer">
                            <div class="fxt-transformY-50 fxt-transition-delay-9">
                                <p>Don't have an account?<a href="register.php" class="switcher-text2 inline-text">Register</a></p>
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