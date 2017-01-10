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
      $tab_resultats[$key] = (($tab_resultats_ids[ModelProfil::retrieve_id2($key)] * 100)/72);
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
      $liste_etudiants = ModelEtudiant::getEtud_by_promo($id_promo);
      print_r($liste_etudiants);
      $tab_resultats_promo = array("realiste"=>0 ,"investigatif"=>0 ,"artistique" => 0, "social" => 0, "entrepreneur" => 0, "conventionnel" => 0);
      if(is_array($liste_etudiants)){
        foreach ($liste_etudiants as $etudiant) {
        $tab_reponse = select_by_num_user($etudiant["ine"]);
        $tab_intermediaire = calcul_result_etud($tab_reponse);
        $tab_resultats_promo["realiste"] = $tab_resultats_promo["realiste"] + $tab_intermediaire["realiste"];
        $tab_resultats_promo["investigatif"] = $tab_resultats_promo["investigatif"] + $tab_intermediaire["investigatif"];
        $tab_resultats_promo["artistique"] = $tab_resultats_promo["artistique"] + $tab_intermediaire["artistique"];
        $tab_resultats_promo["social"] = $tab_resultats_promo["social"] + $tab_intermediaire["social"];
        $tab_resultats_promo["entrepreneur"] = $tab_resultats_promo["entrepreneur"] + $tab_intermediaire["entrepreneur"];
        $tab_resultats_promo["conventionnel"] = $tab_resultats_promo["conventionnel"] + $tab_intermediaire["conventionnel"];
      }
      $tab_resultats_promo["realiste"] = $tab_resultats_promo["realiste"]/count($liste_etudiants);
      $tab_resultats_promo["investigatif"] = $tab_resultats_promo["investigatif"]/count($liste_etudiants);
      $tab_resultats_promo["artistique"] = $tab_resultats_promo["artistique"]/count($liste_etudiants);
      $tab_resultats_promo["social"] = $tab_resultats_promo["social"]/count($liste_etudiants);
      $tab_resultats_promo["entrepreneur"] = $tab_resultats_promo["entrepreneur"]/count($liste_etudiants);
      $tab_resultats_promo["conventionnel"] = $tab_resultats_promo["conventionnel"]/count($liste_etudiants);
      return $tab_resultats_promo;
    }
    else{
      print("not an array");
      return 0;
    }
    }
      

   /* 
    public function calcul_result_departement($id_section){
      $liste_etudiants = ModelEtudiant::getEtud_by_section($id_section);
      $tab_resultats_section = array("realiste"=>0 ,"investigatif"=>0 ,"artistique" => 0, "social" => 0, "entrepreneur" => 0, "conventionnel" => 0);
      foreach ($liste_etudiants as $etudiant){
        $tab_intermediaire = calcul_result_etud($tab_reponse);
        $tab_reponse = select_by_num_user($etudiant["ine"]);
        $tab_resultats_section["realiste"] = $tab_resultats_section["realiste"] + $tab_intermediaire["realiste"];
        $tab_resultats_section["investigatif"] = $tab_resultats_section["investigatif"] + $tab_intermediaire["investigatif"];
        $tab_resultats_section["artistique"] = $tab_resultats_section["artistique"] + $tab_intermediaire["artistique"];
        $tab_resultats_secton["social"] = $tab_resultats_section["social"] + $tab_intermediaire["social"];
        $tab_resultats_section["entrepreneur"] = $tab_resultats_section["entrepreneur"] + $tab_intermediaire["entrepreneur"];
        $tab_resultats_section["conventionnel"] = $tab_resultats_section["conventionnel"] + $tab_intermediaire["conventionnel"];
      }
      $tab_resultats_section["realiste"] = $tab_resultats_section["realiste"]/count($liste_etudiants);
      $tab_resultats_section["investigatif"] = $tab_resultats_section["investigatif"]/count($liste_etudiants);
      $tab_resultats_section["artistique"] = $tab_resultats_section["artistique"]/count($liste_etudiants);
      $tab_resultats_section["social"] = $tab_resultats_section["social"]/count($liste_etudiants);
      $tab_resultats_section["entrepreneur"] = $tab_resultats_section["entrepreneur"]/count($liste_etudiants);
      $tab_resultats_section["conventionnel"] = $tab_resultats_section["conventionnel"]/count($liste_etudiants);
      return $tab_resultats_section;
      }*/
  }
?>

