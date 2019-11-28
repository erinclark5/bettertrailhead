<!DOCTYPE html>
<html lang=en-us>
<head>
  <title>Homepage</title>
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


</head>
<body style="text-align:center">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">			
</script>

	<script>
		function updateAdd() {
			
			if (fname.length==0 && lname.length==0 && email.length==0) {
				document.getElementById("livesearch").innerHTML="";
				document.getElementById("livesearch").style.border="0px";
				return;
			}
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			} else {  // code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML=this.responseText;
				document.getElementById("livesearch").style.border="1px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","gethint.php?q="+fname+"&r="+lname+"&s="+email,true);
			xmlhttp.send();
		}
		
		function updateDelete() {
			
			if (fname.length==0 && lname.length==0 && email.length==0) {
				document.getElementById("livesearch").innerHTML="";
				document.getElementById("livesearch").style.border="0px";
				return;
			}
			if (window.XMLHttpRequest) {
				// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			} else {  // code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
				document.getElementById("livesearch").innerHTML=this.responseText;
				document.getElementById("livesearch").style.border="1px solid #A5ACB2";
				}
			}
			xmlhttp.open("GET","gethint.php?q="+fname+"&r="+lname+"&s="+email,true);
			xmlhttp.send();
		}

	</script>




<?php 
$servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "mysql";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $file = file_get_contents("trailhead.sql");
  if(!mysqli_multi_query($conn, $file)){
    echo "Error: " . mysqli_error($conn);
  }
  while(mysqli_next_result($conn));

  $username = $_POST["username"];
  $pass = $_POST["pass"];
  $sql1 = "SELECT id FROM USERS WHERE uname LIKE '$username' AND pass LIKE '$pass'";
  $result = $conn->query($sql1);
  if(!empty($result) && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      echo "Found";
    }
  } else{
    echo "0 results";
  }
  ?>
  
	
	<?php 
		$sql = "SELECT students.firstname FROM STUDENTS, USERS WHERE students.studentid = users.id "; 
		$result = $conn->query($sql);
		$row = mysqli_fetch_assoc($result);
	?>
  
	<h1>Welcome, <?php echo $row["firstname"] ?>. Make some changes! </h1>
  
	<label>Add an available course to your schedule: </label>
	<br />
	<select name="" id="selection" onchange='check();'>					
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
	
	<button onclick="updateAdd();" style="margin-botton:5px;">Submit Change</button>
	
	<?php 
		$sql = "SELECT students.firstname FROM STUDENTS, USERS WHERE students.studentid = users.id "; 
		$result = $conn->query($sql);
		$row = mysqli_fetch_assoc($result);
	?>
	
	<br />
	<br />
	
	<label>Delete a course from your schedule: </label>
	<br />
	<select name="" id="selection" onchange='check();'>					
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
			<tr>
				<td>Placeholder</td>
				<td>Placeholder</td>
			</tr>
		</tbody>
	</table>
	
  
	<?php
		$conn->close();
	?>
</body>
</html>
