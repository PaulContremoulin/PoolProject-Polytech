<div class="container profile">
	<div class="span6">
		<form method="POST" action="index.php?controller=etudiant&amp;action=test&amp;option=null">
			<h3>Groupe n°<?php echo "$idGroupe"; ?> </h3>
			<fieldset>
				<?php foreach ($tab_answers as $values) { ?>
					<p><?php echo "$values[libelle]"; ?><INPUT type= "radio" name="choix1" value="<?php echo "$values[idp]"; ?>"> 1er choix <INPUT type= "radio" name="choix2" value="<?php echo "$values[idp]"; ?>"> 2eme choix <INPUT type= "radio" name="choix3" value="<?php echo "$values[idp]"; ?>"> 3eme choix </p>
				<?php } ?>
				<input type="submit" class="btn btn-large" name="Precedent" value="Precedent" /><input type="submit" class="btn btn-large" name="Suivant" value="Suivant" />
			</fieldset> 
		</form>
	</div>
</div>