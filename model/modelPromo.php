<?php
require_once ("model.php"); 

class ModelPromo extends Model {
	private $id_section;
	private $id_promo;
	private $annee;
	private $mdp_test;

	protected static $table = 'Promo';
  	protected static $primary = 'id_promo';

  	
  	public function __construct($section , $promo, $annee1, $mdp) {
	      $this->$id_section = $section;
	      $this->$id_promo = $promo;
	      $this->$annee=$annee1;
	      $this->$mdp_test = $mdp;
	}

	public static function get_idsection(){
		return $this->$id_section;
	}

	public static function get_idpromo(){
		return $this->$id_promo;
	}

	public static function get_annee(){
		return $this->$annee;
	}

	public static function get_mdptest(){
		return $this->$mdp_test;
	}

	public static function checkMDP($idpromo,$mdp,$idsection){
 		$sql = "SELECT mdp_test FROM".static::$table." WHERE $id_promo = ".$idpromo."AND".$id_section."= $idsection";

		try{

	      $req_prep = Model::$pdo->prepare($sql);
	      $req_prep->execute();

	      return $req_prep == $mdp;

	  	} catch(PDOException $e) {
		  echo 'Get failed: ' . $e->getMessage();
	  }

	}

	public static function recupMDP($idpromo,$idsection){
 		$sql = "SELECT mdp_test FROM ".static::$table." WHERE $id_promo = ".$idpromo."AND".$id_section."= $idsection";

		try{

	      $req_prep = Model::$pdo->prepare($sql);
	      $req_prep->execute();

	      return $req_prep;

	  	} catch(PDOException $e) {
		  echo 'Get failed: ' . $e->getMessage();
	  }

	}

	public static function set_mdp_test($mdp,$idpromo,$idsection){
		$sql = "UPDATE ".static::$table." SET mdp_test =".$mdp." WHERE $id_promo = ".$idpromo."AND".$id_section."= $idsection"

		try{

	      $req_prep = Model::$pdo->prepare($sql);
	      $req_prep->execute();

	  	} catch(PDOException $e) {
		  echo 'Set failed: ' . $e->getMessage();
	  }


	}

}

?>