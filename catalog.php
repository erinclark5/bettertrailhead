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
        div {
            margin-top: 0px;
        }
        caption {
			background-color: darkorange;
            font-size: large;
		}
		table {
			border: 1px solid black;
            background-color: white;
            margin: 0 auto;
            border: 1px solid black;
            border: 1px solid black;
            border-collapse:collapse;
            width: 90%;
            padding: 0;
		}
		th, td {
            text-align: center;
            border: 1px solid black;
            border: 1px solid black;
            border-collapse:collapse;
        }
        h1 {
            margin: 0px;
            padding: 0px;
        }
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
    <br>
    <h1>Course Catalog</h1>
    <?php
    $sql = "SELECT * FROM courses";
	$result = $conn->query($sql);

    echo "<table>";
	echo "<caption>Courses</caption>";
	echo "<thead>";
	echo "<tr>";
	echo "<th>Course Id</th>";
	echo "<th>Course Name</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

	if($result && $result->num_rows > 0){
	    while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<br>";
		    $num = "<td>" . $row['courseid'] . "</td>" . " ";
		    $name = "<td>" . $row['name'] . "</td>";

		    echo $num;
		    echo $name;
		    echo "</tr>";
	    }
    }
	echo "</tbody>";
    echo "</table>";
    echo "<br>";
?>
<script>

  function ret(){

    <?php
      session_start();
      $val=1-empty($_SESSION['aliasID']);
      echo "var x = ".$val.";";
     ?>
    if(x==1){window.location.href = 'admin.php';}
    else{window.location.href = 'landing.php';}
  }
</script>
<button onclick="ret()" style="margin-botton:5px;">Back</button>
</div>

  </div>
  <footer style="padding-top:5px">
  <br>
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
