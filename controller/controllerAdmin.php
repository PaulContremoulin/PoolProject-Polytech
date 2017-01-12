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
        print($_POST["login"]);
        print($_POST["password"]);
        $login = ModelAdmin::getID($_POST["login"]); //On récupère l'ine associé à l'e-mail
        $password = $_POST["password"];
        $cryptedPwd = Security::chiffrer($password);
        print($cryptedPwd);
        $checkAccount = ModelAdmin::checkPassword($login,$cryptedPwd);
        print($checkAccount);
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

        if(!ModelUser::mailExist($mailEtudiant)){
            if(ModelUser::isMailFormat($mailEtudiant)){
                if($pwdAdmin == $confirmPwd){
                    $pwdAdmin = Security::chiffrer($pwdAdmin);

                    $new_account = array(
                         "id_admin" => $id_admin,
                         "mdp_admin" => $pwdAdmin,
                         "nom_admin" => $nameAdmin,
                         "prenom_admin" =>  $prenomAdmin,
                         "mail_admin" => $mailAdmin,
                    );

                    ModelUser::insert($new_account);
                }
            }
        }

        //Redirection vers la page d'accueil
        $pagetitle = "Bienvenue";
        $view = "AccueilAdmin";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;
}

        /*case "test":

            //Si l'utilisateur est connecté
            if(isset($_SESSION['login'])){
                //si l'identifiant du groupe est envoyé par le formulaire
                if(isset($_POST['idGroupe'])){
                    //si tous les choix sont cochés
                    if(isset($_POST['choix1']) && isset($_POST['choix2']) && isset($_POST['choix3'])){
                        require_once("{$ROOT}{$DS}model{$DS}modelSelectionner.php");
                        $new_result = array(
                         "choix_1" => $_POST['choix1'],
                         "choix_2" => $_POST['choix2'],
                         "choix_3" => $_POST['choix3'],
                         "id_groupe" => $_POST['idGroupe'],
                         "id_etud" => $_SESSION['login'],
                        );

                        ModelSelectionner::insert($new_result);
                        //si clic sur groupe precedent
                        if(isset($_POST['Precedent'])){
                            $idGroupe = intval($_POST['idGroupe']) - 1;
                        //si clic sur groupe suivant
                        }else if(isset($_POST['Suivant'])){
                            $idGroupe = intval($_POST['idGroupe']) + 1;
                        }else if(isset($_POST['Terminer'])){
                            $pagetitle = "Mon Profil";
                            $view = "profil";
                            require ("{$ROOT}{$DS}view{$DS}view.php");
                            break;
                        }
                    //si un choix n'est pas coché
                    }else{
                        $msgError = "Vous devez cocher 3 choix.";
                        $idGroupe = $_POST['idGroupe'];
                    }
                    $_SESSION['idGroupe'] = $idGroupe;
                //si la session avait deja un test commencé
                }else if(isset($_SESSION['idGroupe'])){
                    $idGroupe = intval($_SESSION['idGroupe']);
                //si l'utilisateur commence le test
                }else{
                    $idGroupe = 1;
                    $_SESSION['idGroupe'] = $idGroupe;
                }

                require_once("{$ROOT}{$DS}model{$DS}modelGroupe.php");
                $groupe = modelGroupe::select($idGroupe);
                $tab_answers = $groupe->getAnswers();

                $pagetitle = "Test";
                $view = "test";

            //Si l'utilisateur n'est pas connecté
            }else{
                $pagetitle = "Erreur";
                $view = "Erreur";
            }
            require ("{$ROOT}{$DS}view{$DS}view.php");
            break;
}*/
?>