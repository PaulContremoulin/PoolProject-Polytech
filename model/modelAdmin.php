<?php

require_once ("model.php"); 

class ModelAdmin extends Model {

  private $mail_admin;
  private $nom_admin;
  private $mdp_admin;
  private $prenom_admin;
  private $id_admin;

  protected static $table = 'admin';
  protected static $primary = 'id_admin';


   
  //un getter      
  public function getMail() {
       return $this->$mail_admin;
  }
  
  public function getPwd() {
       return $this->$mdp_admin;  
  }
 
  public function getName() {
       return $this->$nom_admin;  
  }

  /*public function getIsAdmin() {
       return $this->isAdmin;  
  }*/

  public function __construct($mail = NULL, $pwd = NULL, $name = NULL) {
    if (!is_null($mail) && !is_null($pwd) && !is_null($name) && !is_null($admin)) {
      $this->mail_admin = $mail;
      $this->mdp_dmin = $pwd;
      $this->nom_admin = $name;
      $this->tabAtt = array (
					"mail"  => $this->mail_admin,
					"name" => $this->nom_admin,
					"pwd" => $this->mdp_admin,
				);
    }
  }

	public static function checkPassword($login,$mot_de_passe_crypte){

    $check = false;
	  $sql = "SELECT * FROM ".static::$table." WHERE mail_admin = :login AND mdp_admin = :pwd";

	  try{

		  $req_prep = Model::$pdo->prepare($sql);
		  $req_prep->bindParam(":login", $login);
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
    $sql = "SELECT mail_admin FROM Admin WHERE mail_admin= :mail;";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute(array(':mail'=>$mail));
    return ($req_prep->rowCount()!=0);
  }

  public static function isMailFormat($mail){
    return preg_match("#^[a-z0-9._-]{1,}@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$mail);
  }

  public static function getID($mail){
    $sql =  "SELECT id_admin ".
            "FROM ". static::$table." ".
            "WHERE mail_admin = :mail;";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute(array(':mail'=>$mail));
    $row = $req_prep->fetch(PDO::FETCH_ASSOC);
    return $row['id_admin'];        
  }
/*
  function delete(){
    Model::delete($this->modele);
  }
  */
}
?>
