<?php

  require_once("Model.php");

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

    



  }
?>