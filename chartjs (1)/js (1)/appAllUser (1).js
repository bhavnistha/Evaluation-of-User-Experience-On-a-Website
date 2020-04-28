$(document).ready(function(){
	$.ajax({
		url: "http://localhost/final_track/chartjs/dataAllUsers.php",
		method: "GET",
		type: "JSON",
		success: function(data) 
		{
			console.log(data);
			var ID = [];
			var TimeTaken = [];
			var Association = [];
			var assc;
			for(var i in data) 
			{
				/*  Pushing User id */
				ID.push(data[i].ID);   
				/* Pushing Time Taken by each user */
				TimeTaken.push(data[i].TimeTaken); 
			}			
			for (var i in data)
			{
				/* Pushing Association of each user */
				Association.push(data[i].Association); 
				break;
			}
			/* Considering the first element of Association as all will be same */
			assc = Association[0]; 
		      
        /* Bar graph Attributes */      
		var chartdata = {
			labels: ID,
			datasets : [
				{
					label: assc,
					backgroundColor: 'rgba(95, 158, 160, 0.75)',
					borderColor: 'rgba(95, 158, 160, 0.75)',
					hoverBackgroundColor: 'rgba(238, 68, 102, 0.75)',
					hoverBorderColor: 'rgba(238, 68, 102, 0.75)',
					data: TimeTaken
				}
			]
		};
		
		/* Selecting the chart id */
		var ctx = $("#mycanvas");
			var barGraph = new Chart(ctx, {
			type: 'bar',
			data: chartdata,
			
		});
	},
	error: function(data) {
		console.log(data);
	}
  });
});