$(document).ready(function(){
	$.ajax({
		url: "http://localhost/final_track/chartjs/data.php",
		method: "GET",
		type: "JSON",
		success: function(data) {
			console.log(data);
			var Association = [];
			var TimeTaken = [];

			for(var i in data) {
			
{				Association.push(data[i].Association);
				TimeTaken.push(data[i].TimeTaken);
}			}
      

			var chartdata = {
				labels: Association,
				datasets : [
					{
						label: 'Average Time',
						backgroundColor: ['rgba(35, 259, 96, 0.75)','rgba(249, 161, 35, 0.75)', 'rgba(244, 154, 251, 0.75)', 'rgba(83, 169, 12, 0.75)','rgba(64, 12, 149, 0.75)'],
						borderColor: ['rgba(35, 259, 96, 0.75)','rgba(249, 161, 35, 0.75)', 'rgba(244, 154, 251, 0.75)', 'rgba(83, 169, 12, 0.75)','rgba(64, 12, 149, 0.75)'],
						hoverBackgroundColor: ['rgba(35, 259, 96, 0.75)','rgba(249, 161, 35, 0.75)', 'rgba(244, 154, 251, 0.75)', 'rgba(83, 169, 12, 0.75)','rgba(64, 12, 149, 0.75)'],
						hoverBorderColor: ['rgba(35, 259, 96, 0.75)','rgba(249, 161, 35, 0.75)', 'rgba(244, 154, 251, 0.75)', 'rgba(83, 169, 12, 0.75)','rgba(64, 12, 149, 0.75)'],
						data: TimeTaken
					}
				]
			};
			
			var ctx = $("#pie-chartcanvas-1");

			var barGraph = new Chart(ctx, {
				type: 'pie',
				data: chartdata	,		
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});