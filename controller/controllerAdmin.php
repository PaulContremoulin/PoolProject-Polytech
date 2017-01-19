<?php
/** Ce controller est appelé quand des actions de la part de l'admin sont reçues. Chaque action correspond a un case **/
/** Le require est necessaire pour avoir certaine fonction des classes qui y sont décritent **/ 
require_once("{$ROOT}{$DS}model{$DS}modelEtudiant.php"); /* Pour le ModelEtudiant */ 
require_once("{$ROOT}{$DS}model{$DS}modelSection.php"); /* Pour le ModelSection */ 
require_once("{$ROOT}{$DS}model{$DS}modelAdmin.php"); /* Pour le ModelAdmin */ 
require_once("{$ROOT}{$DS}model{$DS}modelPromo.php"); /* Pour le ModelPromo */ 

$action = $_GET['action'];// recupère l'action passée dans l'URL

switch ($action) {

    case "connexion": /* Dans le cas ou l'admin demande une connexion on fais toutes les vérif relatif a celle ci (verification du mail entré, controle des mot de passes, vérification de presence en base de données) */

        $login = ModelAdmin::getID($_POST["login"]); //On récupère l'ine associé à l'e-mail
        $password = $_POST["password"]; //On récupère le password entré par l'utilisateur
        $cryptedPwd = Security::chiffrer($password); //on crypte ce password pour pouvoir le comparé avec celui qui est en bd 
        $checkAccount = ModelAdmin::checkPassword($login,$cryptedPwd); // on appel la fonction de comparaison de mots de passe du moodel etudiant. On lui passe en parametre l'ine de l'utilisateur et le password entré pour la comparaison
        if($checkAccount){ // il y'a un booléen dans le checkAccount: si le mot de passe est bon True sinon false
            $account = ModelAdmin::select($login); // on recupère les information de ce compte

            $_SESSION['login']=$login; // Le login est sauvegarder pour des besoin systeme : la connexion automatique, la sauvegarde des actions, etc.....
            $_SESSION['admin'] = 1; // Pour savoir si c'est un admin ou pas
        }else{
            $msgError = "Erreur de connexion, l'identifiant ou le mot de passe est incorect.";
        }

    case "profil": /* L'admin accède a son compte, il obtient une page ou il y'a les resultats de toutes les sections */

        if(isset($_SESSION['login']) && ($_SESSION['admin'] == 1)){//On verifie bien que l'utilisateur est le bon et que c'est un admin
            require_once("{$ROOT}{$DS}model{$DS}modelSelectionner.php");

            $id_section = modelSection::ids_sections();
            $profils = array();

            foreach ($id_section as $id) {
                $profils[$id] = ModelSelectionner::calcul_result_departement($id);
            }
/*
            $tab_ig = ModelSelectionner::calcul_result_departement("IG"); // Les fonctions qui suivent servent au calcul des    resultatas de chaque promo
            $tab_mea = ModelSelectionner::calcul_result_departement("MEA");
            $tab_ste = ModelSelectionner::calcul_result_departement("STE");
            $tab_gba = ModelSelectionner::calcul_result_departement("GBA");
            $tab_mat = ModelSelectionner::calcul_result_departement("MAT");
            $tab_mi = ModelSelectionner::calcul_result_departement("MI");

            $labels = array(); //Tableau contenant les titres des personnalités
            $profil_ig = array(); //Tableaux contenant les valeurs des personnalités
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
*/
        }

        /* la vue profil promo sera visualisée a l'interreur de la vue accueil*/
        $pagetitle = "Mon profil";
        $view = "profilpromo";

        $pagetitle = "Accueil";
        $view = "accueil";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;


    case "deconnexion": /** Dans le cas ou l'utilisateur souhaite se deconnecter */

        unset($_SESSION['login']); /** On lui retire tout ce qu'on sait de lui sur le serveur. ça permet d'éviter les connexion automatiques dans le cas ou ce n'est pas le bon utilisateur **/
        unset($_SESSION['admin']);

        $pagetitle = "Accueil";/* On appel cette page pour rediriger l'utilisateur vers sa page d'accueil */
        $view = "accueil";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;

    case "creation": /** Lorqu'un administrateur veut en créer un autre, l'action passée dans l'url est celle-ci */
        $pwdAdmin = $_POST["pwdAdmin"]; // Le password passé dans le formulaire
        $nameAdmin = $_POST["nameAdmin"]; // Le nom passé dans le formulaire
        $prenomAdmin = $_POST["prenomAdmin"]; // Le prenom passé dans le formulaire
        $mailAdmin = $_POST["mailAdmin"]; // Le mail passé dans le formulaire
        $confirmPwd = $_POST["confirmPwd"]; // La confirmation du password passé dans le formulaire

        if(!ModelAdmin::mailExist($mailAdmin)){ // on vérifie que le mail n'exite pas deja en bd
            if(ModelAdmin::isMailFormat($mailAdmin)){ // et qu'il est sou forme de mail
                if($pwdAdmin == $confirmPwd){ // On verifie que le password est bien celui confirmé par l'utilisateur
                    $pwdAdmin = Security::chiffrer($pwdAdmin); // on chiffre le mot de passe a notre sauce, voir security.php

                    $new_account = array( //Toutes les infos du nouvel admin
                        "id_admin" => $id_admin,
                        "nom_admin" => $nameAdmin,
                        "prenom_admin" => $prenomAdmin,
                        "mail_admin" => $mailAdmin,
                         "mdp_admin" => $pwdAdmin,
            
                    );

                    ModelAdmin::insert($new_account); // on insère le nouvel admin en base de données
                }
            }
        }
        $listeAdmin = ModelAdmin::getAdmins(); // recupère la liste des administrateurs
        $pagetitle = "Liste des admins";
        $view = "liste"; // on retourne a la page d'affichage des admins

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;


    case "admins": /** Permet de rediriger l'admin vers la page de listing des administrateur de lâ plateforme **/

        if(isset($_SESSION['login']) && $_SESSION['admin']==1){ //On vérifie que c'est un administrateur et qu'il est bien connecté
            $listeAdmin = ModelAdmin::getAdmins();
            $pagetitle = "Liste des admins";
            $view = "liste";
        }
        
        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;


case "modif": // Sert a la modification des informations d'un administrateur
    $pwdAdmin = $_POST["mdp"];
    $nameAdmin = $_POST["nom"];
    $prenomAdmin = $_POST["prenom"];
    $mailAdmin = $_POST["email2"];
    $confirmPwd = $_POST["confirmPwd"];

    //On fais les différentes vérifications nécessaire avant d'insérer dans la base de donnée
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

                    ModelAdmin::insert($new_account); // On insère les nouvelles informations de l'administrateur concerné
                }
            }
        $listeAdmin = ModelAdmin::getAdmins(); //On récupère de nouveaux la liste des admins et on redirige l'utilisateur vers la page d'affichage des admins
        $pagetitle = "Liste des admins";
        $view = "liste";
    }
    require ("{$ROOT}{$DS}view{$DS}view.php");
    break;


case "questionnaire": /* Sers a la modification des propositions du questionnaire */

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

    $tab_grps = ModelReponse::get_all_reponse(); // On recupère l'ensemble des réponses


    $pagetitle = "Modification du questionnaire";
    $view = "questionnaire";

    require ("{$ROOT}{$DS}view{$DS}view.php");
    break;
    


case "promo": /* Sert a requêter en base de données l'ensemble des informations sur les promos de chaque departement */
    $promotion = ModelPromo::getall();
    $pagetitle = "Informations sur les promos";
    $view = "listepromo";

    require ("{$ROOT}{$DS}view{$DS}view.php");
    break;


 case "code": /* Permet de creer un code unique pour l'accès au questionnaire . Ce code est ensuite attribué a une promo */
    $sections = ModelSection::listeSections();
    $sectionsJS = htmlspecialchars(serialize($sections), ENT_QUOTES);
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
        
    } /*On redirige l'utilisateur vers la page de génération des codes */
    $pagetitle = "Generateur de code";
    $view = "code";

    require ("{$ROOT}{$DS}view{$DS}view.php");
    break;
    
}
?>