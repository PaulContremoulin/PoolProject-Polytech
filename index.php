<?php

//php.ini
ini_set('allow_url_include', true); //Permet la récupération des URL

//Variables pour portage de l'application
$ROOT = __DIR__; // __DIR__ est une constante qui contient le chemin du dossier courant
$DS = DIRECTORY_SEPARATOR;

session_start(); //Session utilisateur
require_once ("{$ROOT}{$DS}config{$DS}session.php");
require_once ("{$ROOT}{$DS}config{$DS}security.php");

// On initialise le controlleur à appeler
if(!isset($_GET['controller'])){
	$controller="who";
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
		if(!isset($_GET['action'])){
			$_GET['action'] = "profil";
		}
		require ("{$ROOT}{$DS}controller{$DS}controller".ucfirst($controller).".php"); //ucfirst met la premiere lettre de la chaine en MAJ
		break;

}

?>


