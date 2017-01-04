<?php

require_once("{$ROOT}{$DS}model{$DS}modelEtudiant.php");
require_once("{$ROOT}{$DS}model{$DS}modelSection.php");

$action = $_GET['action'];// recupère l'action passée dans l'URL

//require_once ("{$ROOT}{$DS}model{$DS}ModelQuelconque.php"); // chargement du modèle

switch ($action) {

    case "profil":

        if(isset($_SESSION['login'])){
            require_once("{$ROOT}{$DS}model{$DS}modelSelectionner.php");

            $tab_reponses = ModelSelectionner::select_by_num_user($_SESSION['login']);
            if(count($tab_reponses)==12){
                $tab_calculer = ModelSelectionner::calcul_result_etud($tab_reponses);
            }

            $labels = array();
            $profil = array();

            foreach($tab_calculer as $key => $values){
                array_push($labels, $key);
                array_push($profil, $values);
            }

        }

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
        unset($_SESSION['idGroupe']);

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
}
?>
