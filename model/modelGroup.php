<?php

require_once ("model.php");

class ModelGroup extends Model {
  private $idGroup;
  protected static $table = 'Groupe';
  protected static $primary = 'id_group';

  public function getidGroup(){
    return $this->$idGroup;
  }

  public function __construct($numGroup){
      $this.setidGroup($numGroup);
  }

  public function setidGroup($numGroup){
    if(!is_null($numGroup)){
      $this->$idGroup = $numGroup;
    }
  }
}
?>
