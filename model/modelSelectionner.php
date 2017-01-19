<?php

require_once ("model.php"); 
require_once ("modelProfil.php");
require_once ("modelEtudiant.php");

class ModelSelectionner extends Model {

  private $choix_1;
  private $choix_2;
  private $choix_3;
  private $id_groupe;
  private $id_etud;

  protected static $table = 'Selectionner';
  protected static $primary = 'id_etud;';
   
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
      $tab_resultats[$key] = round((($tab_resultats_ids[ModelProfil::retrieve_id2($key)] * 100)/72),PHP_ROUND_HALF_UP);
    }

    return $tab_resultats;
  }



    public function set_answers_user($ine,$id_groupe,$choix1,$choix2,$choix3){
       $sql = 'UPDATE'.static::$table.' SET choix1 ='.$choix1.',choix2 ='.$choix2.',choix3 ='.$choix3.' WHERE id_etudiant ='.$ine.' AND id_groupe = '.$id_groupe;
      try{
       
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute();
        $result = $req_prep->fetchAll();
        return $result;
      }
      catch(PDOException $e){
        echo($e->getMessage());
        die("<br> Erreur lors de la modification des reponses de l'utilisateur  " . $this->table);
      }
    }


   /**
    * Modificateur du 1er choix d'un utilisateur par rapport à un groupe
    * @param ine Int : c'est l'identifiant de l'utilisateur
    * @param id_groupe Int : c'est l'identifiant du groupe auquel appartient la réponse
    * @param choix1 Int : c'est le profil auquel appartient la réponse sélectionnée par l'utilisateur
    **/
    public function set_answers1_user($ine,$id_groupe,$choix1){
       $sql = 'UPDATE'.static::$table.' SET choix1 ='.$choix1.' WHERE id_etudiant ='.$ine.' AND id_groupe = '.$id_groupe;
      try{
       
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute();
      }
      catch(PDOException $e){
        echo($e->getMessage());
        die("<br> Erreur lors de la modification de la reponse 1 de l'utilisateur  " . $this->table);
      }
    }


    /**
    * Modificateur du 2eme choix d'un utilisateur par rapport à un groupe
    * @param ine Int : c'est l'identifiant de l'utilisateur
    * @param id_groupe Int : c'est l'identifiant du groupe auquel appartient la réponse
    * @param choix2 Int : c'est le profil auquel appartient la réponse sélectionnée par l'utilisateur
    **/
    public function set_answers2_user($ine,$id_groupe,$choix2){
       $sql = 'UPDATE'.static::$table.' SET choix2 ='.$choix2.' WHERE id_etudiant ='.$ine.' AND id_groupe = '.$id_groupe;
      try{
       
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute();
      }
      catch(PDOException $e){
        echo($e->getMessage());
        die("<br> Erreur lors de la modification de la reponse 2 de l'utilisateur  " . $this->table);
      }
    }

    /**
    * Modificateur du 3eme choix d'un utilisateur par rapport à un groupe
    * @param ine Int : c'est l'identifiant de l'utilisateur
    * @param id_groupe Int : c'est l'identifiant du groupe auquel appartient la réponse
    * @param choix3 Int : c'est le profil auquel appartient la réponse sélectionnée par l'utilisateur
    **/
    public function set_answers3_user($ine,$id_groupe,$choix3){
       $sql = 'UPDATE'.static::$table.' SET choix3 ='.$choix3.' WHERE id_etudiant ='.$ine.' AND id_groupe = '.$id_groupe;
      try{
       
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute();
      }
      catch(PDOException $e){
        echo($e->getMessage());
        die("<br> Erreur lors de la modification de la reponse 3 de l'utilisateur  " . $this->table);
      }
    }

    public static function calcul_result_promo($id_promo){
      $nb_etudiant=0;
      $liste_etudiants = ModelEtudiant::getEtud_by_promo($id_promo);
      $tab_resultats_promo = array("REALISTE"=>0 ,"INVESTIGATIF"=>0 ,"ARTISTIQUE" => 0, "SOCIAL" => 0, "ENTREPRENEUR" => 0, "CONVENTIONNEL" => 0);
        foreach ($liste_etudiants as $etudiant) {
          $tab_reponse = ModelSelectionner::select_by_num_user($etudiant['id_etudiant']);
          if (count($tab_reponse)==12){
            $nb_etudiant=$nb_etudiant+1;
            $tab_intermediaire =  ModelSelectionner::calcul_result_etud($tab_reponse);
            $tab_resultats_promo["REALISTE"] = $tab_resultats_promo["REALISTE"] + $tab_intermediaire["REALISTE"];
            $tab_resultats_promo["INVESTIGATIF"] = $tab_resultats_promo["INVESTIGATIF"] + $tab_intermediaire["INVESTIGATIF"];
            $tab_resultats_promo["ARTISTIQUE"] = $tab_resultats_promo["ARTISTIQUE"] + $tab_intermediaire["ARTISTIQUE"];
            $tab_resultats_promo["SOCIAL"] = $tab_resultats_promo["SOCIAL"] + $tab_intermediaire["SOCIAL"];
            $tab_resultats_promo["ENTREPRENEUR"] = $tab_resultats_promo["ENTREPRENEUR"] + $tab_intermediaire["ENTREPRENEUR"];
            $tab_resultats_promo["CONVENTIONNEL"] = $tab_resultats_promo["CONVENTIONNEL"] + $tab_intermediaire["CONVENTIONNEL"];
          }
          
        }
        foreach($tab_resultats_promo as $key => &$values){
          $tab_resultats_promo[$key] = round($tab_resultats_promo[$key]/$nb_etudiant,PHP_ROUND_HALF_UP);
       }
      return $tab_resultats_promo;
    }
      


  public static function calcul_result_departement($id_section){
    $liste_etudiants = ModelEtudiant::getEtud_by_section($id_section);
    $nb_etudiant = count($liste_etudiants);
    $tab_resultats_section = array("REALISTE"=>0 ,"INVESTIGATIF"=>0 ,"ARTISTIQUE" => 0, "SOCIAL" => 0, "ENTREPRENEUR" => 0, "CONVENTIONNEL" => 0);
    if($nb_etudiant>0){
      foreach ($liste_etudiants as $etudiant){
        $tab_reponse =  ModelSelectionner::select_by_num_user($etudiant['id_etudiant']);
        if (count($tab_reponse)==12){
          $tab_intermediaire = ModelSelectionner::calcul_result_etud($tab_reponse);
          $tab_resultats_section["REALISTE"] = $tab_resultats_section["REALISTE"] + $tab_intermediaire["REALISTE"];
          $tab_resultats_section["INVESTIGATIF"] = $tab_resultats_section["INVESTIGATIF"] + $tab_intermediaire["INVESTIGATIF"];
          $tab_resultats_section["ARTISTIQUE"] = $tab_resultats_section["ARTISTIQUE"] + $tab_intermediaire["ARTISTIQUE"];
          $tab_resultats_secton["SOCIAL"] = $tab_resultats_section["SOCIAL"] + $tab_intermediaire["SOCIAL"];
          $tab_resultats_section["ENTREPRENEUR"] = $tab_resultats_section["ENTREPRENEUR"] + $tab_intermediaire["ENTREPRENEUR"];
          $tab_resultats_section["CONVENTIONNEL"] = $tab_resultats_section["CONVENTIONNEL"] + $tab_intermediaire["CONVENTIONNEL"];
        }
      }
      foreach($tab_resultats_section as $key => &$values){
        $tab_resultats_section[$key] = round($tab_resultats_section[$key]/$nb_etudiant,PHP_ROUND_HALF_UP);
      }
    }

    return $tab_resultats_section;
  }
}
?>

