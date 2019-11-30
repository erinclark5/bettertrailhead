<!DOCTYPE html>
<html lang=en-us>
<head>
  <title>Connection</title>
  <meta charset="utf-8">
  <meta name="description" content="Trailhead Student Service">
  <meta name="author" content="Erin Clark, Seifeldin Dabbour, Adrian Estrada">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="cookies.js"></script>
</head>
<body style="text-align:center">
  <script>
    <?php session_unset();?>
  </script>


<?php
  // Set up database
  $servername = "localhost";$username = "root";$password = "";$dbname = "trailhead";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  session_start();
  $username = $_POST["username"];
  $password = $_POST["pass"];
  $sql = "SELECT id FROM users WHERE uname = (?) AND password = (?)";
  $stmt = $conn->prepare($sql);
  echo $conn->error;
  $stmt->bind_param("ss", $username, $password);
  $stmt->execute();
  $result=$stmt->get_result();


  if(!empty($result) && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      $userID = $row['id'];
      $_SESSION['id']=$userID;
      $_SESSION['exp']=time()+3600;
      // Check if the user is an admin
      $adRes=$conn->query("SELECT alias FROM admin WHERE id = '$userID'");
      if($adRes->num_rows > 0){
        $adRow = $adRes->fetch_assoc();
        $a=$adRow["alias"];
        // Deprecated JS cookie:
        // echo "<script>setCookie('alias','$a');</script>";
        $_SESSION['alias']=$a;
        echo "<script>window.location.replace('admin.php');</script>";
      }else{
        $adRes=$conn->query("SELECT first,last FROM students WHERE id = '$userID'");
        $adRow = $adRes->fetch_assoc();
        // Create Cookie if not admin
        $f=$adRow["first"];
        $l=$adRow["last"];
        $_SESSION['first']=$f;
        $_SESSION['last']=$l;
        // Deprecated JS cookie:
        // echo "<script>setCookie('first','$f');</script>";
        // echo "<script>setCookie('last','$l');</script>";
      }
      echo "<script>window.location.replace('landing.php');</script>";
    }
  } else{
    // If the user is not in the database, send them to the error page
    echo "<script>window.location.replace('fail.php');</script>";
  }
  ?>

</body>
</html>
