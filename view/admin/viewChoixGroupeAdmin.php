<div class="container profile">
		<div class="span6">
			<?php if(empty($_SESSION['login'])){ //si l'utilisateur n'est pas encore connecté 
				require_once("viewConnexionAdmin.php");
			}else{ ?>
				<h2>Quel Groupe de questions souhaitez-vous modifiez ? </h2></br>
				
				<form method="POST" action="index.php?controller=admin&amp;action=modif_g1">
					<input type="submit" class="btn btn-lg btn-dark" name="g1" value="Groupe 1 "/>
				</form><form method="POST" action="index.php?controller=admin&amp;action=modif_g2">
					<input type="submit" class="btn btn-lg btn-dark" name="g2" value="Groupe 2 "/>
				</form></br>
				<form method="POST" action="index.php?controller=admin&amp;action=modif_g3">
					<input type="submit" class="btn btn-lg btn-dark" name="g3" value="Groupe 3 "/>
				</form></br>
				<form method="POST" action="index.php?controller=admin&amp;action=modif_g4">
					<input type="submit" class="btn btn-lg btn-dark" name="g4" value="Groupe 4 "/>
				</form></br>
				<form method="POST" action="index.php?controller=admin&amp;action=modif_g5">
					<input type="submit" class="btn btn-lg btn-dark" name="g5" value="Groupe 5 "/>
				</form></br>
				<form method="POST" action="index.php?controller=admin&amp;action=modif_g6">
					<input type="submit" class="btn btn-lg btn-dark" name="g6" value="Groupe 6 "/>
				</form></br>
				<form method="POST" action="index.php?controller=admin&amp;action=modif_g7">
					<input type="submit" class="btn btn-lg btn-dark" name="g7" value="Groupe 7 "/>
				</form></br>
				<form method="POST" action="index.php?controller=admin&amp;action=modif_g8">
					<input type="submit" class="btn btn-lg btn-dark" name="g8" value="Groupe 8 "/>
				</form></br>
				<form method="POST" action="index.php?controller=admin&amp;action=modif_g9">
					<input type="submit" class="btn btn-lg btn-dark" name="g9" value="Groupe 9 "/>
				</form></br>
				<form method="POST" action="index.php?controller=admin&amp;action=modif_g10">
					<input type="submit" class="btn btn-lg btn-dark" name="g10" value="Groupe 10 "/>
				</form></br>
				<form method="POST" action="index.php?controller=admin&amp;action=modif_g11">
					<input type="submit" class="btn btn-lg btn-dark" name="g11" value="Groupe 11"/>
				</form></br>
				<form method="POST" action="index.php?controller=admin&amp;action=modif_g2">
					<input type="submit" class="btn btn-lg btn-dark" name="g12" value="Groupe 12"/>
				</form></br>
			<?php } ?>
		</div>

</div>