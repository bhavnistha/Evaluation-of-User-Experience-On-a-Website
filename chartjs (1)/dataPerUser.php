<?php
//User Vise Action
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
$usernum = $_SESSION["userno"];
//echo $src."<br>".$dest;
//query to get data from the table
$user = "user".$usernum;
$query = sprintf("SELECT URLTitle FROM $assoc
	              WHERE UserID = '$user'");

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