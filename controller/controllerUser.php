<?php

require_once("{$ROOT}{$DS}model{$DS}modelUser.php");

$action = $_GET['action'];// recupère l'action passée dans l'URL

//require_once ("{$ROOT}{$DS}model{$DS}ModelQuelconque.php"); // chargement du modèle

switch ($action) {
	
    case "connexion":

        $login = $_POST["login"];
        $password = $_POST["password"];
        print_r($login);
        print_r($password);
        $cryptedPwd = Security::chiffrer($password);
        print_r(cryptedPwd);
        $checkAccount = ModelUser::checkPassword($login,$cryptedPwd);
        print_r($checkAccount);
        if($checkAccount == true){

            $account = ModelUser::select($login);

            $_SESSION['login']=$login;
            $_SESSION['nom'] = $account->getName();
            $_SESSION['admin'] = $account->getIsAdmin();

            $controller="accueil";
            $_GET['action'] = "default";
        }
        $controller="accueil";
        $_GET['action'] = "default";

        require ("{$ROOT}{$DS}controller{$DS}controller".ucfirst($controller).".php"); //ucfirst met la premiere lettre de la chaine en MAJ
        break;

    case "inscription":

        $pagetitle = "Inscription";
        $view = "inscription";

        require ("{$ROOT}{$DS}view{$DS}view.php");
        break; 

    case "creation":
        $mailUser = $_POST["mailUser"];
        $nameUser = $_POST["nameUser"];
        $pwdUser = $_POST["pwdUser"];
        $confirmPwd = $_POST["confirmPwd"];

        if(!modelUser::mailExist($mailUser)){
            if(modelUser::isMailFormat($mailUser)){
                if($pwdUser == $confirmPwd){
                    $pwdUser = Security::chiffrer($pwdUser);

                    $new_account = array(
                         "mailUser" =>  $mailUser,
                         "pwdUser" => $pwdUser,
                         "nameUser" => $nameUser,
                         "isAdmin" => 0,
                    );

                    ModelUser::insert($new_account);
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
