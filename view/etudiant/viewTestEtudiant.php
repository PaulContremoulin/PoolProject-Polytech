<div class="container profile">
	<div class="span6">
		<form method="POST" action="index.php?controller=etudiant&amp;action=test&amp;option=null">
			<h3>Groupe n°<?php echo "$idGroupe"; ?> </h3>
				<table>
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
				</table>
				<input type="submit" class="btn btn-large" name="Precedent" value="Precedent" /><input type="submit" class="btn btn-large" name="Suivant" value="Suivant" />
		</form>
	</div>
</div>