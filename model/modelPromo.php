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

	public static function getall(){
		$sql = "SELECT Promo.id_section,Promo.mdp_test, Promo.annee, Section.libelle_section FROM ".static::$table.", Section WHERE Promo.id_section = Section.id_section ;" ;

		try{

	      $req_prep = Model::$pdo->prepare($sql);
	      $req_prep->execute();
	      return $req_prep;

	  	}catch(PDOException $e) {
		  echo 'Get failed: ' . $e->getMessage();
	  }

	}


	public static function recupMDP($idpromo){
 		$sql = "SELECT mdp_test FROM ".static::$table." WHERE id_promo = :idpromo ;";

		try{

	      $req_prep = Model::$pdo->prepare($sql);
	      $req_prep->bindParam(':idpromo',$idpromo);
	      $req_prep->execute();
	      $result =  $req_prep->fetch();
	      return $result;

	  	} catch(PDOException $e) {
		  echo 'Get failed: ' . $e->getMessage();
	  }

	}

	public static function set_mdp_test($mdp,$idpromo){
		$sql = "UPDATE ".static::$table." SET mdp_test = :mdp WHERE id_promo = :idpromo ;";

		try{

	      $req_prep = Model::$pdo->prepare($sql);
	      $req_prep->bindParam(':mdp',$mdp);
	      $req_prep->bindParam(':idpromo',$idpromo);
	      $req_prep->execute();

	  	} catch(PDOException $e) {
		  echo 'Set failed: ' . $e->getMessage();
	  }
	}

	public static function get_id_section($id_promo){
		$sql = "SELECT id_section FROM ".static::$table." WHERE id_promo = ".$id_promo.";";
		try{
	      $req_prep = Model::$pdo->prepare($sql);
	      $req_prep->execute();

	  	} catch(PDOException $e) {
		  echo 'Set failed: ' . $e->getMessage();
	  }
	}

}
?>