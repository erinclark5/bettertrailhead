<!DOCTYPE html>
<html lang=en-us>
<head>
  <title>Failed Login</title>
  <meta charset="utf-8">
  <meta name="description" content="Trailhead Student Service">
  <meta name="author" content="Erin Clark, Seifeldin Dabbour, Adrian Estrada">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="login.css" />
</head>
<style>
.error{color: #FF0000;font-size:50px;}
button:hover{
  font-weight: bold;
  background-color: #49fb35;
}
</style>
<body style="text-align:center;">
  <div class="info">
    <p class="error">Failed Login Attempt:<br>USER NOT FOUND!</p>
    <p>Return to Login or Register</p>
    <button onclick="window.location.href = 'login.php';" style="margin-botton:5px;">Login Again!</button>
    <button onclick="window.location.href = 'register.php';" style="margin-botton:5px;">Register Here!</button>
    <br><br>

  </div>
</body>
</html>
