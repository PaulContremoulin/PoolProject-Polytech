<?php
	if(!empty($_SESSION['nom'])){
		echo "<div class='titre'><h1>Bienvenue {$_SESSION['nom']} sur Pool Project</h1></div>";
	}else{
		echo '<div class="titre"><h1>Bienvenue sur Pool Project</h1></div>';
	}
?>
