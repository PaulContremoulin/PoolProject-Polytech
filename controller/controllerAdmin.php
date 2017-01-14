<?php

require_once("{$ROOT}{$DS}model{$DS}modelEtudiant.php");
require_once("{$ROOT}{$DS}model{$DS}modelSection.php");
require_once("{$ROOT}{$DS}model{$DS}modelAdmin.php");
require_once("{$ROOT}{$DS}model{$DS}modelPromo.php");

$action = $_GET['action'];// recupère l'action passée dans l'URL

//require_once ("{$ROOT}{$DS}model{$DS}ModelQuelconque.php"); // chargement du modèle

switch ($action) {

    
    case "profil":

        if(isset($_SESSION['login'])){

            
        }

        $pagetitle = "Mon profil";
        $view = "profilpromo";

        /* A garder pour la gestion des etudiants / admins / pas inscrits
        if(Session::is_admin()){

        }else if(Session::is_user()){

        }else{

        }
        */
        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;

    case "connexion":
        $login = ModelAdmin::getID($_POST["login"]); //On récupère l'ine associé à l'e-mail
        $password = $_POST["password"];
        $cryptedPwd = Security::chiffrer($password);
        $checkAccount = ModelAdmin::checkPassword($login,$cryptedPwd);
        if($checkAccount){
            $account = ModelAdmin::select($login);

            $_SESSION['login']=$login;
            $_SESSION['admin'] = 1;
        }

        $pagetitle = "Accueil";
        $view = "accueil";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;


    case "deconnexion":

        unset($_SESSION['login']);
        unset($_SESSION['nom']);
        unset($_SESSION['admin']);
        unset($_SESSION['idGroupe']);

        $pagetitle = "Votre profil";
        $view = "profilpromo";
        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;


    case "inscription":

        $pagetitle = "Inscription";
        $view = "inscription";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break; 

    case "creation":
        $pwdAdmin = $_POST["pwdAdmin"];
        $nameAdmin = $_POST["nameAdmin"];
        $prenomAdmin = $_POST["prenomAdmin"];
        $mailAdmin = $_POST["mailAdmin"];
        $confirmPwd = $_POST["confirmPwd"];

        if(!ModelAdmin::mailExist($mailAdmin)){
            if(ModelAdmin::isMailFormat($mailAdmin)){
                if($pwdAdmin == $confirmPwd){
                    $pwdAdmin = Security::chiffrer($pwdAdmin);

                    $new_account = array(
                        "id_admin" => $id_admin,
                        "nom_admin" => $nameAdmin,
                        "prenom_admin" => $prenomAdmin,
                        "mail_admin" => $mailAdmin,
                         "mdp_admin" => $pwdAdmin,
            
                    );

                    ModelAdmin::insert($new_account);
                }
            }
        }
        $listeAdmin = ModelAdmin::getAdmins();
        $pagetitle = "Liste des admins";
        $view = "liste";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;


    case "admins":

        if(isset($_SESSION['login']) && $_SESSION['admin']==1){
            $listeAdmin = ModelAdmin::getAdmins();
            $pagetitle = "Liste des admins";
            $view = "liste";
        }
        
        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;


case "modif":
    $pwdAdmin = $_POST["mdp"];
    $nameAdmin = $_POST["nom"];
    $prenomAdmin = $_POST["prenom"];
    $mailAdmin = $_POST["email2"];
    $confirmPwd = $_POST["confirmPwd"];

    if(isset($_SESSION['login']) && $_SESSION['admin']==1){
        if(ModelAdmin::isMailFormat($mailAdmin)){
            if($pwdAdmin == $confirmPwd){
                $pwdAdmin = Security::chiffrer($pwdAdmin);

                $new_account = array(
                     "mdp_admin" => $pwdAdmin,
                     "nom_admin" => $nameAdmin,
                     "prenom_admin" => $prenomAdmin,
                     "mail_admin" => $mailAdmin,
                );

                    ModelAdmin::insert($new_account);
                }
            }
        $listeAdmin = ModelAdmin::getAdmins();
        $pagetitle = "Liste des admins";
        $view = "liste";
    }
    require ("{$ROOT}{$DS}view{$DS}view.php");
    break;


case "questionnaire":
    $pagetitle = "Liste des admins";
    $view = "choixgroupe";

    require ("{$ROOT}{$DS}view{$DS}view.php");
    break;
    

/*
case "promo":
    print("a faire en 1ere position");

case "departement":
    print("a faire en 2e positions");

*/ 

 case "code":
    $sections = ModelSection::listeSections();
    $sectionsJS = htmlspecialchars(serialize($sections), ENT_QUOTES);
    //print($_POST["promoEtudiant"]);
    //print(isset($_POST["promoEtudiant"]));
    if(isset($_POST["promoEtudiant"])){
        print("if");
        $characts    = 'abcdefghijklmnopqrstuvwxyz';
        $characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';    
        $characts   .= '1234567890'; 
        $code_aleatoire      = ''; 

        for($i=0;$i < 5;$i++)    //10 est le nombre de caractères
        { 
            $code_aleatoire .= substr($characts,rand()%(strlen($characts)),1); 
        }
        $promo = $_POST["promoEtudiant"];
        ModelPromo::set_mdp_test($code_aleatoire,$promo);
        
    }
    $pagetitle = "Generateur de code";
    $view = "code";

    require ("{$ROOT}{$DS}view{$DS}view.php");
    break;
    
}
?>