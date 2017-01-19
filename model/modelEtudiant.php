<?php

require_once ("model.php"); 
 
 /** Classe représentant la table des etudiants. Tout ce qui sera relatif a cette table devras être implementée ici. C'est ine classe qui peut utiiser les fonctions declarée dans la Classe modèle car elle en hérite **/
class ModelEtudiant extends Model {
  /** Ici sont déclarées les attributs de la table Etudiant. Lors de la construction d'un instance de cette table ces données seront amenées à être modifiées **/
  private $id_etudiant;
  private $pwd_etud;
  private $nom_etud;
  private $prenom_etud;
  private $mail_etud;
  private $id_promo;

  protected static $table = 'Etudiant';
  protected static $primary = 'id_etudiant';
   
  //un getter

  // Fonction qui permet de recuperer le mail de l'étudiant
  // getMail : -> VARCHAR 
  public function getMail() {
       return $this->mail_mail;  
  }
  
  //fonction qui permet de recuperer le mot de passe de l'étudiant
  // getPwd : -> VARCHAR
  public function getPwd() {
       return $this->pwd_etud;  
  }
 
 //Fonction qui permet de recuperer le nom de l'étudiant
 // getName : -> VARCHAR
  public function getName() {
       return $this->nom_etud;  
  }

//Procedure de construction d'un etudiant
// _construct : VARCHAR * VARCHAR * VARCHAR * VARCHAR * VARCHAR * INT -> ETUDIANT
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

//Fonction qui permet de verifier a partir du login et du mot de passe crypte si celui est correcte ou non
// checkPassword : VARCHAR *  -> bool
	public static function checkPassword($login,$mot_de_passe_crypte){

    $check = false;
	  $sql = "SELECT * FROM Etudiant WHERE id_etudiant = :login AND pwd_etud = :pwd";

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

//Fonction qui permet de verifier si le mail passé en paramètre existe deja 
// mailExist : VARCHAR -> bool
  public static function mailExist($mail){
    $sql = "SELECT mail_etud FROM Etudiant WHERE mail_etud= :mail;";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute(array(':mail'=>$mail));
    return ($req_prep->rowCount()!=0);
  }

//fonction qui permet de verifier si l'ine de l'étudiant passe en paramètre existe deja 
// ineExist : VARCHAR -> bool
  public static function ineExist($ineEtudiant){
    $sql = "SELECT id_etudiant FROM Etudiant WHERE id_etudiant= :ine;";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute(array(':ine'=>$ineEtudiant));
    return ($req_prep->rowCount()!=0);
  }

//Fonction qui permet de verifier le format de l'email
// isMailFormat : VARCHAR -> bool
  public static function isMailFormat($mail){
    return preg_match("#^[a-z0-9._-]{1,}@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$mail);
  }

//Fonction qui permet de recuperer l'ine de l'étudiant a partir du mail 
// getINE : VARCHAR -> VARCHAR
  public static function getINE($mail){
    $sql =  "SELECT id_etudiant ".
            "FROM ". static::$table." ".
            "WHERE mail_etud = :mail;";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute(array(':mail'=>$mail));
    $row = $req_prep->fetch(PDO::FETCH_ASSOC);

    return $row['id_etudiant'];        
  }

//Fonction qui permet de recuperer la promo de l'étudiant grace a l'ine
// getPromo : VARCHAR -> INT
  public static function getPromo($ine){
    $sql =  "SELECT id_promo ".
            "FROM ". static::$table." ".
            "WHERE id_etudiant = :ine;";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute(array(':ine'=>$ine));
    $row = $req_prep->fetch(PDO::FETCH_ASSOC);

    return $row['id_promo'];        

  }

//Fonction qui permet de recuperer la liste des étudiants qui ont le meme identifiant de promo
//getEtud_by_promo : INT -> 
  public static function getEtud_by_promo($id_promo){
     $sql = "SELECT id_etudiant FROM ".static::$table.", Promo WHERE Etudiant.id_promo = Promo.id_promo AND Promo.id_promo = :idpromo; ";
     $req_prep = Model::$pdo->prepare($sql);
     $req_prep->execute(array(':idpromo'=>$id_promo));
     $result = $req_prep->fetchAll();
     return $result;
  } 

//Fonction qui permet de recuperer la liste des étudiants qui ont le meme identifiant de section
// getEtud_by_section : VARCHAR -> 
  public static function getEtud_by_section($id_section){
    $sql = "SELECT * FROM ".static::$table.", Promo WHERE Etudiant.id_promo = Promo.id_promo and Promo.id_section = :idsection;";
    try{
      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute(array(':idsection'=>$id_section));
      $result = $req_prep->fetchAll();
      return $result;
    } catch(PDOException $e) {
        echo ' Echec recupération: ' . $e->getMessage();     
    }


  }

/*
  function delete(){
    Model::delete($this->modele);
  }
  */
}
?>
