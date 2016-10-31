<?php

$ROOT = __DIR__; // __DIR__ est une constante qui contient le chemin du dossier courant
$DS = DIRECTORY_SEPARATOR;
$controller;

session_start(); //Session utilisateur
require_once ("{$ROOT}{$DS}config{$DS}session.php");

// On initialise le controlleur à appeler
if(!isset($_GET['controller'])){
	$controller="accueil";
}else{
	$controller = $_GET['controller'];
}

switch ($controller) {	
	case "accueil" :
		if(!isset($_GET['action'])){
			$_GET['action'] = "default";
		}
		require ("{$ROOT}{$DS}controller{$DS}controller".ucfirst($controller).".php"); //ucfirst met la premiere lettre de la chaine en MAJ
		break;
}

?>


