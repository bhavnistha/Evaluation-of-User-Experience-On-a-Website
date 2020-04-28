<?php
include ("connection.php");
# Main code which saves the tracked sites in the database

# First gets the source and destination site for the task
# gets the url and title of the page currently visited
# Either compares the url with the source
#    if the source matches, the StartTime is marked
# Or compares the url with the destination
#   if the destination matches the FinishTime is marked
#   The difference between the two is computed and saved
    
    session_start();

    $userid = $_SESSION["userid"];
    $source = $_SESSION["source"];
    $destination = $_SESSION["destination"];
    $other = $_SESSION["other"];
    $id = $_SESSION["id"];
    $status = $_SESSION["status"];
    $temp = $_SESSION["temp"];

 
    # Extracting sent URL and title from bg.js
     
     $url = $_REQUEST['url'];
$title = $_REQUEST['title'];
    echo "URL is : ".$url;
echo "Title is : ".$title;


    $conn = mysqli_connect($db_host,$db_username,$db_password) or  die(mysqli_error());

     mysqli_select_db($conn,"TrackIt");

    // to set the timezone
    date_default_timezone_set('Asia/Kolkata');
    $timezone = date_default_timezone_get();
echo "The current server timezone is: " . $timezone;

    # Inserting the Start Time 
    if (($status==0) || (strcmp($url,$source)==0))
    {
       $st = mysqli_query($conn, "SELECT StartTime from SessionInfo where SessionID='$id'");
       $row = mysqli_fetch_row($st);
       $startTime = $row[0];

       if ($startTime == NULL)
       {
         $t = date("H:i:s");
        
         $sql = "UPDATE SessionInfo SET StartDate=curdate(), StartTime = '$t' WHERE SessionID = '$id'";  
         if (mysqli_query($conn,$sql))
            echo "Time inserted";
         else
            echo "Time not possible";
       }  
    }

    if ($status==2)
    {
       $sql = "UPDATE SessionInfo SET EndDate='NULL',  FinishTime = 'NULL', TimeTaken = 'NULL' WHERE SessionID = '$id'";
       if (mysqli_query($conn,$sql))
            echo "Finish Time and time taken inserted";
       else
            echo "Time not possible";
       session_destroy();

    }

    #  Inserting the Finish Time
    if (($status==1) || (strcmp($url,$destination)==0))
    {
       $ft = mysqli_query($conn,"SELECT FinishTime from SessionInfo where SessionID='$id'");
       $row = mysqli_fetch_row($ft);
       $finishTime = $row[0];
       
       if ($finishTime == NULL)
       {
         $t = date("H:i:s");
         $sql = "UPDATE SessionInfo SET EndDate = curdate(), FinishTime = '$t' WHERE SessionID = '$id'";  
         if (mysqli_query($conn,$sql))
            echo "Finish Time inserted";
         else
            echo "Time not possible";
       }

       session_destroy();

       # Finding the total time
       $st = mysqli_query($conn,"SELECT StartTime from SessionInfo where SessionID='$id'");
       $row = mysqli_fetch_row($st);
       $start_time = $row[0];
       $STime=strtotime($start_time);


       $ft = mysqli_query($conn,"SELECT FinishTime from SessionInfo where SessionID='$id'");
       $row = mysqli_fetch_row($ft);
       $finish_time = $row[0];
       $FTime=strtotime($finish_time);



       echo $start_time.'\n';
       echo $finish_time.'\n';

       $time_taken = $FTime-$STime;
      # settype($time_taken,'integer');
       #var_dump($time_taken);

      # $hr=0
      # while($($time_taken/3600)!=0)
     #{
      # $time_taken/=3600;
      # $hr++;
     #} 
     #$min=0       
   # while($($time_taken/60)!=0)
     #{
      # $time_taken/=60;
      # $min++;
    # }  
     
    #$TT = $hr." hrs ".$min."min ".$time_taken."sec ";     


       echo $time_taken;
       $sql = "UPDATE SessionInfo SET TimeTaken = '$time_taken' WHERE SessionID = '$id'";  
       
       if (mysqli_query($conn,$sql))
            echo "Finish Time inserted";
         else
            echo "Time not possible";
          
      $avg = "SELECT AVG(TimeTaken) FROM SessionInfo GROUP BY Source GROUP BY Destination";
      $arow = mysqli_fetch_row($avg);
      $timet = $arow[0];
    }
    
    # To not log null and localhost/phpmyadmin URL
    # Some miscelleous sites were also getting tracked 
    # In order to avoid it, we added these ad hoc lines
   #$id = "user".$id;

    if ((strcmp($url,"null")==0) || (strcmp($url,"http://localhost/phpmyadmin/sql.php?server=1")== 0))
    {
        echo " URL wont be logged";
    }
    else
     {
       if ( $temp == 1 )
{
	  #$cd=curdate();
       $ct= date("H:i:s");
       
       $sql = "INSERT INTO UserNavigation(UserID,SessionID,UrlTitle,TitleName,Date,Timestamp) VALUES ('$userid','$id','$url','$title',curdate(),'$ct')";
       if ( mysqli_query($conn,$sql))
       {
           echo " Table insertion successful";
       }
       else
        echo " Error creating Table"."</br>". mysqli_error($conn);
 }     
   
     }
     
if ( $status ==1 || $status ==2 )
{
  $temp = 0;
$_SESSION["temp"] = $temp;

}
    mysqli_close($conn);

?>