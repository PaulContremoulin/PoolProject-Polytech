<?php

require_once ("model.php"); 

class ModelEtudiant extends Model {

  private $id_etudiant;
  private $pwd_etud;
  private $nom_etud;
  private $prenom_etud;
  private $mail_etud;
  private $id_promo;

  protected static $table = 'Etudiant';
  protected static $primary = 'id_etudiant';
   
  //un getter      
  public function getMail() {
       return $this->mail_mail;  
  }
  
  public function getPwd() {
       return $this->pwd_etud;  
  }
 
  public function getName() {
       return $this->nom_etud;  
  }

  public function __construct($ine = NULL, $pwd = NULL, $nom = NULL, $prenom = NULL, $mail = NULL, $promo = NULL) {
    if (!is_null($ine) && !is_null($pwd) && !is_null($nom) && !is_null($prenom) && !is_null($mail) && !is_null($promo)) {
      $this->id_etudiant = $ine;
      $this->pwd_etud = $pwd;
      $this->nom_etud = $nom;
      $this->prenom_etud = $prenom;
      $this->mail_etud = $mail;
      $this->id_promo = $promo;
      /*
      $this->tabAtt = array (
					"mail"  => $this->mailUser,
					"name" => $this->nameUser,
					"pwd" => $this->pwdUser,
				);
      */
    }
  }

	public static function checkPassword($login,$mot_de_passe_crypte){

    $check = false;
	  $sql = "SELECT * FROM Etudiant WHERE mail_etud = :user AND pwd_etud = :pwd";

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
    $sql = "SELECT mail_etud FROM Etudiant WHERE mail_etud= :mail;";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute(array(':mail'=>$mail));
    return ($req_prep->rowCount()!=0);
  }

  public static function isMailFormat($mail){
    return preg_match("#^[a-z0-9._-]{1,}@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$mail);
  }

  public static function getINE($mail){
    $sql =  "SELECT id_etudiant ".
            "FROM ". static::$table." ".
            "WHERE mail_etud = :mail;";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute(array(':mail'=>$mail));
    $row = $req_prep->fetch(PDO::FETCH_ASSOC);

    return $row;        
  }

/*
  function delete(){
    Model::delete($this->modele);
  }
  */
}
?>
