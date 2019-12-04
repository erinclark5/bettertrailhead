<!DOCTYPE html>
<html lang=en-us>
<head>
  <title>Registration Confirmation</title>
  <meta charset="utf-8">
  <meta name="description" content="Trailhead Student Service">
  <meta name="author" content="Erin Clark, Seifeldin Dabbour, Adrian Estrada">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="login.css" />
  <style>
  .error{color: #FF0000;}
  fieldset{width:25%;margin: auto;}
  </style>
</head>
<body style="text-align:center">
  <div class="info" id="#top">
  <hr>
  <header>
    <h1 class="title">
    Colorado School of Mines - Trailhead</h1>
  </header>
  <hr>
  </div>

  <div class="info">
  <article>

    <?php
   $servername = "localhost";$username = "root";$password = "";$dbname = "trailhead";
  error_reporting(E_ALL);
  $conn = new mysqli($servername, $username, $password, $dbname);
  if($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  $firstname = $_POST["fname"];
  $lastname = $_POST["lname"];
  $email = $_POST["email"];
  $username = $_POST["uname"];
  $password = $_POST["pass"];
  $student = "false";
  if($_POST["status"] == "student"){
      $student = "true";
  }
  $code = md5(uniqid(rand()));

  function checkID($inputID){
    $idd=$inputID;
    global $conn;
    $res=$conn->query("SELECT * FROM users WHERE id = '$idd'");
    if($res->num_rows > 0){return false;}
    return true;
  }
  $id=rand(1000,9999);
  while(checkID($id)==false){
    $id=rand(1000,9999);
  }


  $sql = "INSERT INTO temp (code, uname, password, id, email, stat) VALUES (?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  echo $conn->error;
  $stmt->bind_param("sssiss", $code, $username, $password, $id, $email, $student);
  $stmt->execute();

//   $to = $email;
//   $subject="Your confirmation link.";
//   $header="from: BetterTrailhead";
//   $message="Your Comfirmation link \r\n";
//   $message.="Click on this link to activate your account \r\n";
//   $message.="localhost:8080/bettertrailhead/registerconfirmation.php?passkey=$code";

//   $sentmail = mail($to,$subject,$message,$header);
  
//   // if your email succesfully sent
//   if($sentmail){
//     echo "Your Confirmation link Has Been Sent To Your Email Address.";
//   } else {
//     echo "Cannot send confirmation link to your e-mail address";
//   }

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$emailTo = $email;

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'mail.clanclark.net';
$mail->SMTPAuth = true;
$mail->Username = "erinl@clanclark.net";
$mail->Password = "mypassword";
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('erinl@clanclark.net', "bettertrailhead");
$mail->addReplyTo('erinl@clanclark.net', "bettertrailhead");
$mail->addAddress($email);

$mail->isHTML(true);

$bodyContent = "<p>localhost/bettertrailhead/registerconfirmation.php?passkey=$code</p>";

$mail->Subject = 'Confirmation from the team at bettertrailhead';
$mail->Body = $bodyContent;

if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}else{
    echo "Message sent!";
}




  $conn->close();

  ?>
  </div>
  <footer style="padding-top:10px">
    <p class="validation">HTML:</p>
    <img class="validation" src="images/html5.png" alt="html5 validation" style="height:2em">
    <p class="validation">CSS:</p>
    <img class="validation" src="images/css.png" alt="css validation" style="height:2em">
    <p class="validation">WCAG:</p>
    <img class="validation" src="images/wcag2AAA.png" alt="wcag validation" style="height:2em">
    <p>This file was last updated on <?php date_default_timezone_set("America/Denver");echo date('M/d/Y h:i',filemtime("registerconfirmation.php"));?>
  </footer>
</body>
</html>
