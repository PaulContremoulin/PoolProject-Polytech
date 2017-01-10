<?php
class Conf {

  static private $databases = array(

    'hostname' => 'mysql.hostinger.fr',

    'database' => 'u972922602_pool',

    'login' => 'u972922602_admin',

    'password' => 'pool342016'
  );

  static public function getLogin() {
    # getLogin : => char[]
      #resultat : chaîne de caractère qui correspond au login 
    return self::$databases['login'];
  }

  static public function getHostname(){
    #getHostname : => char[]
      #resultat : renvoie une chaîne de caractère qui correspon au serveur où est hebergé la base de donnée
    return self::$databases['hostname'];
  }

  static public function getDatabase() {
    #getDatabase : => char[]
      #resultat : renvoie le nom de la base de donnée en ligne
    return self::$databases['database'];
  }

  static public function getPassword(){
    #getPassword : => char[]
      #résultat: chaîne de caractères qui renvoie le mot de passe 
    return self::$databases['password'];
  }

}
?>
