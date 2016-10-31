<?php

$action = $_GET['action'];// recupère l'action passée dans l'URL

//require_once ("{$ROOT}{$DS}model{$DS}ModelQuelconque.php"); // chargement du modèle

switch ($action) {
	
    case "default":
        $pagetitle = "Accueil";
        $view = "default";

        /* A garder pour la gestion des etudiants / admins / pas inscrits
        if(Session::is_admin()){

        }else if(Session::is_user()){

        }else{

        }
        */
        
        require ("{$ROOT}{$DS}view{$DS}view.php");//"redirige" vers la vue
        break;

}
?>
