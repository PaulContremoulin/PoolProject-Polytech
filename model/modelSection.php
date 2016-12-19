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
    $sql =  "SELECT id_section, libelle_section ".
            "FROM ".static::$table." ".
            "ORDER BY id_section ASC;";
    try{

      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute();

      $sections = array();

      while($ligne = $req_prep->fetch(PDO::FETCH_ASSOC)){
        $sections[$ligne['id_section']] = $ligne['libelle_section'];
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
