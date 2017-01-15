<div class="container profile">
	<div class="span3">
	</div>
	<div class="span6" id="insc">
		<h1>Générateur</h1>
	<?php if(isset($code_aleatoire)){ ?>
		<h3>Voici le code généré</h3></br>
		<h4> Si vous l'oubliez il est accessible dans l'onglet Gestion Promo</h4>
		<h2><?php echo $code_aleatoire ?><h2></br>
		<form method="POST" action="index.php?controller=admin&amp;action=code">
		<input id="submit" class="btn btn-dark btn-lg" type="submit" value="Générer un autre code !" />
		</form>
	<?php }else{ ?>
		<h3>Veuillez choisir la section puis l'année</h3>
		<form method="POST" action="index.php?controller=admin&amp;action=code">
			<fieldset>
		    	<label for="section"><h4> Section  </h4></label></br>
		    	<select name="section" id="section" onchange="changePromo(tab, this.value);" required>
		    		<option value=""> --- Choisissez la section --- </option>
		    		<?php
		    		//$nbr = count($sections);
		    		foreach ($sections as $id_section => $values) {
		    		?>
		    		<option value="<?php echo($id_section); ?>"><?php echo($values[0]); ?></option>
		    		<?php
		    		}
		    		?>
		    	</select>
		    	</br></br><span id="idListePromo"></span></br><br />
		    	<input id="submit" class="btn btn-dark btn-lg" type="submit" value="Générer !" />
			</fieldset> 
		</form>
		<?php } ?>
	</div>
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
	    if(ids != "")
	    {
	    /* On compte les départements de cette région */
	    var nbp = tab[ids][1].length;

	    var form_p  = '<label for="section"><h4> Année : </h4></label>';
	    form_p += '<select name="promoEtudiant" id="promoEtudiant" required>';
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

