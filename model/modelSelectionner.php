<?php

require_once ("model.php"); 

class ModelSelectionner extends Model {

  private $choix_1;
  private $choix_2;
  private $choix_3;
  private $id_groupe;
  private $id_etud;

  protected static $table = 'Selectionner';
  protected static $primary = '$id_etud;';
   
  public function __construct($c1 = NULL, $c2 = NULL, $c3 = NULL, $idg = NULL, $ide = NULL) {
    if (!is_null($c1) && !is_null($c2) && !is_null($c3) && !is_null($idg) && !is_null($ide)) {
      $this->choix_1 = $c1;
      $this->choix_2 = $c2;
      $this->choix_3 = $c3;
      $this->id_groupe = $idg;
      $this->id_etud = $ide;
    }
  }
}
?>
