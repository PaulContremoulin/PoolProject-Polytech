<?php

require_once("{$ROOT}{$DS}model{$DS}modelEtudiant.php");
require_once("{$ROOT}{$DS}model{$DS}modelSection.php");

$action = $_GET['action'];// recupère l'action passée dans l'URL

//require_once ("{$ROOT}{$DS}model{$DS}ModelQuelconque.php"); // chargement du modèle

switch ($action) {

    case "connexion":

        $mail = $_POST["login"];
        $login = ModelEtudiant::getINE($mail); //On récupère l'ine associé à l'e-mail
        $password = $_POST["password"];
        $cryptedPwd = Security::chiffrer($password);
        $checkAccount = ModelEtudiant::checkPassword($login,$cryptedPwd);
        if($checkAccount == true){

            $account = ModelEtudiant::select($login);
        
        $_SESSION['mail']=$mail;
            $_SESSION['login']=$login;
            $_SESSION['nom'] = $account->getName();
            $_SESSION['admin'] = 0;
        }else{
            $msgError = "Erreur de connexion, l'identifiant ou le mot de passe est incorect.";
        }


        //break; Le break saute car une fois connecté, on veut exécuter le code de profil pour etre redirigée vers la page d'accueil de l'étudiant

    case "profil":

        if(isset($_SESSION['login'])){
            require_once("{$ROOT}{$DS}model{$DS}modelSelectionner.php");
            //$promo = ModelEtudiant::getPromo($_SESSION['login']);
            $tab_reponses = ModelSelectionner::select_by_num_user($_SESSION['login']);
            $nbQuestionsSave = count($tab_reponses);

            if($nbQuestionsSave==12){// Test terminé
                $tab_calculer = ModelSelectionner::calcul_result_etud($tab_reponses);


                $labels = array(); //Tableau contenant les titres des personnalités
                $profil = array(); //Tableau contenant les valeurs des personnalités
                
                //Affectation des valeurs aux deux tableaux
                foreach($tab_calculer as $key => $values){
                    array_push($labels, $key);
                    array_push($profil, $values);
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
            //$tab_calculer_promo = ModelSelectionner::calcul_result_promo($promo);


            /*foreach($tab_calculer_promo as $keyy => $valuess){
                array_push($tab_calculer_promo, $valuess);
            }*/

        }

        $pagetitle = "Votre profil";
        $view = "accueil";

        require ("{$ROOT}{$DS}view{$DS}view.php");

        break;

        /* A garder pour la gestion des etudiants / admins / pas inscrits
        if(Session::is_admin()){

        }else if(Session::is_user()){

        }else{

        }
        */

    case "deconnexion":

        unset($_SESSION['login']);
        unset($_SESSION['nom']);
        unset($_SESSION['admin']);
        unset($_SESSION['idGroupe']);

        $pagetitle = "Accueil";
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

    case "creation":

        $ineEtudiant = $_POST["ineEtudiant"];
        $pwdEtudiant = $_POST["pwdEtudiant"];
        $nameEtudiant = $_POST["nameEtudiant"];
        $prenomEtudiant = $_POST["prenomEtudiant"];
        $mailEtudiant = $_POST["mailEtudiant"];
        $confirmPwd = $_POST["confirmPwd"];
        $promoEtudiant = $_POST["promoEtudiant"];

        if(!modelEtudiant::mailExist($mailEtudiant) && !modelEtudiant::ineExist($ineEtudiant)){
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


        case "test":

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
                    $pagetitle = "Accueil";
                    $view = "profil";

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
