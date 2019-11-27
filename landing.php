<!DOCTYPE html>
<html lang=en-us>
<head>
  <title>Homepage</title>
  <meta charset="utf-8">
  <meta name="description" content="Trailhead Student Service">
  <meta name="author" content="Erin Clark, Seifeldin Dabbour, Adrian Estrada">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="login.css" />
</head>
<body style="text-align:center">
<?php 
$servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "trailhead";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $file = file_get_contents("trailhead.sql");
  if(!mysqli_multi_query($conn, $file)){
    echo "Error: " . mysqli_error($conn);
  }
  while(mysqli_next_result($conn));

  $username = $_POST["username"];
  $pass = $_POST["pass"];
  $sql1 = "SELECT id FROM USERS WHERE uname LIKE '%{$username}%' AND lastName LIKE '%{$pass}%'";
  $result = $conn->query($sql1);
  if(!empty($result) && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      echo "Found";
    }
  } else{
    echo "0 results";
  }
  $conn->close();
  ?>
</body>
</html>
