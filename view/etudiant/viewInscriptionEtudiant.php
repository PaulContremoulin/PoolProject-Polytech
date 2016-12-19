<div class="container profile">
	<div class="span3">
		<img src="img/mini.png" alt="">
	</div>
	<div class="span6">
		<h1>Inscription</h1>
		<h3>Veuillez remplir le formulaire d'inscription</h3>

		<form method="POST" action="index.php?controller=etudiant&amp;action=creation">
			<fieldset>
		  		<label for="ineEtudiant"><h4> INE : </h4></label>
		    	<input type="text" placeholder="prenom.nom@etu.umontpellier.fr" name="mailUser" id="mailUser" required/>
		    	<label for="mailEtudiant"><h4> E-mail : </h4></label>
		    	<input type="text" placeholder="prenom.nom@etu.umontpellier.fr" name="mailEtudiant" id="mailEtudiant" required/>
		    	<label for="nameEtudiant"><h4> Nom : </h4></label>
		    	<input type="text" placeholder="Dupont" name="nameEtudiant" id="nameEtudiant"  required/>
		    	<label for="prenomEtudiant"><h4> Prenom : </h4></label>
		    	<input type="text" placeholder="Dupont" name="prenomEtudiant" id="prenomEtudiant"  required/>
		    	<label for="pwdEtudiant"><h4> Mot de passe : </h4></label>
		    	<input type="password" name="pwdEtudiant" id="pwdEtudiant" required/>
				<label for="confirmPwd"><h4> Confirmez le mot de passe : </h4></label>
		    	<input type="password" name="confirmPwd" id="confirmPwd"  required/>
		    	<label for="section"><h4> Section : </h4></label>
		    	<select name="section" id="section"> <!-- onchange="changePromo(tab, this.value);" -->
		    		<?php
		    		//$nbr = count($sections);
		    		foreach ($sections as $id_section => $values) {
		    		?>
		    		<option value="<?php echo($values[0][0]); ?>"><?php echo($values[0][1]); ?></option>
		    		<?php
		    		}
		    		?>
		    	</select>
		    	<input id="submit" class="btn btn-large" type="submit" value="Je m'inscris" />
			</fieldset> 
		</form>
	</div>
</div>

