<?php
/** On a besoin du fichier pour pouvoir utiliser la classe model qui y à été définie **/
require_once ("model.php"); 

/** Classe représentant la table des administrateurs. Tout ce qui sera relatif a cette table devras être implementée ici. C'est ine classe qui peut utiiser les fonctions declarée dans la Classe modèle car elle en hérite **/
class ModelAdmin extends Model {
  /** Ici sont déclarées les attributs de la table AdministrateuR. Lors de la construction d'un instance de cette table ces données seront amenées à être modifiées **/
  private $mail_admin;
  private $nom_admin;
  private $mdp_admin;
  private $prenom_admin;
  private $id_admin;

  protected static $table = 'Admin';
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


  /** Procedure de construction d'un "admin" **/
  public function __construct($mail = NULL, $pwd = NULL, $name = NULL) {
    if (!is_null($mail) && !is_null($pwd) && !is_null($name) && !is_null($admin)) {
      $this->mail_admin = $mail;
      $this->mdp_dmin = $pwd;
      $this->nom_admin = $name;
    }
  }

  /** Permet de verifier si le mot de passe passé en paramètre est bien celui de l'administrateur dont le login est aussi passé en paramètre 

  * checkPassword : VARCHAR * VARCHAR -> bool
  **/
	public static function checkPassword($login,$mot_de_passe_crypte){

    $check = false;
    $sql = "SELECT * FROM Admin WHERE id_admin = :login AND mdp_admin = :pwd";

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

  /** Permet de verifier si le mail passé en paramètre existe bien dans la table des administrateurs de la base de données 
  * 
  **/
  public static function mailExist($mail){
    $sql = "SELECT mail_admin FROM Admin WHERE mail_admin= :mail;";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute(array(':mail'=>$mail));
    return ($req_prep->rowCount()!=0);
  }

  /** Recupération de l'email indexé par le parametre
  * getEmail : VARCHAR -> ['VARCHAR'](1)
  */
  public static function getEmail($ine){
    $sql = "SELECT mail_admin FROM Admin WHERE id_admin= :ine;";
     $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute(array(':ine'=>$ine));
     $row = $req_prep->fetch(PDO::FETCH_ASSOC);
    return $row['mail_admin'];        
  }

  /** Verification du paramètre pour qu'il soit de type email
  * isMailFormat : VARCHAR -> bool
  * True si le maail est un format email False sinon
  **/
  public static function isMailFormat($mail){
    return preg_match("#^[a-z0-9._-]{1,}@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$mail);
  }

  /**
  * Recupere l'id d'un administrateur indexé par l'email passé en parametre
  * getID : VARCHAR -> VARCHAR
  **/
  public static function getID($mail){
    $sql =  "SELECT id_admin ".
            "FROM ". static::$table." ".
            "WHERE mail_admin = :mail;";
    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute(array(':mail'=>$mail));
    $row = $req_prep->fetch(PDO::FETCH_ASSOC);
    return $row['id_admin'];        
  }

  /** Recupere la liste de toutes les instances d'admins presentes dans la base de données
  * getAdmins : -> [Admins]
  **/
   public static function getAdmins(){
    $sql = "SELECT * ".
           "FROM ". static::$table." ;";

    $req_prep = Model::$pdo->prepare($sql);
    $req_prep->execute();
    $row = $req_prep->fetchAll();
    return $row;
  }

}

?>
