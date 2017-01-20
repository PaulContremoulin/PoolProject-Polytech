<?php
require_once ("model.php"); 

class ModelPromo extends Model {
	private $id_section;
	private $id_promo;
	private $annee;
	private $mdp_test;

	protected static $table = 'Promo';
  	protected static $primary = 'id_promo';

//Constructeur de ModelPromo : 
  	public function __construct($section , $promo, $annee1, $mdp) {
	      $this->$id_section = $section;
	      $this->$id_promo = $promo;
	      $this->$annee=$annee1;
	      $this->$mdp_test = $mdp;
	}

//Getteurs:
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

/**Données : idpromo, mdp, idsection
	Résulat : Booléen, renvoir True si le mot de masse rentré en paramètre correspond au mot de passe de la section et promo correspondante **/
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

// Résulats : table qui contient : mdp , annee, libellé de la section de la promo //
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

	/** Donnée : id_promo
		Résultat : mot de passe correspondant à l'id_promo **/
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

/**Données : mdp, idpromo
	Résultat : mis à jour du mot de passe la promo ayant l'idée promo correspondant par le mot de passe mis en paramètre de la fonction **/
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

/** Donnée : idpromo
	Résultat : idsection correspondant à l'idpromo rentré en paramètre **/
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