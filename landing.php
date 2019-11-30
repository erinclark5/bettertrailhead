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
		table {
			margin-top: 20px;
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
			color: #FFFFFF;
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
    session_start();
    if(time()>=$_SESSION['exp']){
    echo "<script>alert('Login token timeout');
    window.location.replace('login.php');</script>";
  } ?>
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







	<?php
    $servername = "localhost";$username = "root";$password = "";$dbname = "trailhead";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $userID=$_SESSION['id'];
		$sql = "SELECT first FROM STUDENTS WHERE id = '$userID' ";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
	?>

	<h1>Welcome, <?php echo $row["first"] ?>! Make some changes! </h1>

	<label>Add an available course to your schedule: </label>
	<br />
	<select name="" id="selection">
		<?php
		$sql = "SELECT courseid, coursename FROM COURSES";
		$result = mysqli_query($conn, $sql);

		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {

		?>
			<option value="<?php
			$class = $row["courseid"] . " " . $row["coursename"];
			echo $class ;?>"> <?php echo $class ;?> </option>
		<?php
		}
		?>
	</select>

	<button type="button" onclick="updateAdd();" style="margin-botton:5px;">Submit Change</button>

	<?php
		$sql = "SELECT first FROM STUDENTS WHERE id = '$userID' ";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
	?>

	<br />
	<br />

	<label>Delete a course from your schedule: </label>
	<br />
	<select name="" id="selectionDel" onchange='check();'>
		<?php
		$sql = "SELECT courseid, coursename FROM COURSES";
		$result = mysqli_query($conn, $sql);

		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {

		?>
			<option value="<?php
			$class = $row["courseid"] . " " . $row["coursename"];
			echo $class ;?>"> <?php echo $class ;?> </option>
		<?php
		}
		?>
	</select>

	<button onclick="updateDelete();" style="margin-botton:5px;">Submit Change</button>

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
				echo "<td>" . $row["coursename"] . "</td>";
				echo "</tr>";
			}
		?>

		</tbody>
	</table>


	<?php
		$conn->close();
	?>
</body>
</html>
