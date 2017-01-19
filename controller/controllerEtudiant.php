<?php

require_once("{$ROOT}{$DS}model{$DS}modelEtudiant.php");
require_once("{$ROOT}{$DS}model{$DS}modelSection.php");
require_once("{$ROOT}{$DS}model{$DS}modelPromo.php");

$action = $_GET['action'];// recupère l'action passée dans l'URL

switch ($action) {

    case "connexion": /* Dans le cas ou l'etudiant demande une connexion on fais toutes les vérif relatives a celle ci (verification du mail entré, controle des mot de passes, vérification de presence en base de données) */

        $mail = $_POST["login"];
        $login = ModelEtudiant::getINE($mail); //On récupère l'ine associé à l'e-mail
        $password = $_POST["password"];
        $cryptedPwd = Security::chiffrer($password);
        $checkAccount = ModelEtudiant::checkPassword($login,$cryptedPwd); // on appel la fonction de comparaison de mots de passe du moodel etudiant. On lui passe en parametre l'ine de l'utilisateur et le password entré pour la comparaison

        if($checkAccount == true){ // il y'a un booléen dans le checkAccount: si le mot de passe est bon True sinon false

            $account = ModelEtudiant::select($login); // on recupère les information de ce compte
        
            $_SESSION['mail']=$mail;
            $_SESSION['login']=$login;// Le login est sauvegarder pour des besoin systeme : la connexion automatique, la sauvegarde des actions, etc.....
            $_SESSION['nom'] = $account->getName();
            $_SESSION['admin'] = 0;
        }else{
            $msgError = "Erreur de connexion, l'identifiant ou le mot de passe est incorect.";
        }


        //break; Le break saute car une fois connecté, on veut exécuter le code de profil pour etre redirigée vers la page d'accueil de l'étudiant

    case "profil": /* L'etudiant accède a son compte, il obtient ses resultats si il a deja passé le test de sa promo sinon il dois obligatoirement réaliser le test */

        if(isset($_SESSION['login'])){
            require_once("{$ROOT}{$DS}model{$DS}modelSelectionner.php");
            $tab_reponses = ModelSelectionner::select_by_num_user($_SESSION['login']); //On recupere l'ensemble des reponse de l'utilisateurs dans la table Selectionner
            $nbQuestionsSave = count($tab_reponses);

            if($nbQuestionsSave==12){// Test terminé
                $tab_calculer = ModelSelectionner::calcul_result_etud($tab_reponses);
                $tab_calculer_promo = ModelSelectionner::calcul_result_promo(ModelEtudiant::getPromo($_SESSION['login']));
                $labels = array(); //Tableau contenant les titres des personnalités
                $profil = array(); //Tableau contenant les valeurs des personnalités
                $profil_promo = array();
                //Affectation des valeurs aux deux tableaux
                foreach($tab_calculer as $key => $values){
                    array_push($labels, $key);
                    array_push($profil, $values);
                }

                foreach($tab_calculer_promo as $key => $values){
                    array_push($profil_promo, $values);
                }

                $max1=0;
                $max2=0;
                $max3=0;
                $key1=0;
                $key2=0;
                $key3=0;
                foreach ($profil as $key => $value) {
                    if($value>$max1){
                        $max1=$value;
                        $key1=$key;
                    }
                    elseif ($value>$max2) {
                        $max2=$value;
                        $key2=$key;                   
                    }
                    elseif ($value>$max3) {
                        $max3=$value;
                        $key3=$key;
                    }
                }
                require_once("{$ROOT}{$DS}model{$DS}modelProfil.php");
                $profil1=ModelProfil::select(ModelProfil::retrieve_id2($labels[$key1]));
                $profil2=ModelProfil::select(ModelProfil::retrieve_id2($labels[$key2]));
                $profil3=ModelProfil::select(ModelProfil::retrieve_id2($labels[$key3]));



            }elseif($nbQuestionsSave >= 1){ // Si il a commencé le test 
                $_SESSION['idGroupe'] = $nbQuestionsSave+1; // Il a déjà fait $nbQuestion, donc on le renvoie à la nbQuestion + 1
            }

        }

        $pagetitle = "Votre profil";
        $view = "accueil";

        require ("{$ROOT}{$DS}view{$DS}view.php");

        break;


    case "deconnexion": /** Dans le cas ou l'utilisateur souhaite se deconnecter **/

        unset($_SESSION['login']); /** On lui retire tout ce qu'on sait de lui sur le serveur. ça permet d'éviter les connexion automatiques dans le cas ou ce n'est pas le bon utilisateur **/
        unset($_SESSION['nom']);
        unset($_SESSION['admin']);
        unset($_SESSION['idGroupe']);

        $pagetitle = "Accueil"; /* On appel cette page pour rediriger l'utilisateur vers sa page d'accueil */
        $view = "accueil";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;

    case "inscription":

        $sections = ModelSection::listeSections();
        $sectionsJS = htmlspecialchars(serialize($sections), ENT_QUOTES);
        $pagetitle = "Inscription";
        $view = "inscription";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break; 

    case "creation": /** Lorqu'un administrateur veut en créer un autre, l'action passée dans l'url est celle-ci */

        $ineEtudiant = $_POST["ineEtudiant"];  // Le password passé dans le formulaire
        $pwdEtudiant = $_POST["pwdEtudiant"]; // Le nom passé dans le formulaire
        $nameEtudiant = $_POST["nameEtudiant"]; // Le prenom passé dans le formulaire
        $prenomEtudiant = $_POST["prenomEtudiant"]; // Le mail passé dans le formulaire
        $mailEtudiant = $_POST["mailEtudiant"]; // La confirmation du password passé dans le formulaire
        $confirmPwd = $_POST["confirmPwd"]; 
        $promoEtudiant = $_POST["promoEtudiant"];

        if(!modelEtudiant::mailExist($mailEtudiant) && !modelEtudiant::ineExist($ineEtudiant)){ // on vérifie que le mail n'exite pas deja en bd ou si l'ine n'est pas deja en bd
            if(modelEtudiant::isMailFormat($mailEtudiant)){// et qu'il est sou forme de mail
                if($pwdEtudiant == $confirmPwd){// On verifie que le password est bien celui confirmé par l'utilisateur
                    $pwdEtudiant = Security::chiffrer($pwdEtudiant);  // on chiffre le mot de passe a notre sauce, voir security.php

                    $new_account = array(  //Toutes les infos du nouvel eleve
                         "id_etudiant" => $ineEtudiant,
                         "pwd_etud" => $pwdEtudiant,
                         "nom_etud" => $nameEtudiant,
                         "prenom_etud" =>  $prenomEtudiant,
                         "mail_etud" => $mailEtudiant,
                         "id_promo" => $promoEtudiant,
                    );

                    ModelEtudiant::insert($new_account); // on insère le nouvel admin en base de données

                    //Redirection vers la page d'accueil
                    $pagetitle = "Accueil";
                    $view = "accueil";
                }
            }else{
                $msgError = " Erreur : Le format de l'email est invalide.";
                //Redirection vers la page d'inscription
                $sections = ModelSection::listeSections();
                $sectionsJS = htmlspecialchars(serialize($sections), ENT_QUOTES);
                $pagetitle = "Inscription";
                $view = "inscription";

            }
        }else{
            $msgError = " Erreur : L'ine ou le mail existe déjà.";
            //Redirection vers la page d'inscription
            $sections = ModelSection::listeSections();
            $sectionsJS = htmlspecialchars(serialize($sections), ENT_QUOTES);
            $pagetitle = "Inscription";
            $view = "inscription";
        }

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break;

        case "code": // Permet de controler le code entré par l'utilisateur pour accéder a un test.
            
            if(isset($_SESSION['login'])){
                 if(isset($_POST['pwdTest'])){
                    $promoEtudiant = ModelEtudiant::getPromo($_SESSION['login']); // On récupere la promo de l'étudiant
                    $mdpTest = $_POST['pwdTest'];
                    $mdppromo = ModelPromo::recupMDP($promoEtudiant); // On recupere le mdp de la promo de l'étudiant
                    if($mdppromo[0] == $mdpTest){ // On vérifie que le mot de passe entré par l'étudiant est conforme a celui de sa promo
                        $_GET['action'] = "test"; //On fait appel a l'action test pour afficher le questionnaire
                        require ("{$ROOT}{$DS}controller{$DS}controller".ucfirst($controller).".php");
                        break;
                    }
                    else{
                        $pagetitle = "Code erroné";
                        $view = "code";
                    }
                }else{
                    $pagetitle = "Code pour l'accès au test";
                    $view = "code";
                }
            }else{
                 $pagetitle = "Erreur";
                $view = "connexion";
            }
            require ("{$ROOT}{$DS}view{$DS}view.php");
            break;
                
        case "test": //L'utilisateur veut passer le test, on récupere les question et on les envoi a la vue pour affichage

            //Si l'utilisateur est connecté
            if(isset($_SESSION['login'])){
                //si l'identifiant du groupe est envoyé par le formulaire
                if(isset($_POST['idGroupe'])){
                    //si tous les choix sont cochés
                    $reponsesValides = isset($_POST['choix1']) && isset($_POST['choix2']) && isset($_POST['choix3']);
                    if($reponsesValides){
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
                        //Le test est terminé
                        }else if(isset($_POST['Terminer'])){
                            $idGroupe = intval($_POST['idGroupe']);

                        }
                    //si un choix n'est pas coché
                    }else{
                        $msgError = "Vous devez cocher 3 choix.";
                        $idGroupe = intval($_POST['idGroupe']);
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

                if(isset($_POST['Terminer']) && $reponsesValides){ //Si le test s'est terminé correctement
                    //Récupération de tous les résultats
                    require_once("{$ROOT}{$DS}model{$DS}modelSelectionner.php");
                    $tab_reponses = ModelSelectionner::select_by_num_user($_SESSION['login']);
                    $nbQuestionsSave = count($tab_reponses);
                    $tab_calculer = ModelSelectionner::calcul_result_etud($tab_reponses);
                    $labels = array(); //Tableau contenant les titres des personnalités
                    $profil = array(); //Tableau contenant les valeurs des personnalités                     
                    //Affectation des valeurs aux deux tableaux
                    foreach($tab_calculer as $key => $values){
                        array_push($labels, $key);
                        array_push($profil, $values);
                    }
                    $_GET['action'] = "profil";
                    require ("{$ROOT}{$DS}controller{$DS}controller".ucfirst($controller).".php");
                    break;

                }else{//Sinon, on continue sur le test
                    require_once("{$ROOT}{$DS}model{$DS}modelGroupe.php");
                    $groupe = modelGroupe::select($idGroupe);
                    $tab_answers = $groupe->getAnswers();

                    $pagetitle = "Test RIASEC";
                    $view = "test";
                }

            //Si l'utilisateur n'est pas connecté
            }else{
                $pagetitle = "Erreur";
                $view = "Erreur";
            }
            require ("{$ROOT}{$DS}view{$DS}view.php");
            break;
}
?>
