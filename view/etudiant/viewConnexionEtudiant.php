<h1>Bienvenue !</h1>
<h3>Connectez-vous pour acceder à votre profil !</h3>
	<form method="POST" action="index.php?controller=etudiant&amp;action=connexion">
			<fieldset>
			<label for="login"><h4>Votre e-mail : </h4></label>
			<input type="text" placeholder="prenom.nom@etu.umontpellier.fr" pattern="[a-z-]+[.][a-z-]+@etu.umontpellier.fr$" title="The form of your email must be prenom.nom@etu.umontpellier.fr ." name="login" id="login" required/>
			<label for="password"><h4>Votre mot de passe : </h4></label>
			<input type="password" name="password"  pattern="[0-9a-zA-Z]{6,}" title="Your password must have at least 6 characters except special characters(; , - ...)" id="password"  required/> 
			<input id="submit" class="btn btn-large" type="submit" value="Connexion" />
		</fieldset> 
	</form>
<p>
	<form  method="POST" action="index.php?controller=etudiant&amp;action=inscription">
		<h4>Pas encore inscrit ? ... 
			<input id="submit" class="btn btn-small" type="submit" value="Je m'inscris !" />
		</h4>
	</form>
</p>