<?php

require_once ("model.php");

class ModelGroupe extends Model {

  private $idGroup;
  protected static $table = 'Groupe';
  protected static $primary = 'id_group';

  public function getidGroup(){
    return $this->$idGroup;
  }


  public function __construct($idG = NULL){
    if (!is_null($idG)){
      $this->idGroup = $idG;
    }
  }

  //Recupère les réponses et leurs ids associé à l'object group courant
  public function getAnswers(){

      $sql =  "SELECT id_reponse AS idr, id_profil AS idp, text_reponse AS libelle ".
              "FROM ".static::$table.", Reponse ".
              "WHERE ".static::$table.".id_group = Reponse.id_group ".
              "AND ".static::$table.".".static::$primary." = ".$idGroup." ".
              "ORDER BY id_reponse ASC;"; // afinir
      try{
          $req_prep = Model::$pdo->prepare($sql);
          $req_prep->execute();
          $result = $req_prep->fetchAll();
          return $result;
      } catch(PDOException $e) {
        echo 'getAnswers() failed: ' . $e->getMessage();     
      }
  }
}
?>
