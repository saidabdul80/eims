

<div style="width: 100%;">
	
	<canvas id="chartNow" width="100%" height="60%"></canvas>
</div>


<script type="text/javascript" src="{{ asset('js/chart.js')}}"></script> 
<script type="text/javascript">
	$(document).ready(function(){

	var dataToUse = <?php echo json_encode($chartData);?>;
	var wardName = [];
	var wardCount =[];
	for (var i = 0; i < dataToUse.length; i++) {
		wardName.push(dataToUse[i]['ward']);
		wardCount.push(dataToUse[i]['count']);				
	}
	var ctx1 = document.getElementById('chartNow');
			var lgaChart = new Chart(ctx1, {
			    type: 'horizontalBar',
			    data: {
			        labels: wardName,
			        datasets: [{
			            label: 'Capitation',
			            data: wardCount,
			            backgroundColor: [
			                'rgba(255, 99, 132, 0.2)',
			                'rgba(54, 162, 235, 0.2)',
			                'rgba(255, 206, 86, 0.2)',
			                'rgba(75, 192, 192, 0.2)',
			                'rgba(153, 102, 255, 0.2)',
			                'rgba(255, 159, 64, 0.2)',
			                'rgba(255, 99, 132, 0.2)',
			                'rgba(54, 162, 235, 0.2)',
			                'rgba(255, 206, 86, 0.2)',
			                'rgba(75, 192, 192, 0.2)',
			                'rgba(153, 102, 255, 0.2)',
			                'rgba(255, 159, 64, 0.2)'
			            ],
			            borderColor: [
			                'rgba(255, 99, 132, 1)',
			                'rgba(54, 162, 235, 1)',
			                'rgba(255, 206, 86, 1)',
			                'rgba(75, 192, 192, 1)',
			                'rgba(153, 102, 255, 1)',
			                'rgba(255, 159, 64, 1)',
			                'rgba(255, 99, 132, 1)',
			                'rgba(54, 162, 235, 1)',
			                'rgba(255, 206, 86, 1)',
			                'rgba(75, 192, 192, 1)',
			                'rgba(153, 102, 255, 1)',
			                'rgba(255, 159, 64, 1)'
			            ],
			            borderWidth: 1
			        }]
			    },
			    options: {
			        scales: {
			            yAxes: [{
			                ticks: {
			                    beginAtZero: true
			                }
			            }]
			        }			       
			    }
		});
});
</script>