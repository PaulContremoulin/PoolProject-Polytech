<?php

require_once ("model.php"); 
require_once ("modelProfil.php");

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

  /**
  * Sélectionner les reponses d'un user
  * @return Array Les reponses pour chaque groupes de reponse du user
  **/
  public static function select_by_num_user($ine){
     $sql = 'SELECT id_groupe, choix_1, choix_2, choix_3 FROM '.static::$table.' WHERE id_etud = "'.$ine.'";';
    try{  
      $req_prep = Model::$pdo->prepare($sql);
      $req_prep->execute();
      $result = $req_prep->fetchAll();
      return $result;
    }
    catch(PDOException $e){
      echo($e->getMessage());
      die("<br> Erreur lors de la recherche des reponse de l'utilisateur  " . $this->table);
    }
  }


  public static function calcul_result_etud($tab_reponse){

    $realiste = ModelProfil::retrieve_id2('REALISTE');
    $investigatif = ModelProfil::retrieve_id2('INVESTIGATIF');
    $artistique = ModelProfil::retrieve_id2('ARTISTIQUE');
    $social = ModelProfil::retrieve_id2('SOCIAL');
    $entrepreneur = ModelProfil::retrieve_id2('ENTREPRENEUR');
    $conventionnel = ModelProfil::retrieve_id2('CONVENTIONNEL');

    $tab_resultats = array("REALISTE"=>0 ,"INVESTIGATIF"=>0 ,"ARTISTIQUE" => 0, "SOCIAL" => 0, "ENTREPRENEUR" => 0, "CONVENTIONNEL" => 0);
    $tab_resultats_ids = array($realiste=>0 ,$investigatif=>0 ,$artistique => 0, $social => 0, $entrepreneur => 0, $conventionnel => 0);

    foreach($tab_reponse as $reponse){
      $tab_resultats_ids[$reponse["choix_1"]]+=3;
      $tab_resultats_ids[$reponse["choix_2"]]+=2;
      $tab_resultats_ids[$reponse["choix_3"]]+=1;
    }

    foreach($tab_resultats as $key => &$values){
      $values = (($tab_resultats_ids[ModelProfil::retrieve_id2($key)] * 100)/72);
    }

    return $tab_resultats;
  }



}
?>
