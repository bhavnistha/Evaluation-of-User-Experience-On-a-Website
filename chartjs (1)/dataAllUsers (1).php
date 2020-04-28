<?php
//Time taken by each user of specific Association
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

$src = $_SESSION ["src"];
$dest = $_SESSION ["dest"];
$assoc = $_SESSION ["role"];
//echo $src."<br>".$dest;
//query to get data from the table
$query = sprintf("SELECT ID, Association, Source, Destination, TimeTaken FROM TaskInfo
	              WHERE Source ='Indira Gandhi Delhi Technical University' AND Destination ='Research and Consultancy' AND Association ='StudentAssoc'");

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