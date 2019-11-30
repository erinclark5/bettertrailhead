<!DOCTYPE html>
<html lang=en-us>
<head>
  <title>Admin Page</title>
  <meta charset="utf-8">
  <meta name="description" content="Trailhead Student Service">
  <meta name="author" content="Erin Clark, Seifeldin Dabbour, Adrian Estrada">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="login.css" />
  <script>
    function redirect(){
      window.location.replace('admin.php');
    }
    function goBack(text){
      document.getElementById("mytext").innerHTML=text;
      setTimeout(redirect,2000);
    }


  </script>
<body style="text-align:center">
    <div class="info">
      <p> Creating Course!</p>
      <p id="mytext"></p>
      <?php
      $servername = "localhost";$username = "root";$password = "";$dbname="trailhead";
      $conn = new mysqli($servername, $username, $password,$dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: <br>" . $conn->connect_error);
      }
      // Start session and get variables
      session_start();
      $a = $_SESSION['aliasID'];
      $cid = $_POST["cid"];
      $cname = $_POST["cname"];

      // Check if course already exists
      $sql = "SELECT * FROM courses where courseid=(?) and name=(?)";
      $stmt = $conn->prepare($sql);
      echo $conn->error;
      $stmt->bind_param("ss", $cid, $cname);
      $stmt->execute();
      $result=$stmt->get_result();
      if($result->num_rows > 0){
        echo "<script>goBack('Course already exists!');</script>";
      }else{
        // Insert into courses table
        $sql = "Insert into courses(courseid,name) values (?,?)";
        $stmt = $conn->prepare($sql);
        echo $conn->error;
        $stmt->bind_param("ss", $cid, $cname);
        $stmt->execute();

        //Insert into schedules table
        $sql = "Insert into schedules(userid,courseid) values (?,?)";
        $stmt = $conn->prepare($sql);
        echo $conn->error;
        $stmt->bind_param("is", $a, $cid);
        $stmt->execute();
        echo "<script>goBack('Course Successfully Created!');</script>";
      }
      ?>
      <p>Redirecting back to admin page...</p>

</body>
</html>
