

<ul>
	<?php
		foreach ($tab_grps as $key => $value) {
		echo '<li><button onclick="changerGroupe('.$key.');">'.$key.'</button></li>';
		}
	?>
</ul>
<div id="formReponse"></div>

<script type="text/javascript">
	var tab_grps = <?php echo json_encode($tab_grps); ?>;
	
	function changerGroupe(val){
		var tab_reps = tab_grps[val];

		var form = '<form method="POST" action="index.php?controller=admin&amp;action=updateQuestionnaire">';
		for(var i = 0; i < tab_reps.length; i++){
			num_rep = i+1;
			form += '<label>'+num_rep+'</label><input name="'+tab_reps[i]["idr"]+'" type="text" value="'+tab_reps[i]["txt"]+'" />';
		}
		form += '<input id="submit" class="btn btn-dark btn-lg" type="submit" value="Mettre à jour" />';
		form += '</form>';
		document.getElementById("formReponse").innerHTML = form;
	}
	changerGroupe(1);

</script>