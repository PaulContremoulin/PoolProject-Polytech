<?php

require_once("{$ROOT}{$DS}model{$DS}modelEtudiant.php");
require_once("{$ROOT}{$DS}model{$DS}modelSection.php");

$action = $_GET['action'];// recupère l'action passée dans l'URL

//require_once ("{$ROOT}{$DS}model{$DS}ModelQuelconque.php"); // chargement du modèle

switch ($action) {
	
    case "connexion":

        $login = $_POST["login"];
        $password = $_POST["password"];
        print_r($login);
        print_r($password);
        $cryptedPwd = Security::chiffrer($password);
        print_r($cryptedPwd);
        $checkAccount = ModelEtudiant::checkPassword($login,$cryptedPwd);
        print_r($checkAccount);
        if($checkAccount == true){

            $account = ModelEtudiant::select($login);

            $_SESSION['login']=$login;
            $_SESSION['nom'] = $account->getName();
            $_SESSION['admin'] = 0;
        }
        $controller="accueil";
        $_GET['action'] = "default";

        require ("{$ROOT}{$DS}controller{$DS}controller".ucfirst($controller).".php"); //ucfirst met la premiere lettre de la chaine en MAJ
        break;

    case "inscription":

        $sections = ModelSection::listeSections();
        $sectionsJS = htmlspecialchars(serialize($sections), ENT_QUOTES);
        $pagetitle = "Inscription";
        $view = "inscription";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break; 

    case "creation":

        $ineEtudiant = $_POST["ineEtudiant"];
        $pwdEtudiant = $_POST["pwdEtudiant"];
        $nameEtudiant = $_POST["nameEtudiant"];
        $prenomEtudiant = $_POST["prenomEtudiant"];
        $mailEtudiant = $_POST["mailEtudiant"];
        $confirmPwd = $_POST["confirmPwd"];
        $promoEtud = $_POST["promoEtud"];

        if(!modelEtudiant::mailExist($mailEtudiant)){
            if(modelEtudiant::isMailFormat($mailEtudiant)){
                if($pwdEtudiant == $confirmPwd){
                    $pwdEtudiant = Security::chiffrer($pwdEtudiant);

                    $new_account = array(
                         "id_etudiant" => $ineEtudiant,
                         "pwd_etud" => $pwdEtudiant,
                         "nom_etud" => $nameEtudiant,
                         "prenom_etud" =>  $prenomEtudiant,
                         "mail_etud" => $mailEtudiant,
                         "id_promo" => $promoEtud,
                    );

                    ModelEtudiant::insert($new_account);
                }
            }
        }

        //Redirection vers la page d'accueil
        $controller="accueil";
        $_GET['action'] = "default";

        require ("{$ROOT}{$DS}controller{$DS}controller".ucfirst($controller).".php"); //ucfirst met la premiere lettre de la chaine en MAJ
        break;

}
?>
