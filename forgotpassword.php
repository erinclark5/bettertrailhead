<!DOCTYPE html>
<html lang=en-us>
<head>
  <title>Homepage</title>
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
      date_default_timezone_set("America/Denver");?>

    <div id="login">
    <h1>Forgot Password: <br>Please fill in the fields below</h1>
    <p><span class="error">* required field</span></p>
    <form method="post" action= "forgotconfirmation.php" onsubmit="return validate()">
      <fieldset>
        <label for="username">Username: </label> <input type="text" id="username" name="username"><span class="error">*</span>
        <br><br>
        <label for="email">Email: </label><input type="email" id="email" name="email">
        <br><br>
      </fieldset>
      <br>
      <input type="submit" name="submit" value="Submit">
      <input type="reset" name="reset" value="Reset">
    </form>
    </div>
    <button onclick="window.location.href = 'login.php';" style="margin-botton:5px;">Back to Login</button>
    <br><br>
    </article>
    </div>
    <script>
      // define variables and set to empty values
      function validate() {
        var a = document.getElementById("username").value;
        var b = document.getElementById("email").value;
        var reg = /[ !@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]/;
        if (a == null || a == "") {
          //alert("Please Fill All Required Fields");
          return false;
        } else if((b!==null || b!=="") && !emailValid(c)){
          alert('Not a valid email.');
          return false;
        } else if(reg.test(a)) {
            //alert('Input is not alphanumeric');
            return false;
        } else {
          return true;
        }
      }
      function emailValid(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
      }
    </script>
</article>
  </div>
  <footer style="padding-top:5px">
    <p class="validation">HTML:</p>
    <img class="validation" src="images/html5.png" alt="html5 validation" style="height:2em">
    <p class="validation">CSS:</p>
    <img class="validation" src="images/css.png" alt="css validation" style="height:2em">
    <p class="validation">WCAG:</p>
    <img class="validation" src="images/wcag2AAA.png" alt="wcag validation" style="height:2em">
    <p>This file was last updated on <?php date_default_timezone_set("America/Denver");echo date('M/d/Y h:i',filemtime("login.php"));?>
  </footer>
</body>
</html>
