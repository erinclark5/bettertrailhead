
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "mysql";


	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $db);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	
	
	
	$temp = explode(" ", $_GET["q"], 2);
	$courseID = $temp[0];
	$courseName = $temp[1];

	
	$userID = $_GET["r"];
	
	$sql = "DELETE FROM schedules WHERE studentid = '$userID' AND courseid = '$courseID'";

	$result = mysqli_query($conn, $sql);
	
	$sql = "SELECT schedules.courseid, courses.coursename FROM schedules, courses
		    WHERE '$userID' = schedules.studentid AND schedules.courseid = courses.courseid  ";
	$result = mysqli_query($conn, $sql);

	$arr = array();
	array_push($arr, "<caption>Your current schedule</caption>");
	array_push($arr, "<thead>");
	array_push($arr, "<tr>");
	array_push($arr, "<th>Course Id</th>");
	array_push($arr, "<th>Course Name</th>");
	array_push($arr, "</tr>");
	array_push($arr, "</thead>");
	array_push($arr, "<tbody>");
	
		
	while($row = mysqli_fetch_assoc($result)) {
		array_push($arr, "<tr>");
		$num = "<td>" . $row['courseid'] . "</td>";
		$name = "<td>" . $row['coursename'] . "</td>";
		
		array_push($arr, $num);
		array_push($arr, $name);
		array_push($arr, "</tr>");
	}
	
	array_push($arr, "</tbody>");
	array_push($arr, "</table>");


foreach ($arr as $key => $val) {
   echo $val;
}


?> 