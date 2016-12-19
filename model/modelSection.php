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
    $sql =  "SELECT id_promo, annee, id_section, libelle_section ".
            "FROM ".static::$table.", Promo ".
            "WHERE Section.id_section = Promo.id_section ".
            "ORDER BY Section.id_section ASC;";
    try{

      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute();

      $temoin_s = -1;
      $id = 0;
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
          $id = 0;
        }

        $sections[$s][1][$id] = $p;
        $sections[$s][2][$id] = $ligne['annee'];
        $id++;
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
