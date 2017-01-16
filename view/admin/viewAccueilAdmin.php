<div class="container profile">
		<div class="span6">
			<?php if(empty($_SESSION['login'])){ //si l'utilisateur n'est pas encore connecté 
				require_once("viewConnexionAdmin.php");
			}else{ ?>
				<h2>Bienvenue sur la plateforme du test de personnalité de Polytech Montpellier</h2></br>
				<h4>Résultats des différentes sections</h4></br>
				<div class="diagramme">
					<ul>
						<?php 
							require_once("viewProfilpromoAdmin.php");
						} ?>
					</ul>
				</div>

</div>




<!--

					<div class="accueil">
						<form method="POST" action="index.php?controller=admin&amp;action=promo">
							<input type="submit" class="btn btn-lg btn-dark" name="begin" value="Voir des résultats des élèves"/>
						</form>
						<form method="POST" action="index.php?controller=admin&amp;action=questionnaire">
							<input type="submit" class="btn btn-lg btn-dark" name="begin" value="Gerer le questionnaire"/>
						</form>
						<form method="POST" action="index.php?controller=admin&amp;action=admins">
							<input type="submit" class="btn btn-lg btn-dark" name="begin" value="Gerer les administrateurs"/>
						</form>
					</div>

	-->