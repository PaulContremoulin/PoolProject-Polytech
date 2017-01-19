<?php

require_once ("model.php");

 /** Classe représentant la table des groupes de questions. Tout ce qui sera relatif à cette table devra être implementé ici. C'est une classe qui peut utiiser les fonctions declarées dans la Classe modèle car elle en hérite **/
class ModelGroupe extends Model {
  /** Ici sont déclarées les attributs de la table Groupe. Lors de la construction d'une instance de cette table ces données seront amenées à être modifiées **/
  protected $id_group;
  protected static $table = 'Groupe';
  protected static $primary = 'id_group';

  //procédure de création d'un groupe
  public function __construct($idG = NULL){
    if (!is_null($idG)){
      $this->$id_group = $idG;
    }
  }
  //récupère l'id du groupe de questions
  // getIdGroupe : -> VARCHAR
  public function getIdGroupe(){
    return $this->id_group;
  }

  //Recupère les réponses et leurs ids associé à l'object group courant
  // getAnswer : -> [VARCHAR * VARCHAR * TEXT] * Int
  public function getAnswers(){

      $sql =  "SELECT id_reponse AS idr, id_profil AS idp, text_reponse AS libelle ".
              "FROM ".static::$table.", Reponse ".
              "WHERE ".static::$table.".id_group = Reponse.id_group ".
              "AND ".static::$table.".".static::$primary." = ".$this->id_group." ".
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
