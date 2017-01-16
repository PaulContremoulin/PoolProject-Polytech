<div class="container profile">
	<!--
	<div class="span3">
		<img src="img/mini.png" alt="">
	</div>
	-->
	<div class="span6">

			<div id= gauche>	
				<canvas id="myChart" width="100%" height="100%" ></canvas>
				<?php
					if(isset($_POST['envoiMail'])){
						require_once("viewResultatmailEtudiant.php");
					}
				?>
				<form method="POST" action="index.php?controller=etudiant&amp;action=profil">
					<input type="submit" class="btn btn-dark btn-lg" id="envoiMail" name="envoiMail" 
						value=
							<?php if(isset($_POST['envoiMail'])){ 
								echo "\"Résultats envoyés\" disabled"; 
							}else{ 
								echo "\"Envoyer mes résultats par mail\"";
							}?>
					>
				</form> 
				<input type="button" class="button_active" onclick="location.href='../attributs.pdf';" target="_blank" />
				<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
				<script>
					var var_labels = <?php echo json_encode($labels); ?>;
					var var_profil = <?php echo json_encode($profil, JSON_NUMERIC_CHECK); ?>;
					var var_profil_promo = <?php echo json_encode($profil_promo, JSON_NUMERIC_CHECK); ?>;
					var ctx = document.getElementById("myChart");
					var data = {
					    labels: var_labels,
					    datasets: [
					        {
					            label: "Ma personnalité",
					            backgroundColor: "rgba(0,0,0,0.4)",
					            borderColor: "rgba(0,0,0,1)",
					            pointBackgroundColor: "rgba(0,0,0,1)",
					            pointBorderColor: "rgba(0,0,0,0)",
					            pointHoverBackgroundColor: "#fff",
					            pointHoverBorderColor: "rgba(0,0,0,1)",
					            data: var_profil
					        },
					       	{
					            label: "Personnalité de ma promo",
					            backgroundColor: "rgba(255,99,132,0.2)",
					            borderColor: "rgba(255,99,132,1)",
					            pointBackgroundColor: "rgba(255,99,132,1)",
					            pointBorderColor: "#fff",
					            pointHoverBackgroundColor: "#fff",
					            pointHoverBorderColor: "rgba(255,99,132,1)",
					            data: var_profil_promo
					        }
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
			<div id=droite>
				<div id=premier>
					<center>
					<h4> Votre premier trait de personnalité :<br/> <?php echo $profil1->get_libelle();?> </h4>
					</center>
					<p> <?php echo $profil1->get_description();?> </p>
				</div>
				<div id=deuxieme>
					<center>
					<h4>  Votre deuxième trait de personnalité :<br/> <?php echo $profil2->get_libelle();?> </h4>
					</center>
					<p> <?php echo $profil2->get_description();?> </p>
				</div>
				<div id=troisieme>
					<center>
					<h4> Votre troisième trait de personnalité :<br/> <?php echo $profil3->get_libelle();?> </h4>
					</center>
					<p> <?php echo $profil3->get_description();?> </p>
				</div>
			</div>
	</div>

</div>
