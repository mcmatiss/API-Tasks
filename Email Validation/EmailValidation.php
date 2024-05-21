<?php
//require "vendor/autoload.php";
//
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;
//
//$stringToSend = "hello world";
//
//$mail = new PHPMailer(true);
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//$mail->SMTPOptions = array(
//    'ssl' => array(
//        'verify_peer' => false,
//        'verify_peer_name' => false,
//        'allow_self_signed' => true
//    )
//);
//$mail->isSMTP();
//
//$mail->SMTPAuth = true;
//$mail->host = 'smtp.gmail.com';
//$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//$mail->port = 587;
//
//$mail->Username = "mcmatiss0@gmail.com";
//$mail->Password = "";
//
//try {
//    $mail->setFrom('mcmatiss0@gmail.com', 'Matīss V');
//} catch (\PHPMailer\PHPMailer\Exception $e) {
//}
//try {
//    $mail->addAddress("mcmatiss0@gmail.com");
//} catch (\PHPMailer\PHPMailer\Exception $e) {
//}
//
//$mail->Subject = "Hello World";
//$mail->Body = $stringToSend;
//
//try {
//    $mail->send();
//} catch (\PHPMailer\PHPMailer\Exception $e) {
//}

$emailValidationAPIkey = "ema_live_W3iwvDVWGrFo1nt2rF3FwZEt5k1hpbMt78V2l2FI";

$email = 'mcmatiss0@gmail.com';
$ch = curl_init("https://api.emailvalidation.io/v1/info?email=$email");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["apikey: $emailValidationAPIkey"]);

$serverOutput = curl_exec($ch);

if ($e = curl_error($ch)) {
    echo $e;
} else {
    $decodedData =
        json_decode($serverOutput);
}
curl_close($ch);

if ($decodedData !== NULL) {
    if ($decodedData->mx_found &&
        $decodedData->state == "deliverable" &&
        $decodedData->reason == "valid_mailbox" &&
    $decodedData->format_valid
    ) {
        echo "\nThis email is valid.\n";
    } else {
        echo "\nThis email is invalid.\n";
    }
}