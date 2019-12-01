<!DOCTYPE html>
<html lang=en-us>
<head>
  <title>Admin Page</title>
  <meta charset="utf-8">
  <meta name="description" content="Trailhead Student Service">
  <meta name="author" content="Erin Clark, Seifeldin Dabbour, Adrian Estrada">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="login.css" />
  <style>
  .error{color: #FF0000;}
  fieldset{width:30%;margin: auto;}

  /*  Styling for table  */
    table {
      margin-top: 20px;
    }
    th, td {
      text-align: center;
    }
    table caption {
      font-size: 30px;
      font-weight: bold;
    }
    table th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    table thead {
      color: #FFFFFF;
      background-color: #4CAF50;
    }
    table td {
      background-color: white;
    }
  </style>
</head>
<body style="text-align:center">
  <?php
    session_start();
    if(time()>=$_SESSION['exp']){
      echo "<script>alert('Login token timeout');
      window.location.replace('login.php');</script>";}
    if(isset($_SESSION['first'])){
      echo "<script>alert('Not an admin!');
      window.location.replace('landing.php');</script>";
    }
   ?>
  <div class="info" id="#top">
  <hr>
  <header>
    <h1 class="title">
    Colorado School of Mines - Trailhead</h1>
  </header>
  <hr>
  </div>

  <div class="info">
    <h1 id="welcome"></h1>
    <script>
      document.getElementById("welcome").innerHTML="Welcome Admin: "+'<?php echo $_SESSION['alias'];?>';
      // define variables and check if valid
      function validate() {
        var a = document.getElementById("cid").value;
        var b = document.getElementById("cname").value;
        var reg = /[!@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]/;

        if (a == null || a == "" || b == null || b == "") {
          alert("Please Fill All Required Fields");
          return false;
        } else if(reg.test(a) || reg.test(b) || reg.test(u)) {
          alert('Input is not alphanumeric');
          return false;
        }  else {
          return true;
        }
      }
    </script>
    <button onclick="window.location.href = 'catalog.php';" style="margin-botton:5px;">Course Catalog</button>
    <button onclick="window.location.href = 'changepass.php';" style="margin-botton:5px;">Change Password</button>
    <br><br>
    <h2>Your Courses</h2>
    <table style="margin:auto">
      <thead>
        <tr>
          <th>Course ID</th>
          <th>Course Name</th>
        </tr>
      </thead>
      <tbody>
        <?php
            $servername = "localhost";$username = "root";$password = "";$dbname="trailhead";
            $conn = new mysqli($servername, $username, $password,$dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: <br>" . $conn->connect_error);
            }
            $a = $_SESSION['alias'];
            $adRes=$conn->query("SELECT id FROM admin WHERE alias = '$a'");
            $id=$adRes->fetch_assoc();
            $id=$id["id"];
            $_SESSION['aliasID']=$id;
            $scRes=$conn->query("SELECT courseid FROM schedules WHERE userid = '$id'");
            while($row = $scRes->fetch_assoc()){
              $r=$row["courseid"];
              $nameRes=$conn->query("SELECT name FROM courses WHERE courseid = '$r'");
              $n=$nameRes->fetch_assoc()["name"];
              echo "<tr>";
              echo "<td>".$r."</td>";
              echo "<td>".$n."</td>";
              echo "</tr>";
            }
         ?>
      </tbody>
    </table>


    <h2> Add a Course!</h2>
    <p><span class="error">* required field</span></p>
    <form method="post" action= "create.php" onsubmit="return validate()">
      <fieldset>
        Course ID: <input type="text" id="cid" name="cid"><span class="error">*</span>
        <br>
        <p> Please enter ID in the form of: 4 letters, then 3 numbers. e.g: CSCI406</p>
        Course Name: <input type="text" id="cname" name="cname"><span class="error">*</span>
        <br>
      </fieldset>
      <br>
      <input type="submit" name="submit" value="Submit">
      <input type="reset" name="reset" value="Reset">
      <br><br>
    </form>
    <br><br>
	  <button type="button" onclick="location.href='logout.php'" style="margin-botton:5px;">Logout</button>
	  <br><br>
  </div>
  <footer style="padding-top:5px">
    <p class="validation">HTML:</p>
    <img class="validation" src="images/html5.png" alt="html5 validation" style="height:2em">
    <p class="validation">CSS:</p>
    <img class="validation" src="images/css.png" alt="css validation" style="height:2em">
    <p class="validation">WCAG:</p>
    <img class="validation" src="images/wcag2AAA.png" alt="wcag validation" style="height:2em">
    <p>This file was last updated on <?php date_default_timezone_set("America/Denver");echo date('M/d/Y h:i',filemtime("admin.php"));?>
  </footer>
</body>
</html>
