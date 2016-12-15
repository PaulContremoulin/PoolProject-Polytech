<?php

require_once ("model.php"); 

class ModelUser extends Model {

  private $mailUser;
  private $nameUser;
  private $pwdUser;
  private $isAdmin;

  protected static $table = 'User';
  protected static $primary = 'mailUser';
   
  //un getter      
  public function getMail() {
       return $this->mailUser;  
  }
  
  public function getPwd() {
       return $this->pwdUser;  
  }
 
  public function getName() {
       return $this->nameUser;  
  }

  public function getIsAdmin() {
       return $this->isAdmin;  
  }

  public function __construct($mail = NULL, $pwd = NULL, $name = NULL, $admin = NULL) {
    if (!is_null($mail) && !is_null($pwd) && !is_null($name) && !is_null($admin)) {
      $this->mailUser = $mail;
      $this->pwdUser = $pwd;
      $this->nameUser = $name;
      $this->isAdmin = $admin;
      $this->tabAtt = array (
					"mail"  => $this->mailUser,
					"name" => $this->nameUser,
					"pwd" => $this->pwdUser,
				);
    }
  }

	public static function checkPassword($login,$mot_de_passe_crypte){

    $check = false;
	  $sql = "SELECT * FROM User WHERE mailUser = :user AND pwdUser = :pwd";

	  try{

		  $req_prep = Model::$pdo->prepare($sql);
		  $req_prep->bindParam(":user", $login);
		  $req_prep->bindParam(":pwd", $mot_de_passe_crypte);
		  $req_prep->execute();

		  if($req_prep->rowCount()>0){
			  $check = true;
		  }

      return $check;

	  } catch(PDOException $e) {
		  echo 'Cheking failed: ' . $e->getMessage();		  
	  }
	}

  public static function mailExist($mail){
    $sql = "SELECT mailUser FROM User WHERE mailUser= :mail;";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute(array(':mail'=>$mail));
    return ($req_prep->rowCount()!=0);
  }

  public static function isMailFormat($mail){
    return preg_match("#^[a-z0-9._-]{1,}@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$mail);
  }

/*
  function delete(){
    Model::delete($this->modele);
  }
  */
}
?>
