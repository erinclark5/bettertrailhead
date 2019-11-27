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
    <nav>

    </nav>

  </header>
  <hr>
  </div>

  <div class="info">
  <article>
    <?php
    // define variables and set to empty values
    $nameErr = $emailErr = $unameErr = $passErr = "";
    $fname = $lname = $email = $uname = $pass = "";
    echo "<script> var good=0;</script>";
    date_default_timezone_set("America/Denver");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["fname"])||empty($_POST["lname"])) {
        $nameErr = "Both fields required";

      } else {
        $fname = test_input($_POST["fname"]);
        $lname = test_input($_POST["lname"]);
        echo "<script>good=good+1;</script>";
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/",$fname)||!preg_match("/^[a-zA-Z ]*$/",$lname)) {
          $nameErr = "Only letters and white space allowed";
        }
      }

      if (empty($_POST["email"])) {
          $emailErr = "Email is required";
        } else {
          $email = test_input($_POST["email"]);
          echo "<script>good=good+1;</script>";
          // check if e-mail address is well-formed
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
          }
        }

      if (empty($_POST["uname"])) {
          $emailErr = "Username is required";
        } else {
          $uname = test_input($_POST["uname"]);
          echo "<script>good=good+1;</script>";
          if (!preg_match("/^[a-zA-Z ]*$/",$uname)) {
            $nameErr = "Only letters allowed";
          }
        }

        if (empty($_POST["pass"])) {
          $passErr = "password is required";
        } else {
          $pass = $_POST["pass"];
          echo "<script>good=good+1;</script>";
        }
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $time = date("m/d/Y h:i:sa");
    ?>
    <script>
      function isGood(){
        if(good !== 4)return false;
        <?php
          // $servername = "localhost";$username = "root";$password = "";$dbname="trailhead";
          // $conn = new mysqli($servername, $username, $password,$dbname);
          // // Check connection
          // if ($conn->connect_error) {
          //     die("Connection failed: <br>" . $conn->connect_error);
          // }
          // $sql = $conn->prepare("select uname from users where uname=(?)");
          // $sql->bind_param("s",$_POST["uname"]);
          // $sql->execute();
          // $result=$sql->get_result();
          //
          // if ($result->num_rows>0) {
          //   $unameErr = "Username already taken!";
          //   echo "return false;";
          // } else {
          //   echo "return true;";
          // }
          // $conn->close();
         ?>
      }
    </script>
      <div id="login">
        <h1>Welcome! Please register here:</h1>
        <p><span class="error">* required field</span></p>
        <form method="post" onsubmit="return validate()" action="registerconfirmation.php">
          <fieldset>
            First Name: <input type="text" id="fname" name="fname">*
            <br><br>
            Last Name: <input type="text" id="lname" name="lname">*
            <br><br>
            ID: <input type="text" id="id" name="id">*
            <br><br>
            E-mail: <input type="text" id="email" name="email">*
            <br><br>
            <input type="radio" id="admin" name="status" <?php if (isset($status) && $status=="admin") echo "checked";?> value="Faculty">Faculty<br>
            <input type="radio" id="student" name="status" <?php if (isset($status) && $status=="student") echo "checked";?> value="Student">Student<br>
          </fieldset>
          <br>
          <fieldset>
            Username: <input type="text" id="uname" name="uname">
            <span class="error">* <?php echo $unameErr;?></span>
            <br><br>
            Password: <input type="text" id="pass" name="pass">
            <span class="error">* <?php echo $passErr;?></span>
          </fieldset>
          <br>
          <input type="hidden" name="time" value="<?php echo $time;?>">
          <input type="submit" name="submit" value="Submit">
          <input type="reset" name="reset" value="Reset">
        </form>
      </div>
  </article>
  <script>
      // define variables and set to empty values
      ffunction validate() {
    var a = document.getElementById("fname").value;
    var b = document.getElementById("lname").value;
    var c = document.getElementById("email").value;
    var d = document.getElementById("id".value;
    var e = document.forms["form"]["status"].value;
    var reg = /[ !@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]/;
    if (a == null || a == "" || b == null || b == "" || c == null || c == "" || d == null || d == "" || e == null || e == "") {
      alert("Please Fill All Required Field");
      return false;
    } else if(reg.test(a) || reg.test(b)) {
        alert('Input is not alphanumeric');
        return false;
    } else if(d <= 0){
      alert('ID must be greater than 0.');
      return false;
    } else if(!emailValid(c)){
      alert('Not a valid email.');
      return false;
    } else {
      return true;
    }
  }

  function emailValid(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
  }
    </script>
  </div>
  <footer style="padding-top:5px">
    <p class="validation">HTML:</p>
    <img class="validation" src="images/html5.png" alt="html5 validation" style="height:2em">
    <p class="validation">CSS:</p>
    <img class="validation" src="images/css.png" alt="css validation" style="height:2em">
    <p class="validation">WCAG:</p>
    <img class="validation" src="images/wcag2AAA.png" alt="wcag validation" style="height:2em">
    <p>This file was last updated on <?php date_default_timezone_set("America/Denver");echo date('M/d/Y h:i',filemtime("register.php"));?>
  </footer>
</body>
</html>
