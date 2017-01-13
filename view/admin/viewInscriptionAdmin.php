<div class="container profile">
	<div class="span3">
	</div>
	<div class="span6" id="insc">
		<h1>Inscription</h1>
		<h3>Veuillez remplir le formulaire d'inscription</h3>

		
		<form method="POST" action="index.php?controller=admin&amp;action=creation">
			<fieldset>
		    	<label for="mailAdmin"><h4> E-mail </h4></label></br>
		    	<input type="text" placeholder="prenom.nom@etu.umontpellier.fr" name="mailAdmin" title="Verifiez que l'e-mail est correct" id="mailAdmin" required/></br></br>
		    	<label for="nameAdmin"><h4> Nom  </h4></label></br>
		    	<input type="text" placeholder="Dupont" name="nameAdmin" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+" id="nameAdmin"  required/></br></br>
		    	<label for="prenomAdmin"><h4> Prenom </h4></label></br>
		    	<input type="text" placeholder="Dupont" name="prenomAdmin" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+" id="prenomAdmin"  required/></br></br>
		    	<label for="pwdAdmin"><h4> Mot de passe  </h4></label></br>
		    	<input type="password" name="pwdAdmin" pattern="[0-9a-zA-Z]{6,}" title="Your password must have at least 6 characters except special characters(; , - ...)" id="pwdAdmin" required/></br></br>
				<label for="confirmPwd"><h4> Confirmez le mot de passe  </h4></label></br>
		    	<input type="password" name="confirmPwd" pattern="[0-9a-zA-Z.]{6,}" title="Your password must have at least 6 characters except special characters(; , - ...)" id="confirmPwd"  required/></br>
		    	<input id="submit" class="btn btn-dark btn-lg" type="submit" value="Enregistrer" />
			</fieldset> 
		</form>
	</div>
	</div>
</div>

<script type="text/javascript" src="js/arrayPHP2JS.js" charset="iso_8859-1"></script>
<script type="text/javascript">
	var tableau = new PhpArray2Js('<?php echo $sectionsJS; ?>');
	var tab = tableau.retour();
</script>
