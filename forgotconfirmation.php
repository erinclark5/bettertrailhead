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
  $email = $_POST["email"];

  $sql = "SELECT id FROM users WHERE uname = (?)";
  $stmt = $conn->prepare($sql);
  echo $conn->error;
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result=$stmt->get_result();
  $row = $result->fetch_assoc();
  $id = $row['id'];


  // Check if user is an admin
  $adRes=$conn->query("SELECT alias FROM admin WHERE id = '$id'");
  if($adRes->num_rows > 0){
    echo "<h2>For your safety, you cannot reset admin accounts.<br>
    Please contact the System Administrator at trailhead@mines.edu to reset your account.</h2>";
  } else{
    if(empty($email)){
      echo "<h2>Please enter your email!</h2>";
    }else{
      $sql = "SELECT id, email FROM students WHERE id = '$id' AND email = '$email'";
      $result = $conn->query($sql);
      echo $conn->error;
      if($result->num_rows > 0){
        // We send the email here
        echo "<h2>Reset email sent!<h2>";
      } else{
        ?><h2>There is not an account associated with the information you entered.</h2> <?php
      }
    }
  }


  $conn->close();
  ?>
  <button onclick="window.location.href = 'forgotpassword.php';" style="margin-botton:5px;">Try Again</button>
  <button onclick="window.location.href = 'login.php';" style="margin-botton:5px;">Back to Login</button>
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
