$(document).ready(function(){
	$.ajax({
		url: "http://localhost/final_track/chartjs/dataPerUser.php",
		method: "GET",
		type: "JSON",
		success: function(data) {
			console.log(data);
			var URLTitle = [];
			var steps = [];
			var n = 1;
			for(var i in data) {
				URLTitle.push(data[i].URLTitle);
				steps.push(n);
				n = n + 1;
						
			}
      
            /* Bar graph Attributes */     
			var chartdata = {
				labels: URLTitle,
				datasets : [
					{
						label: 'Path',
						backgroundColor: 'rgba(174, 215, 91, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(250, 38, 38, 1)',
						hoverBorderColor: 'rgba(250, 38, 38, 1)',
						data: steps
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