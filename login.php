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
    <h1>Welcome! Please log in below:</h1>
    <p><span class="error">* required field</span></p>
    <form method="post" action= "landing.php" onsubmit="return validate()"> 
      <fieldset>
        <label for="username">Username:</label> <input type="text" id="username" name="username"> *
        <br><br>
        <label for="pass">Password:</label><input type="text" id="pass" name="pass"> *
        <br>
      </fieldset>
      <br>
      <input type="hidden" name="time" value="<?php echo $time;?>">
      <input type="submit" name="submit" value="Submit">
      <input type="reset" name="reset" value="Reset">
    </form>
    </div>
    <p>Or...Register here:</p>
    <button onclick="window.location.href = 'register.php';" style="margin-botton:5px;">Register Now!</button>
    <br><br>
    </article>
    </div>
    <script>
      // define variables and set to empty values
      function validate() {
        var a = document.getElementById("username").value;
        var b = document.getElementById("pass").value;
        var reg = /[ !@#$%^&*()_+\-=\[\]{};:"\\|,.<>\/?]/;
        if (a == null || a == "" || b == null || b == "") {
          alert("Please Fill All Required Field");
          return false;
        } else if(reg.test(a) || reg.test(b)) {
            alert('Input is not alphanumeric');
            return false;
        } else {
          return true;
        }
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
