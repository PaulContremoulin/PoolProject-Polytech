<?php

require_once ("model.php");

class ModelReponse extends Model {
  private $id_reponse;
  private $id_profil;
  private $text_rep;
  private $id_group;

  protected static $table = 'Reponse';
  protected static $primary = 'id_reponse';

  public static function get_id_reponse(){
    return $this->$id_reponse;
  }

  public static function get_id_profil(){
    return $this->$id_profil;
  }

  public static function get_text_reponse(){
    return $this->$text_rep;
  }

  public static function get_id_group(){
    return $this->$id_group;
  }

  public function __construct($num_reponse,$num_profil,$text,$num_group){
    $this->$id_reponse = $num_reponse;
    $this->$id_profil = $num_profil;
    $this->$text_rep = $text;
    $this->$id_group = $num_group;
  }

  public static function get_all_reponseG($num_group){
    $sql = "SELECT * FROM Reponse WHERE id_group = :idGroup";

	  try{

		  $req_prep = Model::$pdo->prepare($sql);
		  $req_prep->bindParam(":idGroup", $num_group);
		  $req_prep->execute();
      $result = $req_prep->fetch(PDO::FETCH_ASSOC);
      return $result;

	  } catch(PDOException $e) {
		  echo 'Get failed: ' . $e->getMessage();
	  }
  }

  public static function get_all_reponseP($num_profil){
    $sql = "SELECT * FROM Reponse WHERE id_profil = :idProfil";

	  try{

		  $req_prep = Model::$pdo->prepare($sql);
		  $req_prep->bindParam(":idProfil", $num_profil);
		  $req_prep->execute();
      $result = $req_prep->fetch(PDO::FETCH_ASSOC);
      return $result;

	  } catch(PDOException $e) {
		  echo 'Get failed: ' . $e->getMessage();
	  }
  }


}

$result = ModelReponse::get_all_reponseP(1);
$result1 = ModelReponse::get_all_reponseG(1);
print_r($result);
print_r($result1);
