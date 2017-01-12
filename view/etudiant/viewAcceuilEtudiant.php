<div class="container profile">
	<center>
		<div class="span6">
			<?php if(empty($_SESSION['login'])){ //si l'utilisateur n'est pas encore connecté 
				require_once("viewConnexionEtudiant.php");
			}else{ ?>
				<h2>Bienvenue <?php print_r($_SESSION['nom']) ?> sur votre test de personnalité</h2></br>
				<h4>Le test RIASEC vise à déterminer chez un individu quels sont les traits de caractères prédominants.</h4></br>

				<?php if($nbQuestionsSave == 12){ // L'étudiant à terminé son test

					require_once("viewProfilEtudiant.php");

				}elseif($nbQuestionsSave >= 1){ //l'étudiant à commencé son test mais ne l'a pas fini ?> 

					<h4>Investigatif ? Réaliste ? Conventionnel ? Entrepreneur ? Artistique ? Social ? Quels sont donc vos caractères prédominants ? </h4></br>
					<h4>Pour déterminer votre personnalité, veuillez terminer le test. Il vous reste <?php echo 12-$nbQuestionsSave; ?>/12 réponses à completer. </h4></br>
					<!--<h4>Si vous voulez voir votre précédent résultat cliquez sur l'onglet "Votre profil" dans le carré de navigation</h4></br>-->
					<form method="POST" action="index.php?controller=etudiant&amp;action=test">
						<input type="submit" class="btn btn-lg btn-dark" name="begin" value="Continuer le test"/>
					</form>

				<?php }else{// l'étudiant n'a pas commencé le test.?>

					<h4>Investigatif ? Réaliste ? Conventionnel ? Entrepreneur ? Artistique ? Social ? Quels sont donc vos caractères prédominants ? </h4></br>
					<h4>Pour déterminer votre personnalité, veuillez commencer le test. Vous devez choisir 3 réponses pour chaque propositions par ordre de choix.</h4></br>
					<!--<h4>Si vous voulez voir votre précédent résultat cliquez sur l'onglet "Votre profil" dans le carré de navigation</h4></br>-->
					<form method="POST" action="index.php?controller=etudiant&amp;action=test">
						<input type="submit" class="btn btn-lg btn-dark" name="begin" value="Commencer le test"/>
					</form>
				<?php
				}
			} ?>
		</div>
	</center>

</div>