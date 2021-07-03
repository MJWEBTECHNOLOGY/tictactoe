<?php
    include("action.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

if ($_GET['userid']) {
    $userid = $_GET['userid'];
    
    $sql2 = $obj->executequery("select * from user_profile where userid='$userid'");
    foreach ($sql2 as $key2) {
        $userid= $key2['userid'];
        $emailid = $key2['email'];
    }



    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    // $candidate_email = $_POST['candidate_email'];
    $candidate_email = $emailid;
    

    $mail = new PHPMailer(true);

    try {                         // Enable verbose debug output
        $mail->isSMTP();                                                // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                           // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                       // Enable SMTP authentication
        $mail->Username   = 'mjwebtechnology@gmail.com';           // SMTP username
        $mail->Password   = 'mjwebtechnology@password.123';                           // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;             // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                        // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('mjwebtechnology@gmail.com', 'Tic Tac Toe');
        $mail->addAddress($candidate_email, "");     // Add a recipient

        // Attachments
        // $mail->addAttachment($file_name, 'Invoice.pdf');         // Add attachments

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Tic Tac Toe :: Activation Mail';
        $mail->Body    = "<a href='http://localhost/tictactoe/reset-password.php?userid=$userid'>click here";

        $mail->send();
    }
    catch (Exception $e) {}
    echo "<script>window.location = 'http://localhost/tictactoe/index.php'</script>";
    // unlink($file_name);
}
?>