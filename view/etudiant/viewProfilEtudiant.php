<div class="container profile">
	<!--
	<div class="span3">
		<img src="img/mini.png" alt="">
	</div>
	-->
	<center>
	<div class="span6">
			<h2>Votre test de personnalité à donné le résultat suivant</h2>		
			<canvas id="myChart" width="60%" height="30%" ></canvas>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
			<script>
				var var_labels = <?php echo json_encode($labels); ?>;
				var var_profil = <?php echo json_encode($profil, JSON_NUMERIC_CHECK); ?>;
				//var var_profil_promo = <?php //echo json_encode($profil_promo, JSON_NUMERIC_CHECK); ?>;
				var ctx = document.getElementById("myChart");
				var data = {
				    labels: var_labels,
				    datasets: [
				        {
				            label: "Ma personnalité",
				            backgroundColor: "rgba(0,0,255,0.8)",
				            borderColor: "rgba(0,0,255,1)",
				            pointBackgroundColor: "rgba(0,0,0,1)",
				            pointBorderColor: "#fff",
				            pointHoverBackgroundColor: "#fff",
				            pointHoverBorderColor: "rgba(179,181,198,1)",
				            data: var_profil
				        }
				       /* {
				            label: "Personnalité de ma promo",
				            backgroundColor: "rgba(255,99,132,0.2)",
				            borderColor: "rgba(255,99,132,1)",
				            pointBackgroundColor: "rgba(255,99,132,1)",
				            pointBorderColor: "#fff",
				            pointHoverBackgroundColor: "#fff",
				            pointHoverBorderColor: "rgba(255,99,132,1)",
				            data: var_profil_promo
				        }*/
				    ]
				};
				var myChart = new Chart(ctx, {
				    type: "radar",
				    data: data,
				    
				    options: {
				            scale: {
				                ticks: {
				                    beginAtZero: true
				                }
				            }
				    }
				});
			</script>
	</div>
	</center>
</div>