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

    $servername = "localhost";$username = "root";$password = "";$dbname="trailhead";
    $conn = new mysqli($servername, $username, $password,$dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: <br>" . $conn->connect_error);
    }
    $sql = $conn->prepare("select first,last,email from customers where first=(?) and last=(?)");
    $sql->bind_param("ss",$_POST["fname"],$_POST["lname"]);
    $sql->execute();
    $result=$sql->get_result();

    if ($result->num_rows>0) {
      echo "<strong>Thanks for shopping with us again!</strong>";
    } else {
      echo "<strong>Welcome new customer!</strong>";
      $sql = $conn->prepare("insert into customers(first,last,email) values(?,?,?)");
      $sql->bind_param("sss",$_POST["fname"],$_POST["lname"],$_POST["email"]);
      $sql->execute();
    }
    $conn->close();
   ?>
</body>
</html>
