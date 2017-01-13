<div class="container profile">
	<!--
	<div class="span3">
		<img src="img/mini.png" alt="">
	</div>
	-->
	<center>
	<div class="span6" id="mychart1">
		<?php if(empty($_SESSION['login'])){ //si l'utilisateur n'est pas encore connecté 
			require_once("viewConnexionAdmin.php");
		}else{ ?>
			
		<?php } ?>
		</div>
	</div>
	</center>
</div>