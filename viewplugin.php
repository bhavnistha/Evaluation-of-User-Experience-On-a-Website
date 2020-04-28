<!-- Page to view the visualiation for analysis -->
<?php
    session_start();
?>

<html >
<head>
  <meta charset="UTF-8">
  <title> Analysis </title>
      <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="header">
	<img class="logo" src="icon.png"/>
 	<h1>TrackIt</h1>
	<div class="links">
		<a href="options.html">Settings |</a>
		<a href="login4plugin.php"> Logout</a>
	</div>
</div>
<hr>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
<div class="view-page">
    
	<div class="dropdwn">
	    Source:

		<select name="source" style="width: 100px;">
 		<option value="Indira Gandhi Delhi Technical University"> Indira Gandhi Delhi Technical University for Women </option>
 		<option value="Scholarships"> Scholarships</option>
 		<option value="Result May 2017"> Result May 2017 </option>
		</select>
	</div>
	<div class="dropdwn">
    	Destination: 

		<select name="dest" style="width: 100px;">
 		<option value="Research and Consultancy"> Research and Consultancy </option>
 		<option value="Academic Calendar 2017-18"> Academic Calendar </option>
 		<option value="hostel"> Hostel </option>
		</select>
	</div>
 	<div class="dropdwn">
		Association:  
		<select name="role" style="width: 100px;">
		<option value="all"> ALL </option>
 		<option value="StudentAssoc"> Student </option>
 		<option value="FacultyAssoc"> Faculty </option>
 		<option value="ParentAssoc"> Parent </option>
 		<option value="OtherAssoc"> Others </option>
		</select>
	</div>
	
</div>
<input type="submit" name="submit" class="button" style="margin-top: 10px;">
<!--<button class="button">Submit</button>-->
</form>
<div class="graph">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $srcrc = test_input($_POST["source"]);
  $dest = test_input($_POST["dest"]);
  $assoc = test_input($_POST["role"]);

  $_SESSION["src"] = $srcrc;
  $_SESSION["dest"] = $dest;
  $_SESSION["role"] = $assoc;

  if($_SESSION["role"] == "all")
  	{
  		echo "<html><head>";
  		echo "<title>ChartJS - Pie</title>";
  		echo "<link type='text/css' rel='stylesheet' href='chartjs/css/default.css' />";
 		echo "</head><body><table style='border-bottom: 1px solid black;background-color: 	#F0F8FF; margin-top: 50px; width: 35%' align='center' ><tbody>";
 		echo "<tr><td>";
 		echo "<div class='chart-container'><div class='pie-chart-container'><canvas id='pie-chartcanvas-1'></canvas></div></div>";
 		echo "</td></tr></tbody></table>";
 		echo "<script src='chartjs/js/jquery.min.js'></script>";
 		echo "<script src='chartjs/js/Chart.min.js'></script><script src='chartjs/js/pie.js'></script>";
 		echo "</body></html>";
  	}
  else
  	{
  		echo "<html><head><title>ChartJS - BarGraph</title>";
  		echo "<style type='text/css'>#chart-container {	width: 640px; height: auto;	}";
  		echo "table,{border-collapse: collapse;}tr, td{	border-bottom: 2px solid rgb(211, 211, 211);
			}";
		echo "tr:nth-child(even){background-color: rgb(240, 222, 230);}</style>";
		echo "	</head><body>";
		echo "<table style='background-color: 	#F0F8FF;' align='center'>";
	    echo "<tbody><tr><td>";
	    echo "<div id='chart-container'><canvas id='mycanvas'></canvas></div></td></tr>";
	    echo "<form action='/final_track/perUser.php' method='POST' target='_BLANK'>";
	    echo "<tr align='center'><td><input type='text' name='user' style='margin-top: 10px;'></td></tr>";
	    echo "<tr align='center'><td><input type='submit' name='userb' value='Find'></td></tr></form>";
	    echo "</tbody></table>";
	    echo "<!-- javascript -->";
	    echo "<script type='text/javascript' src='chartjs/js/jquery.min.js'></script>";
	    echo "<script type='text/javascript' src='chartjs/js/Chart.min.js'></script>";
	    echo "<script type='text/javascript' src='chartjs/js/appAllUser.js'></script>";
	    echo "<script type='text/javascript' src='chartjs/js/appPerUser.js'></script>";
	    echo "</body></html>";

  	}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}
?>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
