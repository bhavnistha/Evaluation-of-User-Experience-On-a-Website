<!-- Visualisation for each distinct user -->
<?php
    session_start();
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
  		$usernum = test_input($_POST["user"]);
  		$_SESSION["userno"] = $usernum;
  	}
  	function test_input($data) 
  	{
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>PerUser Data Show</title>
   	<link rel="stylesheet" href="css/style.css">
    <style type="text/css">
	    #chart-container 
		{
			width: 1000px;
			height: auto;
		}
		table,
		{
			border-collapse: collapse;
		}
		tr, td
		{
			border-bottom: 2px solid rgb(211, 211, 211);
		}
		tr:nth-child(even){background-color: rgb(240, 222, 230);}
	</style>
</head>
<body style="background-color: rgb(242, 242, 242);">
<div class="header">
	<img class="logo" src="icon.png"/>
 	<h1>TrackIt</h1>
</div>
<hr>
<br><br>
<h3 style="color: white;" align="center"> User Vise Action </h3>
<br>
<table style="background-color: rgb(242, 242, 242);" align="center">
	<tbody>
		<tr>
		    <td>
	    	<hr><hr>	
	    	    <!-- User vise Action chart -->
				<div id="chart-container">
					<canvas id="mycanvas"></canvas>
				</div>
			</td>
    	</tr>
    </tbody>
</table>	<!-- javascript -->

<script type="text/javascript" src="chartjs/js/jquery.min.js"></script>
<script type="text/javascript" src="chartjs/js/Chart.min.js"></script>
<script type="text/javascript" src="chartjs/js/app.js"></script>
</body>
</html>
