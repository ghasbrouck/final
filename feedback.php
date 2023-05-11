<?php

ini_set("display_errors", "On");

require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
$mail = new PHPMailer(true);

$email = $_POST["email"];
$feedback = $_POST["feedback"];

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "gaugehasbrouck@gmail.com";
$mail->Password = "pcmmuzebmgbjlumc";

$mail->setFrom("gaugehasbrouck@gmail.com", "USER");
$mail->addAddress("gaugehasbrouck@gmail.com");
$mail->Subject = "FEEDBACK";
$mail->Body = $feedback . " " . $email;
$mail->send();

$host = "localhost";
$dbname = "my_first_database";
$username = "root";
$password = "root";

$connection = mysqli_connect($host, $username, $password, $dbname);

if(mysqli_connect_errno()) {
    die("Connnection failed :(" . mysqli_connect_error());
}

$sql = "INSERT INTO feedback (email, feedback)
    VALUES (?, ?)";

$stmt = mysqli_stmt_init($connection);

if(! mysqli_stmt_prepare($stmt, $sql) ){
    die(mysqli_error($connection));
}

mysqli_stmt_bind_param($stmt, "ss", $email, $feedback);


if(mysqli_stmt_execute($stmt)) {
    header("Location: index.html");

} else {
    die("Something went wrong man");
}
