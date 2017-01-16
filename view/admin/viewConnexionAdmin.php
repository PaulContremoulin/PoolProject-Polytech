<h1>TEST RIASEC </h1>
<h3>Connectez-vous </h3>
	<form method="POST" action="index.php?controller=admin&amp;action=connexion">
			<fieldset>
			<label for="login"><h4>Votre e-mail </h4></label></br>
			<input type="text" placeholder="identifiant@domain.fr"  title="The form of your email must be prenom.nom@etu.umontpellier.fr ." name="login" id="login" required/></br></br>
			<label for="password"><h4>Votre mot de passe </h4></label></br>
			<input type="password" name="password"  pattern="[0-9a-zA-Z]{6,}" title="Your password must have at least 6 characters except special characters(; , - ...)" id="password"  required/> </br></br>
			<input id="submit" class="btn btn-dark btn-large" type="submit" value="Connexion" /></br></br>
		</fieldset> 
	</form>

	<p>
		<form  method="POST" action="index.php">
			<h4>
				<input id="submit" class="btn btn-dark btn-small" type="submit" value="Retour à la page d'accueil" />
			</h4>
		</form>
	</p>