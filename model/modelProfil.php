
<?php

require_once ("model.php"); 

class ModelProfil extends Model {

	private $id_profil;
	private $libelle_profil;
	protected static $table = 'Profil';
  	protected static $primary = 'id_profil';

  	public function __construct($idp = NULL, $lib = NULL){
      if (!is_null($idp) && !is_null($lib)){
        $this->id_profil = $idp;
        $this->libelle_profil = $lib;
      }
  	}

  	public function get_idprofil(){
  		return $this->id_profil;
  	}

  	public function get_libelle(){
  		return $this->libelle_profil;
  	}

    public static function retrieve_id2($libelle){
      $sql = "SELECT id_profil FROM ".static::$table." WHERE libelle_profil LIKE '".$libelle."';";
      try{
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute();
        $rslt = $req_prep->fetchColumn();
        return $rslt;
      } catch(PDOException $e) {
        echo 'retrieve failed: ' . $e->getMessage();      
      }
    }

}


?>