<!-- To store the plugin popup information in the SessionInfo table -->
<?php 
 include ("connection.php");
 $temp = 0;
 if( $_SERVER["REQUEST_METHOD"] == "POST" )
    {
        session_start();
       $conn = mysqli_connect($db_host,$db_username,$db_password)or die(mysqli_error());

       // fetching the information from registerForm into php variables using POST method.
        $userid = mysqli_real_escape_string($conn,$_POST["userid"]);
        $source = mysqli_real_escape_string($conn,$_POST["source"]);
        $sourcetitle = mysqli_real_escape_string($conn,$_POST["sourcetitle"]);
        $destination = mysqli_real_escape_string($conn,$_POST["destination"]);
        $destinationtitle = mysqli_real_escape_string($conn,$_POST["destinationtitle"]);
        $other = mysqli_real_escape_string($conn,$_POST["other"]);
        $othertitle = mysqli_real_escape_string($conn,$_POST["othertitle"]);
        $status= mysqli_real_escape_string($conn,$_POST["status"]);

/*
        the $status variable stores the status value obtained from registerForm file
        START=0
        STOP=1
        QUIT=2
        $status is required to identify which button was clicked
*/
        
      if ($status == 0)
{
          $temp = 1;
}   
      
        mysqli_select_db($conn,"TrackIt") or die("Cannot connect to Database");

        // this fetches the task-id from FLAG table
        $id = mysqli_query($conn,"SELECT Value from Flag where Title='Value'");
        $row = mysqli_fetch_row($id);
        $id = $row[0];

        $_SESSION["userid"] = $userid;
        $_SESSION["source"] = $source;
        $_SESSION["sourcetitle"] = $sourcetitle;
        $_SESSION["destination"] = $destination;
        $_SESSION["destinationtitle"] = $destinationtitle;
        $_SESSION["other"] = $other;
        $_SESSION["othertitle"] = $othertitle;
        $_SESSION["id"] = $id; 
        $_SESSION["status"] = $status;
        $_SESSION["temp"] = $temp;


// filling in the SessionInfo table according to the status value

if($status==0)
{
        mysqli_query($conn,"INSERT INTO SessionInfo(UserID , SessionID, SourceURL, SourceTitle, DestinationURL, DestinationTitle) VALUES ('$userid','$id', '$source', '$sourcetitle', '$destination', '$destinationtitle')");
}else if($status==1)
{
        mysqli_query($conn,"UPDATE SessionInfo SET DestinationURL= '$destination', DestinationTitle= '$destinationtitle' WHERE SessionID='$id' ");
}else
{
        mysqli_query($conn,"UPDATE SessionInfo SET DestinationURL= '$other', DestinationTitle= '$othertitle'  WHERE SessionID='$id' ");
}

//this is used to increment the task-id because $status=1 and $status=2 represents the end of task.
if($status==1||$status==2)
{
        mysqli_query($conn,"UPDATE Flag SET Value=Value + 1 WHERE Title = 'Value' ");  
}
    }
  
?>