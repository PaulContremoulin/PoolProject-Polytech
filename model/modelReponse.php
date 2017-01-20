<?php

require_once ("model.php");

class ModelReponse extends Model {
  private $id_reponse;
  private $id_profil;
  private $text_rep;
  private $id_group;

  protected static $table = 'Reponse';
  protected static $primary = 'id_reponse';

//Getteurs : 
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

//Constructeur : 
  public function __construct($num_reponse = NULL,$num_profil = NULL,$text = NULL,$num_group = NULL){
    if (!is_null($num_reponse) && !is_null($num_profil) && !is_null($text) && !is_null($num_group)){
      $this->$id_reponse = $num_reponse;
      $this->$id_profil = $num_profil;
      $this->$text_rep = $text;
      $this->$id_group = $num_group;
    }
  }

  public static function get_all_reponse(){
    //Retourne un tableau contenant toutes les réponses rangées en tableau

    try{
      //Récupère le nomrbre de groupe de question
      $sql_grps = "SELECT * FROM Groupe;";
      $req_grps = Model::$pdo->prepare($sql_grps);
      $req_grps->execute();
      $nb_grps = $req_grps->rowCount();

      $tab_grps = array();
      //Pour le nombre de groupe, on récupère toutes les réponses
      for ($i=1; $i <= $nb_grps; $i++) { 

        $tab_rlts = self::get_all_reponse_Groupe($i);
        $tab_grps[$i] = $tab_rlts;
      }

      return $tab_grps;

    }catch(PDOException $e) {
      echo 'Get failed: ' . $e->getMessage();
    }
  }


/** Donnée : numgroup
  Résultat : tableau contenant idreponse, idgroupe et textreponse correspondant au numéro de groupe passé en paramètre**/
  public static function get_all_reponse_Groupe($num_groupe){

    $sql_rlts = "SELECT id_reponse AS idr, id_group AS idg, text_reponse AS txt ";
    $sql_rlts .= "FROM ".static::$table." ";
    $sql_rlts .= "WHERE id_group = :idgroupe ";

	  try{

		  $req_prep = Model::$pdo->prepare($sql_rlts);
		  $req_prep->bindParam(":idgroupe", $num_groupe);
		  $req_prep->execute();
      $result = $req_prep->fetchAll();
      return $result;

	  } catch(PDOException $e) {
		  echo 'Get failed: ' . $e->getMessage();
	  }
  }

/** Donnée : numprofil
    Résulat : retourne les éléments de la table réponse dont l'idProfil correspond au num_profil passé en paramètre de la fonction**/
  public static function get_all_reponse_Profil($num_profil){
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
