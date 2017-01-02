<div class="container profile">
	<div class="span6">
		<form method="POST" action="index.php?controller=etudiant&amp;action=test&amp;option=null">
			<h3>Groupe n°<?php echo "$groupe->getidGroup()"; ?></h3>
			<fieldset>
				<?php foreach ($tab_answers as $values) { ?>
					<label for="<?php echo "$values[idr]"; ?>"><h4> <?php echo "$values[libelle]"; ?> </h4></label>
				<?php } ?>
				<input id="submit" class="btn btn-large" type="submit" value="Connexion" />
			</fieldset> 
		</form>
	</div>
</div>