<?php

  require_once("Model.php");
   require_once("modelEtudiant.php");
    require_once("modelProfil.php");

  class ModelSelectionner extends Model{
    protected $choix1;
    protected $choix2;
    protected $choix3;
    protected $id_etud;
    protected $id_select;
    protected $id_groupe;
    protected static $table  = "Selectionner";
    protected static $primary = 'id_select';


     /**
    * Constructeur d'une instance de la table Selectionner
    * @return Array avec tout les attribut de la table Selectionner
    **/
    public function __construct($id_slt=NULL,$ch1 = NULL, $ch2 = NULL, $ch3 = NULL, $id_etud=NULL, $id_gpe=NULL){
      if (!is_null($id_slt) and !is_null($choix1) and !is_null($choix2) and !is_null($choix3) and !is_null($id_etud) and !is_null($id_gpe)){
        $this->$id_select = $id_slt;
        $this->$choix1 = $ch1;
        $this->$choix2 = $ch2;
        $this->$choix3 = $ch3;
        $this->$id_etudiant = $id_etud;
        $this->$id_groupe = $id_gpe;
      }
    }

    /**
    * Modificateur de l'ensemble des reponses d'un utilisateur par rapport à un groupe
    * @param ine Int : c'est l'identifiant de l'utilisateur
    * @param id_groupe Int : c'est l'identifiant du groupe auquel appartient la réponse
    * @param choix1 Int : c'est le profil auquel appartient la réponse sélectionnée par l'utilisateur
    * @param choix2 Int : c'est le profil auquel appartient la réponse sélectionnée par l'utilisateur
    * @param choix3 Int : c'est le profil auquel appartient la réponse sélectionnée par l'utilisateur
    * 
    **/
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



    
    /**
    * Sélectionner les reponses d'un user
    * @return Array Les reponses pour chaque groupes de reponse du user
    **/
    public function select_by_num_user($ine){
       $sql = 'SELECT * FROM '.static::$table.' WHERE id_etudiant ='.$ine;
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

    /**
    * Sélectionner les reponses d'un user en fonction d'un groupe en particulier
    * @param ine Int : c'est l'identifiant de l'utilisateur
    * @param id_groupe Int : c'est l'identifiant du groupe auquel appartient la réponse
    * @return Array Les reponses de l'user pour le groupe passé en paramètre
    **/
    public function select_by_num_user($ine,$id_groupe){
       $sql = 'SELECT * FROM '.static::$table.' WHERE id_etudiant ='.$ine.' AND id_groupe = '.$id_groupe;
      try{
       
        $req_prep = Model::$pdo->prepare($sql);
        $req_prep->execute();
        $result = $req_prep->fetchAll();
        return $result;
      }
      catch(PDOException $e){
        echo($e->getMessage());
        die("<br> Erreur lors de la recherche des reponse de l'utilisateur par rapport au groupe  " . $this->table);
      }
    }


    public function calcul_result_etud($tab_reponse){
      $tab_resultats = array("realiste"=>0 ,"investigatif"=>0 ,"artistique" => 0, "social" => 0, "entrepreneur" => 0, "conventionnel" => 0, "INE" => 0);
      $realiste = ModelProfil::retrieve_id2('REALISTE');
      $investigatif = ModelProfil::retrieve_id2('INVESTIGATIF');
      $artistique = ModelProfil::retrieve_id2('ARTISTIQUE');
      $social = ModelProfil::retrieve_id2('SOCIAL');
      $entrepreneur = ModelProfil::retrieve_id2('ENTREPRENEUR');
      $conventionnel = ModelProfil::retrieve_id2('CONVENTIONNEL');

      foreach($tab_reponse as $reponse){
        if($tab_reponse["choix1"] == $realiste){
          $tab_resultats["realiste"]+=3;
        }
        else if($tab_reponse["choix1"] == $investigatif){
          $tab_resultats["investigatif"]+=3;
        }

        else if($tab_reponse["choix1"] == $artistique){
          $tab_resultats["artistique"]+=3;
        }
        else if($tab_reponse["choix1"] == $social){
          $tab_resultats["social"]+=3;
        }

        else if($tab_reponse["choix1"] == $entrepreneur){
          $tab_resultats["entrepreneur"]+=3;
        }
        else if($tab_reponse["choix1"] == $conventionnel){
          $tab_resultats["conventionnel"]+=3;
        }
        if($tab_reponse["choix2"] == $realiste){
          $tab_resultats["realiste"]+=2;
        }
        else if($tab_reponse["choix2"] == $investigatif){
          $tab_resultats["investigatif"]+=2;
        }

        else if($tab_reponse["choix2"] == $artistique){
          $tab_resultats["artistique"]+=2;
        }
        else if($tab_reponse["choix2"] == $social){
          $tab_resultats["social"]+=2;
        }

        else if($tab_reponse["choix2"] == $entrepreneur){
          $tab_resultats["entrepreneur"]+=2;
        }
        else if($tab_reponse["choix2"] == $conventionnel){
          $tab_resultats["conventionnel"]+=2;
        }
        if($tab_reponse["choix3"] == $realiste){
          $tab_resultats["realiste"]+=1;
        }
        else if($tab_reponse["choix3"] == $investigatif){
          $tab_resultats["investigatif"]+=1;
        }

        else if($tab_reponse["choix3"] == $artistique){
          $tab_resultats["artistique"]+=1;
        }
        else if($tab_reponse["choix3"] == $social){
          $tab_resultats["social"]+=1;
        }

        else if($tab_reponse["choix3"] == $entrepreneur){
          $tab_resultats["entrepreneur"]+=1;
        }
        else if($tab_reponse["choix3"] == $conventionnel){
          $tab_resultats["conventionnel"]+=1;
        }
      }
     $tab_resultats["realiste"] = ($tab_resultats["realiste"] * 100)/72;
     $tab_resultats["investigatif"] = ($tab_resultats["investigatif"] * 100)/72;
     $tab_resultats["social"] = ($tab_resultats["social"] * 100)/72;
     $tab_resultats["artistique"] = ($tab_resultats["artistique"] * 100)/72;
     $tab_resultats["conventionnel"] = ($tab_resultats["conventionnel"] * 100)/72;
     $tab_resultats["entrepreneur"] = ($tab_resultats["entrepreneur"] * 100)/72;

     return $tab_resultats;
    }

    public function calcul_result_promo($id_promo){
      $liste_etudiants = ModelEtudiant::getEtud_by_promo($id_promo);
      $tab_resultats_promo = array("realiste"=>0 ,"investigatif"=>0 ,"artistique" => 0, "social" => 0, "entrepreneur" => 0, "conventionnel" => 0, "INE" => 0);
      foreach ($liste_etudiants as $etudiant) {
        $tab_reponse = select_by_num_user($etudiant["ine"]);
        $tab_intermediaire = calcul_result_etud($tab_reponse);
        $tab_resultats_promo["realiste"] = $tab_resultats["realiste"] + $tab_intermediaire["realiste"];
        $tab_resultats_promo["investigatif"] = $tab_resultats["investigatif"] + $tab_intermediaire["investigatif"];
        $tab_resultats_promo["artistique"] = $tab_resultats["artistique"] + $tab_intermediaire["artistique"];
        $tab_resultats_promo["social"] = $tab_resultats["social"] + $tab_intermediaire["social"];
        $tab_resultats_promo["entrepreneur"] = $tab_resultats["entrepreneur"] + $tab_intermediaire["entrepreneur"];
        $tab_resultats_promo["conventionnel"] = $tab_resultats["conventionnel"] + $tab_intermediaire["conventionnel"];
      }
      $tab_resultats_promo["realiste"] = $tab_resultats_promo["realiste"]/len($liste_etudiants);
      $tab_resultats_promo["investigatif"] = $tab_resultats_promo["investigatif"]/len($liste_etudiants);
      $tab_resultats_promo["artistique"] = $tab_resultats_promo["artistique"]/len($liste_etudiants);
      $tab_resultats_promo["social"] = $tab_resultats_promo["social"]/len($liste_etudiants);
      $tab_resultats_promo["entrepreneur"] = $tab_resultats_promo["entrepreneur"]/len($liste_etudiants);
      $tab_resultats_promo["conventionnel"] = $tab_resultats_promo["conventionnel"]/len($liste_etudiants);
      return $tab_resultats_promo;
    }
  }
?>