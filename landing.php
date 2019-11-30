<!DOCTYPE html>
<html lang=en-us>
<head>
  <title>Trailhead</title>
  <meta charset="utf-8">
  <meta name="description" content="Trailhead Student Service">
  <meta name="author" content="Erin Clark, Seifeldin Dabbour, Adrian Estrada">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="login.css" />
	<!-- Styling. Mainly used for table -->
	<style>
		.landing {
			background-color: lightgrey;
			width: 90%;
			border-radius: 15px;
			border: 1px solid black;
			margin: 0 auto;
		}
		caption {
			background-color: lightgrey;
			border: 1px solid black;
		}
		table {
			margin-top: 20px;
			border: 1px solid black;
			background-color: lightgrey;
		}
		th, td {
			text-align: center;
		}
		table#scheduleTable caption {
			font-size: 30px;
			font-weight: bold;
		}
		table#scheduleTable th, td {
			border: 1px solid black;
			border-collapse: collapse;
		}
		table#scheduleTable thead {
			color: black;
			background-color: #4CAF50;
		}
		table#scheduleTable td {
			background-color: white;
		}
	</style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
  </script>
</head>
<body style="text-align:center">
  <?php
  	error_reporting(E_ALL);
    session_start();
    if(time()>=$_SESSION['exp']){
    echo "<script>alert('Login token timeout');
    window.location.replace('login.php');</script>";
  } ?>
	<div class = "landing">
	<?php
    $servername = "localhost";$username = "root";$password = "";$dbname = "trailhead";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $userID=$_SESSION['id'];
	$sql = "SELECT first FROM students WHERE id = '$userID' ";
	$result = $conn->query($sql);
	echo $conn->error;
	$row = $result->fetch_assoc();

	?>

	<h1>Welcome, <?php echo $row["first"] ?>! Make some changes! </h1>
  <button onclick="window.location.href = 'catalog.php';" style="margin-botton:5px;">Course Catalog</button>
  <button onclick="window.location.href = 'reset.php';" style="margin-botton:5px;">Change Password</button>
  <br><br>
  <label>Add an available course to your schedule: </label>
	<br />
	<select name="add" id="selection">
	<option value="" disabled selected>Please select a course</option>
		<?php
		$sql = "SELECT courseid, name FROM courses WHERE courseid NOT IN (SELECT courseid FROM schedules
		WHERE userid = '$userID')";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$class = $row["courseid"] . " " . $row["name"];
				?><option value=<?php echo $class;?>><?php echo $class ?></option><?php
			}
		}
		// output data of each row
		?>
	</select>

	<button type="button" onclick="updateAdd();" style="margin-botton:5px;">Submit Change</button>

	<?php
		$sql = "SELECT first FROM students WHERE id = '$userID' ";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
	?>

	<br />
	<br />

	<label>Delete a course from your schedule: </label>
	<br />
	<select name="add" id="selectionDel">
	<option value="" disabled selected>Please select a course</option>
		<?php
		$sql = "SELECT schedules.courseid, courses.name FROM schedules, courses
		WHERE '$userID' = schedules.userid AND schedules.courseid = courses.courseid  ";
		//$sql = "SELECT courseid, name FROM courses";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				$class = $row["courseid"] . " " . $row["name"];
				?><option value=<?php echo $class;?>><?php echo $class ?></option><?php
			}
		}
		// output data of each row
		?>
	</select>

	<button onclick="updateDelete();" style="margin-botton:5px;">Submit Change</button>
	<br><br>
	<button type="button" onclick="location.href='logout.php'" style="margin-botton:5px;">Logout</button>
	<br><br>
	</div>
	<br />
	<br />
	<br />
	<br />


	<table id="scheduleTable" style="width:100%">
		<caption>Your current schedule</caption>
		<thead>
			<tr>
				<th>Course Id</th>
				<th>Course Name</th>
			</tr>
		</thead>
		<tbody>


		<?php
			$sql = "SELECT schedules.courseid, courses.name FROM schedules, courses
		    WHERE '$userID' = schedules.userid AND schedules.courseid = courses.courseid ";
			$result = mysqli_query($conn, $sql);
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>" . $row["courseid"] . "</td> ";
				echo "<td>" . $row["name"] . "</td>";
				echo "</tr>";
			}
		?>

		</tbody>
	</table>
	<?php
		$conn->close();
	?>
	<script>
  // Add and remove course functionality
		function updateAdd() {
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			} else {  // code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					document.getElementById("scheduleTable").innerHTML=this.responseText;
				}
			}
			var className = document.getElementById('selection').value;
			var userInfo = '<?php echo $userID; ?>';

			xmlhttp.open("GET","addlanding.php?q="+className+"&r="+userInfo,true);
			xmlhttp.send();
		}

		function updateDelete() {
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			} else {  // code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					document.getElementById("scheduleTable").innerHTML=this.responseText;
				}
			}
			var className = document.getElementById('selectionDel').value;
			var userInfo = '<?php echo $userID; ?>';
			xmlhttp.open("GET","deletelanding.php?q="+className+"&r="+userInfo,true);
			xmlhttp.send();
		}

	</script>
</body>
<footer style="padding-top:5px">
    <p class="validation">HTML:</p>
    <img class="validation" src="images/html5.png" alt="html5 validation" style="height:2em">
    <p class="validation">CSS:</p>
    <img class="validation" src="images/css.png" alt="css validation" style="height:2em">
    <p class="validation">WCAG:</p>
    <img class="validation" src="images/wcag2AAA.png" alt="wcag validation" style="height:2em">
    <p>This file was last updated on <?php date_default_timezone_set("America/Denver");echo date('M/d/Y h:i',filemtime("landing.php"));?>
  </footer>
</html>
