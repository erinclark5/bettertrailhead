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
    <nav>

    </nav>

  </header>
  <hr>
  </div>

  <div class="info">
  <article>
    <?php
    // define variables and set to empty values
    $nameErr = "";
    $uname = $pass = "";
    echo "<script> var good=0;</script>";
    date_default_timezone_set("America/Denver");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["uname"])||empty($_POST["pass"])) {
        $nameErr = "Both fields required";

      } else {
        $uname = test_input($_POST["uname"]);
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
      function imgchange(){
        var x = document.getElementById("prod").value;
        document.getElementById("prodpic").src = '../php/img/'.concat(x,'.jpg');
      }
      function isGood(){
        if(good == 1)return true;
      }
    </script>
      <div id="login">
        <h1>Welcome! Please log in below:</h1>
        <p><span class="error">* required field</span></p>
        <form method="post" onsubmit=isGood() action="landing.php">
          <fieldset>
            Username: <input type="text" id="uname" name="uname">
            <span class="error">* <?php echo $nameErr;?></span>
            <br><br>
            Password: <input type="password" id="pass" name="pass">
            <span class="error">* <?php echo $nameErr;?></span>
          </fieldset>
          <br>
          <input type="hidden" name="time" value="<?php echo $time;?>">
          <input type="submit" name="submit" value="Submit">
          <input type="reset" name="reset" value="Reset">
        </form>
      </div>
      <p>Or...Register here:</p>
      <button onclick="window.location.href = 'register.php';" style="margin-bottom:5px;">Register Now!</button>
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
