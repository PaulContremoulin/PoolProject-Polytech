<div class="container profile">
	<div class="span6" id="divquest">
		<form method="POST" action="index.php?controller=etudiant&amp;action=test&amp;option=null">
			<h3>Groupe n°<?php echo "$idGroupe"; ?></h3><h4 class="erreur"><?php echo "$msgError"; ?></h4>
			<input type="hidden"  name="idGroupe"  value="<?php echo "$idGroupe"; ?>">
				<table id="tablequest">
					<tr>
						<th></th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
					</tr>
				<?php foreach ($tab_answers as $values) { ?>

					<tr>
						<td><?php echo "$values[libelle]"; ?></td>
						<td><INPUT type= "radio" name="choix1" value="<?php echo "$values[idp]"; ?>"></td>
						<td><INPUT type= "radio" name="choix2" value="<?php echo "$values[idp]"; ?>"></td>
						<td><INPUT type= "radio" name="choix3" value="<?php echo "$values[idp]"; ?>"></td>
					</tr>
				<?php } ?>
				</table></br>
				<input type="submit" class="btn btn-lg btn-dark" name="Precedent" value="Precedent" <?php if($idGroupe == 1){ echo "disabled";} ?>/><?php if($idGroupe != 12){ ?><input type="submit" class="btn btn-lg btn-dark" name="Suivant" value="Suivant" > <?php } else { ?> <input type="submit" class="btn btn-lg btn-dark" name="Terminer" value="Terminer" action="index.php?controller=etudiant&action=profil;"/> <?php } ?>
		</form>
	</div>
</div>

