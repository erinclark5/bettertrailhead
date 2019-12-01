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
  $username = $_POST["username"];
  $oldpass = $_POST["oldpass"];
  $email = $_POST["email"];
  $newpass = $_POST["newpass"];

  $sql = "SELECT uname, password, email FROM users WHERE uname = '$username' AND password = '$oldpass' AND email = '$email'";
  $result = $conn->query($sql);
  echo $conn->error;
  if($result->num_rows > 0){
    $sql = "UPDATE users SET password = '$newpass' WHERE uname = '$username'";
    $result = $conn->query($sql);
    echo $conn->error;
    ?><h2>Your password has been changed!</h2> <?php
  } else{
    ?><h2>There is not an account associated with the information you entered.</h2> <?php
  }
  $conn->close();
  ?>
  <button onclick="window.location.href = 'login.php';" style="margin-botton:5px;">Back to Login</button>
  <br><br>
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
