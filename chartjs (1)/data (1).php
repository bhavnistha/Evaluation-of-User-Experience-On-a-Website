<?php
//Average time taken by each association

session_start();
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'TrackIt');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

$src = $_SESSION["src"];
$dest = $_SESSION["dest"];
//echo $src."<br>".$dest;
//query to get data from the table
$query = sprintf("SELECT Association, Source, Destination, AVG(TimeTaken) AS TimeTaken FROM TaskInfo
	              WHERE Source = '$src' AND Destination = '$dest'
	              GROUP BY Association ");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);