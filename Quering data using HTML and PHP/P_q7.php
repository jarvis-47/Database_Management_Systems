<!DOCTYPE html>
<html>
<head>
	<title>DBMS Example</title>
	<style>
		h1 {
			font-size: 36px;
			text-align: left;
			margin-top: 50px;
		}
		p {
			font-size: 24px;
			text-align: left;
			margin-top: 20px;
		}
    table {
      border: 1px solid black;
      margin: 0 auto;
      font-size: 24px;
      text-align: left;
    }
	</style>
</head>
<body>
	<h1>CPSC 6620</h1>
	<p>Query 7 : Use regular expression pattern matching to show name, owner, and birth date of the pets whose names start with 'F' and end with 'y' or 'r' in table pet.</p>

<?php
// Connect to MySQL database
$servername = "mysql1.cs.clemson.edu";
$username = "paramps";
$password = "cpsc46206620";
$dbname = "Menagerie1";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Define the SQL query to describe the table
$sql = "SELECT name, owner, birth FROM pet WHERE name
REGEXP '^F' AND name REGEXP '[ry]$';";

// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Display the results in a table
echo "<table border='1'>";
echo "<tr>";
$row = mysqli_fetch_assoc($result);
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
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    foreach ($row as $key => $value) {
        if (empty($value)) {
            echo "<td>NULL</td>";
        } else {
            echo "<td>" . $value . "</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";

// Show the number of rows affected
$num_rows = mysqli_affected_rows($conn);
echo "<p>" . $num_rows . " rows were affected.</p>";

// Close the connection
mysqli_close($conn);
?>


</body>
</html>