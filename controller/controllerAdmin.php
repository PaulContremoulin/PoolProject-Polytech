<?php

require_once("{$ROOT}{$DS}model{$DS}modelEtudiant.php");
require_once("{$ROOT}{$DS}model{$DS}modelSection.php");
require_once("{$ROOT}{$DS}model{$DS}modelAdmin.php");


$action = $_GET['action'];// recupère l'action passée dans l'URL

//require_once ("{$ROOT}{$DS}model{$DS}ModelQuelconque.php"); // chargement du modèle

switch ($action) {

    
    case "profil":

        if(isset($_SESSION['login'])){

            
        }

        $pagetitle = "Mon profil";
        $view = "profil";

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
            print("if");
            $account = ModelAdmin::select($login);

            $_SESSION['login']=$login;
            //$_SESSION['nom'] = $account->getName();
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
        $view = "profil";
        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;
   /* case "inscription":

        $sections = ModelSection::listeSections();
        $sectionsJS = htmlspecialchars(serialize($sections), ENT_QUOTES);
        $pagetitle = "Inscription";
        $view = "inscription";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break; 
*/
    case "creation":

        $id_admin = $_POST["id_admin"];
        $pwdAdmin = $_POST["pwdAdmin"];
        $nameAdmin = $_POST["nameAdmin"];
        $prenomAdmin = $_POST["Admin"];
        $mailAdmin = $_POST["mailAdmin"];
        $confirmPwd = $_POST["confirmPwd"];

        if(!ModelAdmin::mailExist($mailAdmin)){
            if(ModelAdmin::isMailFormat($mailAdmin)){
                if($pwdAdmin == $confirmPwd){
                    $pwdAdmin = Security::chiffrer($pwdAdmin);

                    $new_account = array(
                         "id_admin" => $id_admin,
                         "mdp_admin" => $pwdAdmin,
                         "nom_admin" => $nameAdmin,
                         "prenom_admin" => $prenomAdmin,
                         "mail_admin" => $mailAdmin,
                    );

                    ModelAdmin::insert($new_account);
                }
            }
        }

        //Redirection vers la page d'accueil
        $pagetitle = "Bienvenue";
        $view = "accueil";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;

    case "admins":

        if(isset($_SESSION['login']) && $_SESSION['admin']==1){
            print("admins");
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
    $mailAdmin = $_POST["email"];
    $confirmPwd = $_POST["confirmPwd"];
    $actuel_admin = $_SESSION["login"];

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

                    ModelAdmin::update($new_account,$actuel_admin);
                }
            }
        $listeAdmin = ModelAdmin::getAdmins();
        $pagetitle = "Liste des admins";
        $view = "liste";
    }
    require ("{$ROOT}{$DS}view{$DS}view.php");
    break;


case "question":
    print("a faire");


case "promo":
    print("a faire en 1ere position");

case "departement":
    print("a faire en 2e positions");

 

 case "code":
    print("facile a faire. Selection de la promo concernée, du departement, generation du code avec un random et insertion dans la base de donnee");     
}
?>