<div class="container profile">
	<center>
		<div class="span6">
			<?php if(empty($_SESSION['login'])){ //si l'utilisateur n'est pas encore connecté 
				require_once("viewConnexionAdmin.php");
			}else{ ?>
				<h2>Bienvenue <?php print_r($_SESSION['nom']) ?> sur la plateforme du test de personnalité de Polytech Montpellier</h2></br>
				<h4>Que voulez vous faire ?</h4></br>
				<form method="POST" action="index.php?controller=admin&amp;action=resultats">
					<input type="submit" class="btn btn-lg btn-dark" name="begin" value="Voir les resultats"/>
				</form>
				<form method="POST" action="index.php?controller=admin&amp;action=question">
					<input type="submit" class="btn btn-lg btn-dark" name="begin" value="Gerer le questionnaire"/>
				</form>
				<form method="POST" action="index.php?controller=admin&amp;action=code">
					<input type="submit" class="btn btn-lg btn-dark" name="begin" value="Generer un code pour une promo"/>
				</form>
				<form method="POST" action="index.php?controller=admin&amp;action=code">
					<input type="submit" class="btn btn-lg btn-dark" name="begin" value="Gerer le adminitrateurs"/>
				</form>
			<?php } ?>
		</div>
	</center>

</div>