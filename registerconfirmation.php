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
  // $file = file_get_contents("trailhead.sql");
  // if(!mysqli_multi_query($conn, $file)){
  //   echo "Error: " . mysqli_error($conn);
  // }
  // while(mysqli_more_results($conn)){ mysqli_next_result($conn); }
  // echo $conn->error;
  // ini_set('display_errors', 1);
  
  $passkey = $_GET["passkey"];
  $sql = "SELECT * FROM temp WHERE code='$passkey'";
  $result = $conn->query($sql);
  if($result){
    //$count=$result->num_rows();
    //if($count == 1){
      $row = $result->fetch_assoc();
      $username = $row["uname"];
      $password = $row["password"];
      $id = $row["id"];
      $email = $row["email"];
      $student = $row["stat"];
    //}
    $sql = "INSERT INTO users (uname, password, id, email) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    echo $conn->error;
    $stmt->bind_param("ssis", $username, $password, $id, $email);
    $stmt->execute();

    if($student == "true"){
      $sql = "INSERT INTO students (id, first, last, email) VALUES (?, ?, ?, ?)";
      $stmt2 = $conn->prepare($sql);
      echo $conn->error;
      $stmt2->bind_param("isss", $id, $firstname, $lastname, $email);
      $stmt2->execute();
    } else {
      $sql = "INSERT INTO admin (id, alias) VALUES (?, ?)";
      $stmt2 = $conn->prepare($sql);
      echo $conn->error;
      $alias = $firstname.$lastname;
      $stmt2->bind_param("is", $id, $alias);
      $stmt2->execute();
    }
  } else {
    echo "Wrong confirmation code";
  }
  $sql = "DELETE FROM temp WHERE code = '$passkey'";
  $result = $conn->query($sql);
  $conn->close();
  ?>
  <h2>You have been registered!</h2>
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
