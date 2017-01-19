<?php

require_once ("model.php"); 

class ModelSection extends Model {

  private $id_section;
  private $libelle_section;
  private $num_section;

  protected static $table = 'Section';
  protected static $primary = 'id_section';
  protected static $annee= "annee";
   

  public function __construct($section = NULL, $libelle = NULL, $annee = NULL) {
    if (!is_null($section) && !is_null($libelle)) {
      $this->$id_section = $section;
      $this->$libelle_section = $libelle;
      $this->$num_section = $annee;
    }
  }


  /*
  * noms_sections() Retourne le noms de toutes les sections contenues dans la base de données
  *
  */
  public static function ids_sections(){

    $sql = "SELECT id_section FROM ".static::$table.";";

    try{

      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute();
      return $req_prep->fetchAll(PDO::FETCH_ASSOC);

    } catch(PDOException $e) {

      echo $e->getMessage();

    }

  }


  /*
  * listeSection() : Liste toutes les sections contenues dans la base de données
  *
  * return : Tableau de tableaux contenant les promos et l'année de la promo rangés par sections
  *  
  * $section[$ids][0] -> nom de la section
  * $section[$ids][1] -> nom de la promo
  * $section[$ids][2] -> année de la promo
  * où $ids correspond à l'identifiant de la section
  */
  public static function listeSections(){
    $sql =  "SELECT id_promo, annee, Section.id_section AS id_section, libelle_section ".
            "FROM ".static::$table.", Promo ".
            "WHERE Section.id_section = Promo.id_section ".
            "ORDER BY Section.id_section ASC, annee ASC;";
    try{

      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute();

      $temoin_s = "id_sec";
      $idp = 0;
      $sections = array();

      while($ligne = $req_prep->fetch(PDO::FETCH_ASSOC)){

        $s = $ligne['id_section'];
        $p = $ligne['id_promo'];

        if($temoin_s != $s){
          $sections[$s] = array();
          $sections[$s][0] = $ligne['libelle_section'];
          $sections[$s][1] = array();
          $sections[$s][2] = array();
          $temoin_s = $s;
          $idp = 0;
        }

        $sections[$s][1][$idp] = $p;
        $sections[$s][2][$idp] = $ligne['annee'];
        $idp++;
      }

      return $sections;

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

  }

}


?>
