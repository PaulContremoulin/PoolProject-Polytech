<div class="container profile">
	<div class="span6">
		<form method="POST" action="index.php?controller=etudiant&amp;action=test&amp;option=null">
			<h3>Groupe n°<?php $groupe->getidGroup(); ?></h3>
			<fieldset>
				<?php foreach ($tab_answers as $values) { ?>
					<label for="echo <?php $values["idr"]; ?>"><h4> <?php $values["libelle"]; ?> </h4></label>
				<?php } ?>
				<input id="submit" class="btn btn-large" type="submit" value="Connexion" />
			</fieldset> 
		</form>
	</div>
</div>