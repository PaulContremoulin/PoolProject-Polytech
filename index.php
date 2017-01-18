<?php
//Variables pour portage de l'application
$ROOT = __DIR__; // __DIR__ est une constante qui contient le chemin du dossier courant
$DS = DIRECTORY_SEPARATOR;

session_start(); //Session utilisateur
require_once ("{$ROOT}{$DS}config{$DS}session.php");
require_once ("{$ROOT}{$DS}config{$DS}security.php");

// On initialise le controlleur à appeler
if(!isset($_GET['controller'])){
	if(isset($_SESSION['login'])){
		if($_SESSION['admin'] == 0){
			$controller="etudiant";
		}
		else{
			$controller="admin";
		}
	}else{
		$controller="who";
	}
}else{
	$controller = $_GET['controller'];
}

switch ($controller) {
	case "who":
		if(!isset($_GET['action'])){
			$_GET['action'] = "choix";
		}
		require ("{$ROOT}{$DS}controller{$DS}controller".ucfirst($controller).".php"); //ucfirst met la premiere lettre de la chaine en MAJ
		break;
	case "etudiant" :
		if(!isset($_GET['action'])){
			$_GET['action'] = "profil";
		}
		require ("{$ROOT}{$DS}controller{$DS}controller".ucfirst($controller).".php"); //ucfirst met la premiere lettre de la chaine en MAJ
		break;
	case "admin":
		if (isset($_SESSION["admin"]) and $_SESSION["admin"]==1){
			if(!isset($_GET['action'])){

				$_GET['action'] = "profil";
			}
				
		}
		else{
			$_GET['action'] = "connexion";
		}

		require ("{$ROOT}{$DS}controller{$DS}controller".ucfirst($controller).".php"); //ucfirst met la premiere lettre de la chaine en MAJ
		break;

}

?>


