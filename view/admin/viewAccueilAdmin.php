<div class="container profile">
		<div class="span6">
			<?php if(empty($_SESSION['login'])){ //si l'utilisateur n'est pas encore connecté 
				require_once("viewConnexionAdmin.php");
			}else{ ?>
				<h2>Bienvenue sur la plateforme du test de personnalité de Polytech Montpellier</h2></br>
				<h4>Que voulez vous faire ?</h4></br>
				<form method="POST" action="index.php?controller=admin&amp;action=promo">
					<input type="submit" class="btn btn-lg btn-dark" name="begin" value="Gerer les Promos/Departement"/>
				</form>
				<form method="POST" action="index.php?controller=admin&amp;action=question">
					<input type="submit" class="btn btn-lg btn-dark" name="begin" value="Gerer le questionnaire"/>
				</form>
				<form method="POST" action="index.php?controller=admin&amp;action=admins">
					<input type="submit" class="btn btn-lg btn-dark" name="begin" value="Gerer les administrateurs"/>
				</form>
			<?php } ?>
		</div>

</div>