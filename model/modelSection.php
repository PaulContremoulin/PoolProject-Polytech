<?php

require_once ("model.php"); 

class ModelSection extends Model {

  private $id_section;
  private $libelle_section;

  protected static $table = 'Section';
  protected static $primary = 'id_section';
   

  public function __construct($section = NULL, $libelle = NULL) {
    if (!is_null($section) && !is_null($libelle)) {
      $this->id_section = $section;
      $this->libelle_section = $libelle;
      /*
      $this->tabAtt = array (
					"mail"  => $this->mailUser,
					"name" => $this->nameUser,
					"pwd" => $this->pwdUser,
				);
      */
    }
  }

  public static function listeSections(){
    $sql =  "SELECT id_promo, annee, Section.id_section AS id_section, libelle_section ".
            "FROM ".static::$table.", Promo ".
            "WHERE Section.id_section = Promo.id_section ".
            "ORDER BY Section.id_section ASC;";
    try{

      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute();

      $temoin_s = "id_sec";
      $ids = -1;
      $idp = 0;
      $sections = array();

      while($ligne = $req_prep->fetch(PDO::FETCH_ASSOC)){

        $s = $ligne['id_section'];
        $p = $ligne['id_promo'];

        if($temoin_s != $s){
          $ids++;
          $sections[$ids] = array();
          $sections[$ids][0] = array();
          $sections[$ids][0][0] = $s;
          $sections[$ids][0][1] = $ligne['libelle_section'];
          $sections[$ids][1] = array();
          $sections[$ids][2] = array();
          $temoin_s = $s;
          $idp = 0;
        }

        $sections[$ids][1][$idp] = $p;
        $sections[$ids][2][$idp] = $ligne['annee'];
        $idp++;
      }

      return $sections;

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

  }
/*
  function delete(){
    Model::delete($this->modele);
  }
  */
}
?>
