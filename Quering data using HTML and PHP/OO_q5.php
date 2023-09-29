<!DOCTYPE html>
<html>
<head>
	<title>DBMS Example</title>
	<style>
		h1 {
			font-size: 36px;
			margin-top: 50px;
			text-align: left;
		}
		p {
			font-size: 24px;
			margin-top: 20px;
			text-align: left;
		}
		table {
			border: 1px solid black;
			font-size: 24px;
			text-align: left;
			margin-left: 20px;
		}
		td, th {
			padding: 5px;
			border: 1px solid black;
		}
	</style>
</head>
<body>
	<h1>CPSC 6620</h1>
	<p>Query 5 --> List owner, name, species, event type, and event remark of the pets who had 'litter' event.</p>

<?php
$servername = "mysql1.cs.clemson.edu";
$username = "paramps";
$password = "cpsc46206620";
$dbname = "Menagerie1";

// Create database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check database connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Query the database
$sql = "SELECT owner, pet.name, species, type, remark FROM
pet INNER JOIN event on pet.name = event.name
WHERE event.type = 'litter';";
$result = $conn->query($sql);

// Display results as a table
if ($result->num_rows > 0) {
	echo "<table border='1'>";
	echo "<tr>";
	$row = $result->fetch_assoc();
	foreach ($row as $key => $value) {
		echo "<th>" . $key . "</th>";
	}
	echo "</tr>";
	foreach ($row as $key => $value) {
		if (empty($value)) {
			echo "<td>NULL</td>";
		} else {
			echo "<td>" . $value . "</td>";
		}
	}
	echo "</tr>";
	while($row = $result->fetch_assoc()) {
		echo "<tr>";
		foreach ($row as $key => $value) {
			if (empty($value)) {
				echo "<td>NULL</td>";
			} else {
				echo "<td>" . $value. "</td>";
			}
		}
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "No Result Returned";
}

// Display the number of rows affected
echo "<p>" . $conn->affected_rows . " rows were affected.</p>";

$conn->close();
?>
</body>
</html>