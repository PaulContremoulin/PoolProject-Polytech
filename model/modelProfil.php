
<?php

require_once ("model.php"); 

class ModelUser extends Model {
	private $id_profil;
	private $libelle_profil;
	protected static $table = 'Profil';
  	protected static $primary = 'id_profil';

  	public function __construct($idprofil,$libelle){
  		$this->$id_profil = $idprofil;
  		$this->$libelle_profil = $libelle;
  	}

  	public function get_idprofil(){
  		return $this->$id_profil;
  	}

  	public function get_libelle(){
  		return $this->$libelle_profil;
  	}

  	public static function retrieve_libelle($idprofil){
  		$sql = "SELECT libelle_profil from".static::$table."WHERE id_profil = ".$id_profil;
  		try{

		  $req_prep = Model::$pdo->prepare($sql);
		  $req_prep->bindParam(":user", $login);
		  $req_prep->bindParam(":pwd", $mot_de_passe_crypte);
		  $req_prep->execute();

      	  return $req_prep;

	  } catch(PDOException $e) {
		  echo 'retrieve failed: ' . $e->getMessage();		  
	  }
  	}

  	public static function retrieve_libelle2($libelle){
  		$sql = "SELECT id_profil from".static::$table."WHERE libelle_profil LIKE ".$libelle;
  		try{

		  $req_prep = Model::$pdo->prepare($sql);
		  $req_prep->bindParam(":user", $login);
		  $req_prep->bindParam(":pwd", $mot_de_passe_crypte);
		  $req_prep->execute();

      	  return $req_prep;

	  } catch(PDOException $e) {
		  echo 'retrieve failed: ' . $e->getMessage();		  
	  }
  	}
}


?>