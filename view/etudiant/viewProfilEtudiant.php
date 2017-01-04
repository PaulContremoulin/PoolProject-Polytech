<div class="container profile">
	<!--
	<div class="span3">
		<img src="img/mini.png" alt="">
	</div>
	-->
	<div class="span6">
		<?php if(empty($_SESSION['login'])){ //si l'utilisateur n'est pas encore connecté 
			require_once("viewConnexionEtudiant.php");
		}else{ ?>
			<h1>Bienvenue <?php print_r($_SESSION['nom']) ?> sur votre test de personnalité</h1>
			<canvas id="myChart" width="400" height="400"></canvas>

			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
			<script>
				<?php $labels = array_keys($tab_calculer); ?>
				var ctx = document.getElementById("myChart");
				var data = {
				    labels: ['<?php echo "$labels[0], $labels[1], $labels[2], $labels[3], $labels[4], $labels[5]"; ?>'],
				    datasets: [
				        {
				            label: "Votre personnalité",
				            backgroundColor: "rgba(179,181,198,0.2)",
				            borderColor: "rgba(179,181,198,1)",
				            pointBackgroundColor: "rgba(179,181,198,1)",
				            pointBorderColor: "#fff",
				            pointHoverBackgroundColor: "#fff",
				            pointHoverBorderColor: "rgba(179,181,198,1)",
				            data: [<?php echo '$tab_calculer[$labels[0]]' ?>, <?php echo '$tab_calculer[$labels[1]]' ?>, <?php echo '$tab_calculer[$labels[2]]' ?>, <?php echo '$tab_calculer[$labels[3]]' ?>, <?php echo '$tab_calculer[$labels[4]]' ?>, <?php echo '$tab_calculer[$labels[5]]' ?>] 
				        }/*,
				        {
				            label: "My Second dataset",
				            backgroundColor: "rgba(255,99,132,0.2)",
				            borderColor: "rgba(255,99,132,1)",
				            pointBackgroundColor: "rgba(255,99,132,1)",
				            pointBorderColor: "#fff",
				            pointHoverBackgroundColor: "#fff",
				            pointHoverBorderColor: "rgba(255,99,132,1)",
				            data: [28, 48, 40, 19, 96, 27, 100]
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

		<?php } ?>
	</div>
</div>