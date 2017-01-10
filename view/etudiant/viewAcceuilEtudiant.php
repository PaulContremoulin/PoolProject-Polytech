<div class="container_profile">
	<center>
		<div class="span6">
			<?php if(empty($_SESSION['login'])){ //si l'utilisateur n'est pas encore connecté 
				require_once("viewConnexionEtudiant.php");
			}else{ ?>
				<h2>Bienvenue <?php print_r($_SESSION['nom']) ?> sur votre test de personnalité</h2></br>
				<h4>Le test RIASEC vise à déterminer chez un individu quels sont les traits de caractères prédominants. Vous devez choisir 3 réponses pour chaque propositions par ordre de choix.</h4></br>
				<h4>Investigatif? Réaliste? Conventionnel? Entrepreneur? Artistique? Social? Quels sont donc vos caractères prédominants ? </h4></br>
				<form method="POST" action="index.php?controller=etudiant&amp;action=test">
					<input type="submit" class="btn btn-lg btn-dark" name="Commencer le test" value="begin"/>
				</form>
		</div>
	</center>

</div>