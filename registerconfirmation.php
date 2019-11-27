<!DOCTYPE html>
<html lang=en-us>
<head>
  <title>Registration</title>
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
    <h2>You have been registered!</h2>
    <?php 
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "trailhead";
  error_reporting(E_ALL);
  $conn = new mysqli($servername, $username, $password, $dbname);
  if($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $file = file_get_contents("trailhead.sql");
  if(!mysqli_multi_query($conn, $file)){
    echo "Error: " . mysqli_error($conn);
  }
  while(mysqli_more_results($conn)){ mysqli_next_result($conn); }
  echo $conn->error;
  ini_set('display_errors', 1);
  $firstname = $_POST["fname"];
  $lastname = $_POST["lname"];
  $email = $_POST["email"];
  $id = $_POST["id"];
  $username = $_POST["uname"];
  $password = $_POST["pass"];
  $student = false;
  if($_POST["status"] == "Student"){
      $student = true;
  } 
  $sql = "INSERT INTO USERS (uname, pass, email, id) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  echo $conn->error;
  $stmt->bind_param("sssi", $username, $password, $email, $id);
  $stmt->execute();

  if($student == true){
    $sql = "INSERT INTO STUDENTS (studentid, firstname, lastname) VALUES (?, ?, ?)";
  } else {
    $sql = "INSERT INTO ADMINISTRATION (adminid, firstname, lastname) VALUES (?, ?, ?)";
  }
  $stmt2 = $conn->prepare($sql);
  echo $conn->error;
  $stmt2->bind_param("iss", $id, $firstname, $lastname);
  $stmt2->execute(); 
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
