<div class="container profile">
	<!--
	<div class="span3">
		<img src="img/mini.png" alt="">
	</div>
	-->
	<div class="span6">
		<?php if(empty($_SESSION['login'])){ ?> <!-- si l'utilisateur n'est pas encore connecté -->
			<h1>Bienvenue !</h1>
			<h3>Connectez-vous pour acceder à votre profil !</h3>
				<form method="POST" action="index.php?controller=etudiant&amp;action=connexion">
	  				<fieldset>
						<label for="login"><h4>Votre e-mail : </h4></label>
						<input type="text" placeholder="prenom.nom@etu.umontpellier.fr" name="login" id="login" required/>
						<label for="password"><h4>Votre mot de passe : </h4></label>
						<input type="password" name="password" id="password"  required/> 
						<input id="submit" class="btn btn-large" type="submit" value="Connexion" />
					</fieldset> 
				</form>
			<p>
				<form  method="POST" action="index.php?controller=etudiant&amp;action=inscription">
					<h4>Pas encore inscrit ? ... 
						<input id="submit" class="btn btn-small" type="submit" value="Je m'inscris !" />
					</h4>
				</form>
			</p>

		<?php }else{ ?>
			<h1>Bienvenue <?php print_r($_SESSION['nom']) ?> sur votre test de personnalité</h1>
			<canvas id="myChart" width="400" height="400"></canvas>
		<?php } ?>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
	var ctx = document.getElementById("myChart");
	var data = {
	    labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
	    datasets: [
	        {
	            label: "My First dataset",
	            backgroundColor: "rgba(179,181,198,0.2)",
	            borderColor: "rgba(179,181,198,1)",
	            pointBackgroundColor: "rgba(179,181,198,1)",
	            pointBorderColor: "#fff",
	            pointHoverBackgroundColor: "#fff",
	            pointHoverBorderColor: "rgba(179,181,198,1)",
	            data: [65, 59, 90, 81, 56, 55, 40]
	        },
	        {
	            label: "My Second dataset",
	            backgroundColor: "rgba(255,99,132,0.2)",
	            borderColor: "rgba(255,99,132,1)",
	            pointBackgroundColor: "rgba(255,99,132,1)",
	            pointBorderColor: "#fff",
	            pointHoverBackgroundColor: "#fff",
	            pointHoverBorderColor: "rgba(255,99,132,1)",
	            data: [28, 48, 40, 19, 96, 27, 100]
	        }
	    ]
	};
	var myChart = new Chart(ctx, {
	    type: "radar",
	    data: data,
	    options: {
	            scale: {
	                reverse: true,
	                ticks: {
	                    beginAtZero: true
	                }
	            }
	    }
	});
</script>