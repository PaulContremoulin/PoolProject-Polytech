<?php
class Conf {
   
  static private $databases = array(

    'hostname' => 'mysql.hostinger.fr',

    'database' => 'u972922602_pool',

    'login' => 'u972922602_admin',

    'password' => 'pool342016'
  );
   
  static public function getLogin() {
    return self::$databases['login'];
  }

  static public function getHostname(){
    return self::$databases['hostname'];
  } 

  static public function getDatabase() {
    return self::$databases['database'];
  } 

  static public function getPassword(){
    return self::$databases['password'];
  }
   
}
?>
