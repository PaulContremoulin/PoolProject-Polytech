<?php

$ROOT = __DIR__; // __DIR__ est une constante qui contient le chemin du dossier courant
$DS = DIRECTORY_SEPARATOR;

session_start(); //Session utilisateur
require_once ("{$ROOT}{$DS}config{$DS}session.php");
require_once ("{$ROOT}{$DS}config{$DS}security.php");

// On initialise le controlleur à appeler
if(!isset($_GET['controller'])){
	$controller="Who";
}else{
	$controller = $_GET['controller'];
}

switch ($controller) {
	case "Who":
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
		if(!isset($_GET['action'])){
			$_GET['action'] = "profil";
		}
		require ("{$ROOT}{$DS}controller{$DS}controller".ucfirst($controller).".php"); //ucfirst met la premiere lettre de la chaine en MAJ
		break;

}

?>


