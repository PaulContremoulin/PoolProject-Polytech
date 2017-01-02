<?php

require_once("{$ROOT}{$DS}model{$DS}modelEtudiant.php");
require_once("{$ROOT}{$DS}model{$DS}modelSection.php");

$action = $_GET['action'];// recupère l'action passée dans l'URL

//require_once ("{$ROOT}{$DS}model{$DS}ModelQuelconque.php"); // chargement du modèle

switch ($action) {

    case "profil":
        $pagetitle = "Votre profil";
        $view = "profil";

        /* A garder pour la gestion des etudiants / admins / pas inscrits
        if(Session::is_admin()){

        }else if(Session::is_user()){

        }else{

        }
        */
        
        require ("{$ROOT}{$DS}view{$DS}view.php");//"redirige" vers la vue
        break;

    case "connexion":

        $login = ModelEtudiant::getINE($_POST["login"]); //On récupère l'ine associé à l'e-mail
        $password = $_POST["password"];
        $cryptedPwd = Security::chiffrer($password);
        $checkAccount = ModelEtudiant::checkPassword($login,$cryptedPwd);
        if($checkAccount == true){

            $account = ModelEtudiant::select($login);

            $_SESSION['login']=$login;
            $_SESSION['nom'] = $account->getName();
            $_SESSION['admin'] = 0;
        }

        $pagetitle = "Votre profil";
        $view = "profil";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;

    case "deconnexion":

        unset($_SESSION['login']);
        unset($_SESSION['nom']);
        unset($_SESSION['admin']);

        $pagetitle = "Votre profil";
        $view = "profil";

        require ("{$ROOT}{$DS}view{$DS}view.php");
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
        $promoEtudiant = $_POST["promoEtudiant"];

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
                         "id_promo" => $promoEtudiant,
                    );

                    ModelEtudiant::insert($new_account);
                }
            }
        }

        //Redirection vers la page d'accueil
        $pagetitle = "Accueil";
        $view = "profil";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;

        case "test":
            require_once("{$ROOT}{$DS}model{$DS}modelGroupe.php");
            if(isset($_SESSION['login'])){
                //option du test
                print("option");
                $option = $_GET['option'];
                switch ($option) {
                    case "start" :
                        $groupe = modelGroupe::select("1");
                        print_r($groupe);
                        $tab_answers = $groupe->getAnswers();
                    break;

                }

                $pagetitle = "Test";
                $view = "test";

                require ("{$ROOT}{$DS}view{$DS}view.php");


            }else{
                //erreur
            }
            break;
}
?>
