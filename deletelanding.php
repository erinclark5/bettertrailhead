
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "trailhead";


	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $db);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	error_reporting(E_ALL);
	
	$courseID = $_GET["q"];
	// $temp = explode(" ", $_GET["q"], 2);
	// $courseID = $temp[0];
	// $courseName = $temp[1];

	$userID = $_GET["r"];

	$sql = "SELECT * FROM schedules WHERE userid = '$userID'";
	$result = $conn->query($sql);

	$sql = "SELECT * FROM schedules WHERE courseid LIKE '$courseID'";
	$result = $conn->query($sql);

	$sql = "DELETE FROM schedules WHERE userid = '$userID' AND courseid LIKE '$courseID'";
	$result = $conn->query($sql);
	
	$sql = "SELECT schedules.courseid, courses.name FROM schedules, courses
		    WHERE '$userID' = schedules.userid AND schedules.courseid = courses.courseid  ";
	$result = $conn->query($sql);

	$arr = array();
	array_push($arr, "<caption>Your current schedule</caption>");
	array_push($arr, "<thead>");
	array_push($arr, "<tr>");
	array_push($arr, "<th>Course Id</th>");
	array_push($arr, "<th>Course Name</th>");
	array_push($arr, "</tr>");
	array_push($arr, "</thead>");
	array_push($arr, "<tbody>");
	
	if($result && $result->num_rows > 0){
	while($row = $result->fetch_assoc()) {
		array_push($arr, "<tr>");
		$num = "<td>" . $row['courseid'] . "</td>";
		$name = "<td>" . $row['name'] . "</td>";
		
		array_push($arr, $num);
		array_push($arr, $name);
		array_push($arr, "</tr>");
	}
	
	array_push($arr, "</tbody>");
	array_push($arr, "</table>");
}

foreach ($arr as $key => $val) {
   echo $val;
}


?> 