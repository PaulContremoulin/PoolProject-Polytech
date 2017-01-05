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
		    	<input type="text" placeholder="1234567890A" name="ineEtudiant" pattern="^[0-9]{10}[a-z]$" title="Please enter your real INE (10 numbers and a letter)." id="ineEtudiant"  required/>
		    	<label for="mailEtudiant"><h4> E-mail : </h4></label>
		    	<input type="text" placeholder="prenom.nom@etu.umontpellier.fr" name="mailEtudiant" pattern="[a-z-]+[.][a-z-]+@etu.umontpellier.fr$" title="The form of your email must be prenom.nom@etu.umontpellier.fr ." id="mailEtudiant" required/>
		    	<label for="nameEtudiant"><h4> Nom : </h4></label>
		    	<input type="text" placeholder="Dupont" name="nameEtudiant" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+" id="nameEtudiant"  required/>
		    	<label for="prenomEtudiant"><h4> Prenom : </h4></label>
		    	<input type="text" placeholder="Dupont" name="prenomEtudiant" pattern="[a-zA-ZàâæçéèêëîïôœùûüÿÀÂÆÇnÉÈÊËÎÏÔŒÙÛÜŸ-]+" id="prenomEtudiant"  required/>
		    	<label for="pwdEtudiant"><h4> Mot de passe : </h4></label>
		    	<input type="password" name="pwdEtudiant" pattern="[0-9a-zA-Z]{6,}" title="Your password must have at least 6 characters except special characters(; , - ...)" id="pwdEtudiant" required/>
				<label for="confirmPwd"><h4> Confirmez le mot de passe : </h4></label>
		    	<input type="password" name="confirmPwd" pattern="[0-9a-zA-Z.]{6,}" title="Your password must have at least 6 characters except special characters(; , - ...)" id="confirmPwd"  required/>
		    	<label for="section"><h4> Section : </h4></label>
		    	<select name="section" id="section" onchange="changePromo(tab, this.value);" required>
		    		<option value="vide"> --- Choisissez votre section --- </option>
		    		<?php
		    		//$nbr = count($sections);
		    		foreach ($sections as $id_section => $values) {
		    		?>
		    		<option value="<?php echo($id_section); ?>"><?php echo($values[0]); ?></option>
		    		<?php
		    		}
		    		?>
		    	</select>
		    	<span id="idListePromo"></span><br />
		    	<input id="submit" class="btn btn-large" type="submit" value="Je m'inscris" />
			</fieldset> 
		</form>
	</div>
</div>

<script type="text/javascript" src="js/arrayPHP2JS.js" charset="iso_8859-1"></script>
<script type="text/javascript">
	var tableau = new PhpArray2Js('<?php echo $sectionsJS; ?>');
	var tab = tableau.retour();
</script>
<script type="text/javascript">
	function changePromo(tab,ids)
	{
	    if(ids != "vide")
	    {
	    /* On compte les départements de cette région */
	    var nbp = tab[ids][1].length;

	    var form_p  = '<label for="section"><h4> Année : </h4></label>';
	    form_p += '<select name="promoEtudiant" id="promoEtudiant">';
	    for(var j = 0;  j < nbp; j++)
	    {
	        form_p += '  <option value="'+ tab[ids][1][j] +'">'+ tab[ids][2][j] +'<\/option>';
	    }
	    form_p += '<\/select>';
	    }
	    else
	    {
	        form_p = "";
	    }
	    document.getElementById("idListePromo").innerHTML = form_p;
	}
</script>

