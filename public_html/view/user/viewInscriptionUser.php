<div class="container profile">
	<div class="span3">
		<img src="img/mini.png" alt="">
	</div>
	<div class="span6">
		<h1>Inscription</h1>
		<h3>Veuillez remplir le formulaire d'inscription</h3>

		<form method="POST" action="index.php?controller=user&amp;action=creation">
		  <fieldset>
		     <label for="mailUser"><h4> E-mail: </h4></label>
		     <input type="text" placeholder="prenom.nom@etu.umontpellier.fr" name="mailUser" id="mailUser" required/>
		     <label for="nameUser"><h4> Nom : </h4></label>
		     <input type="text" placeholder="Dupont" name="nameUser" id="nameUser"  required/>
		     <label for="pwdUser"><h4> Mot de passe : </h4></label>
		     <input type="password" name="pwdUser" id="pwdUser"  required/>
			 <label for="confirmPwd"><h4> Confirmez le mot de passe : </h4></label>
		     <input type="password" name="confirmPwd" id="confirmPwd"  required/>
		     <input id="submit" class="btn btn-large" type="submit" value="Je m'inscris" />
		   </fieldset> 
		</form>
	</div>
</div>

