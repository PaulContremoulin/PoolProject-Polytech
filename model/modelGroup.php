<?php

require_once ("model.php");

class ModelGroup extends Model {

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
  public function getAnwsers(){

      $sql =  "SELECT id_reponse AS idr, id_profil AS idp, text_reponse AS libelle ".
              "FROM ".static::$table.", Reponse ".
              "WHERE ".static::$table.".id_group = Reponse.id_group ".
              "AND ".static::$table.".".static::$primary." = ".$idGroup." "
              "ORDER BY id_reponse ASC;"; // afinir
  }
?>
