<?php

require_once("{$ROOT}{$DS}model{$DS}modelEtudiant.php");
require_once("{$ROOT}{$DS}model{$DS}modelSection.php");
require_once("{$ROOT}{$DS}model{$DS}modelAdmin.php");
require_once("{$ROOT}{$DS}model{$DS}modelPromo.php");

$action = $_GET['action'];// recupère l'action passée dans l'URL

//require_once ("{$ROOT}{$DS}model{$DS}ModelQuelconque.php"); // chargement du modèle

switch ($action) {

    case "connexion":
        $login = ModelAdmin::getID($_POST["login"]); //On récupère l'ine associé à l'e-mail
        $password = $_POST["password"];
        $cryptedPwd = Security::chiffrer($password);
        $checkAccount = ModelAdmin::checkPassword($login,$cryptedPwd);
        if($checkAccount){
            $account = ModelAdmin::select($login);

            $_SESSION['login']=$login;
            $_SESSION['admin'] = 1;
        }else{
            $msgError = "Erreur de connexion, l'identifiant ou le mot de passe est incorect.";
        }

    case "profil":


        $tab_ig = ModelSelectionner::calcul_result_departement("IG");
        $tab_mea = ModelSelectionner::calcul_result_departement("MEA");
        $tab_ste = ModelSelectionner::calcul_result_departement("STE");
        $tab_gba = ModelSelectionner::calcul_result_departement("GBA");
        $tab_mat = ModelSelectionner::calcul_result_departement("MAT");
        $tab_mi = ModelSelectionner::calcul_result_departement("MI");

        $labels = array(); //Tableau contenant les titres des personnalités
        $profil_ig = array(); //Tableau contenant les valeurs des personnalités
        $profil_mea = array(); 
        $profil_ste = array(); 
        $profil_gba = array(); 
        $profil_mat = array(); 
        $profil_mi = array(); 

        //Affectation des valeurs aux deux tableaux
        foreach($tab_ig as $key => $values){
            array_push($labels, $key);
            array_push($profil_ig, $values);
        }

        foreach($tab_mea as $key => $values){
            array_push($profil_mea, $values);
        }

        foreach($tab_ste as $key => $values){
            array_push($profil_ste, $values);
        }

        foreach($tab_gba as $key => $values){
            array_push($profil_gba, $values);
        }

        foreach($tab_mat as $key => $values){
            array_push($profil_mat, $values);
        }

        foreach($tab_mi as $key => $values){
            array_push($profil_mi, $values);
        }

        /* la vue profil promo sera visualisée a l'interreur de la vue accueil*/
        $pagetitle = "Mon profil";
        $view = "profilpromo";

        $pagetitle = "Accueil";
        $view = "accueil";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;


    case "deconnexion":

        unset($_SESSION['login']);
        unset($_SESSION['admin']);

        $pagetitle = "Accueil";
        $view = "accueil";

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

    require_once("{$ROOT}{$DS}model{$DS}modelReponse.php");

    $idGroupe = 1;

    //si une mise a jour des informations est détecté
    if(isset($_POST["MaJ"])){
        $idGroupe = $_POST["idGroupe"];
        ModelReponse::update(array("text_reponse" => $_POST["text_1"]), $_POST["idr_1"]);
        ModelReponse::update(array("text_reponse" => $_POST["text_2"]), $_POST["idr_2"]);
        ModelReponse::update(array("text_reponse" => $_POST["text_3"]), $_POST["idr_3"]);
        ModelReponse::update(array("text_reponse" => $_POST["text_4"]), $_POST["idr_4"]);
        ModelReponse::update(array("text_reponse" => $_POST["text_5"]), $_POST["idr_5"]);
        ModelReponse::update(array("text_reponse" => $_POST["text_6"]), $_POST["idr_6"]);
        $msgValid = "La mise à jour a été effectuée.";
    }

    $tab_grps = ModelReponse::get_all_reponse();


    $pagetitle = "Modification du questionnaire";
    $view = "questionnaire";

    require ("{$ROOT}{$DS}view{$DS}view.php");
    break;
    


case "promo":
    $promotion = ModelPromo::getall();
    $pagetitle = "Informations sur les promos";
    $view = "listepromo";

    require ("{$ROOT}{$DS}view{$DS}view.php");
    break;
    
/*
case "departement":
    print("a faire en 2e positions");

*/ 

 case "code":
    $sections = ModelSection::listeSections();
    $sectionsJS = htmlspecialchars(serialize($sections), ENT_QUOTES);
    //print($_POST["promoEtudiant"]);
    //print(isset($_POST["promoEtudiant"]));
    if(isset($_POST["promoEtudiant"])){
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