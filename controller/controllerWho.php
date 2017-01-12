<?php

	$action = $_GET['action'];
	switch ($action) {
		case "choix":
		       $pagetitle = "Type compte";
        	       $view = "AccueilAll";
        	       require ("{$ROOT}{$DS}view{$DS}view.php");
        	       break;
	}
?>
