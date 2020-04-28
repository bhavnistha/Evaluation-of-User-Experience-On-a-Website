<?php
include ("connection.php");
    $conn = mysqli_connect($db_host,$db_username,$db_password) or die(mysqli_error());
    $sql = "CREATE DATABASE IF NOT EXISTS TrackIt";
    if(mysqli_query($conn, $sql )){
        echo "Success" ."</br>";
    }
    else{
        echo "Error" ."</br>". mysqli_error($conn);
    }

    mysqli_select_db($conn,"TrackIt" );

    // SessionInfo : Stores the task information - information entered in the extension pop up window
    // along with the time when you reach the source and destination sites
    // Finally computes the difference to save the total traverse time
     $sql1 = "CREATE TABLE IF NOT EXISTS SessionInfo( 
        UserID int NOT NULL,
        SessionID int NOT NULL AUTO_INCREMENT Primary Key,
        SourceURL varchar(512) NOT NULL,
        SourceTitle varchar(512) NOT NULL,
        DestinationURL varchar(512) NOT NULL,
        DestinationTitle varchar(512) NOT NULL,
	   StartDate date,
        StartTime varchar(15),
	   EndDate date,
        FinishTime varchar(15),
        TimeTaken varchar(15))";

    if ( mysqli_query($conn,$sql1))
        echo "Main Table created Succesfully" ."</br>";
    else
        echo "Error creating main table"."</br>". mysqli_error($conn);

    // Creates table to store the sites traversed from source to destination
    
    $sql2 = "CREATE TABLE IF NOT EXISTS UserNavigation(UserID varchar(10),SessionID varchar(10) NOT NULL, UrlTitle varchar(512) NOT NULL,TitleName varchar(512) NOT NULL,Date date,Timestamp varchar(15))";

    if ( mysqli_query($conn,$sql2))
        echo "UserNavigation Table created Succesfully"."</br>";
    else
        echo "Error creating student table"."</br>". mysqli_error($conn);

    
    // The tables above store each unique user's traversed sites in a new column
    // The value of flag is used to give these users a unique number
    $sql7 = "CREATE TABLE IF NOT EXISTS Flag(
    Title varchar(30) NOT NULL,
    Value int NOT NULL)";

    if ( mysqli_query($conn,$sql7))
        echo "Flag Table created Succesfully"."</br>";
    else
        echo "Error creating random table"."</br>". mysqli_error($conn);

    $v = 1;
    $sql8 = "INSERT into Flag (Title,Value) values ('Value','$v')";
    if ( mysqli_query($conn,$sql8))
        echo "Value inserted Succesfully"."</br>";
    else
        echo "Error creating random table"."</br>". mysqli_error($conn);

    
    
    mysqli_close($conn);
?>