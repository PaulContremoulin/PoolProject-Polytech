<?php

	require_once("{$ROOT}{$DS}model{$DS}modelEtudiant.php");
	require_once("{$ROOT}{$DS}model{$DS}modelSection.php");
	require_once("{$ROOT}{$DS}model{$DS}modelSelectionner");
	require_once("{$ROOT}{$DS}model{$DS}modelPromo");
	require_once("{$ROOT}{$DS}model{$DS}modelProfil");


	$action = $_GET['action'];

	public function calculresult_realiste($tab_reponse){
		$realiste = 0;
		foreach($tab_reponse as $reponse){
			if($reponse[$choix1] == ModelProfil::retrieve_id2('REALISTE')){
				$realiste+=3;
			}
			else if($reponse[$choix2] == ModelProfil::retrieve_id2('REALISTE')){
				$realiste+=2;
			}

			if($reponse[$choix3] == ModelProfil::retrieve_id2('REALISTE')){
				$realiste+=1;
			}
		}
		return $realiste;
	}

	public function calculresult_investigatif($tab_reponse){
		$investigatif = 0;
		foreach($tab_reponse as $reponse){
			if ($reponse[$choix1] == ModelProfil::retrieve_id2('INVESTIGATIF')) {
			 	$investigatif+=3;
			}
			elseif ($reponse[$choix2] == ModelProfil::retrieve_id2('INVESTIGATIF')) {
			 	$investigatif+=2;
			}
			elseif ($reponse[$choix3] == ModelProfil::retrieve_id2('INVESTIGATIF')) {
			 	$investigatif+=1;
			} 
		}
		return $investigatif;
	}


	public function calculresult_artistique($tab_reponse){
		$artistique = 0 ;
		foreach($tab_reponse as $reponse){
			if ($reponse[$choix1] == ModelProfil::retrieve_id2('ARTISTIQUE')) {
			 	$artistique+=3;
			} 
			elseif ($reponse[$choix2] == ModelProfil::retrieve_id2('ARTISTIQUE')) {
			 	$artistique+=2;
			}
			elseif ($reponse[$choix3] == ModelProfil::retrieve_id2('ARTISTIQUE')) {
			 	$artistique+=1;
			}
		}
		return $artistique;
	}

	public function calculresult_social($tab_reponse){
		$social = 0;
		foreach($tab_reponse as $reponse){
			if ($reponse[$choix1] == ModelProfil::retrieve_id2('SOCIAL')) {
				 	$social+=3;
			}
			elseif ($reponse[$choix2] == ModelProfil::retrieve_id2('SOCIAL')) {
			 	$social+=2;
			}
			elseif ($reponse[$choix3] == ModelProfil::retrieve_id2('SOCIAL')) {
			 	$social+=1;
			}
		}
		return $social;
	}


	public function calculresult_entrepreneur($tab_reponse){
		$entrepreneur = 0;
		foreach($tab_reponse as $reponse){
			if ($reponse[$choix1] == ModelProfil::retrieve_id2('ENTREPRENEUR')) {
			 	$entrepreneur+=3;
			}
			elseif ($reponse[$choix2] == ModelProfil::retrieve_id2('ENTREPRENEUR')) {
			 	$entrepreneur+=2;
			}
			elseif ($reponse[$choix3] == ModelProfil::retrieve_id2('ENTREPRENEUR')) {
			 	$entrepreneur+=1;
			}
		}
		return $entrepreneur;
	}


	public function calculresult_conventionnel($tab_reponse){

		$conventionnel = 0;
		foreach($tab_reponse as $reponse){
			if ($reponse[$choix1] == ModelProfil::retrieve_id2('CONVENTIONNEL')) {
			 	$conventionnel+=3;
			}
			elseif ($reponse[$choix2] == ModelProfil::retrieve_id2('CONVENTIONNEL')) {
			 	$conventionnel+=2;
			}
			elseif ($reponse[$choix3] == ModelProfil::retrieve_id2('CONVENTIONNEL')) {
			 	$conventionnel+=1;
			}
		}
		return $conventionnel;
	}


	switch ($action) {

		case "resultat_perso":

			$pagetitle = "Votre Resultat";
			$tab_rep = ModelSelectionner::select_by_num_user($ine); //comment on peut récupérer l'ine de l'étudiant?
			$result_realiste = calculresult_realiste($tab_rep);
			$result_investigatif = calculresult_investigatif($tab_rep);
			$result_artistique = calculresult_artistique($tab_rep);
			$result_social = calculresult_social($tab_rep);
			$result_entrepreneur = calculresult_entrepreneur($tab_rep);
			$result_conventionnel = calculresult_conventionnel($tab_rep);



		case "resultat_promo":
			$pagetitle = "Resultat de la promo";
			$etud_promo = ModelEtudiant::getEtud_bypromo($id_promo); //Comment obtenir la promo de l'étudiant?
			foreach ($etud_promo as $etudiant) {
				$tab_rep = ModelSelectionner::select_by_num_user($etudiant["id_etudiant"]);
				$result_realiste = calculresult_realiste($tab_rep);
				$result_investigatif = calculresult_investigatif($tab_rep);
				$result_artistique = calculresult_artistique($tab_rep);
				$result_social = calculresult_social($tab_rep);
				$result_entrepreneur = calculresult_entrepreneur($tab_rep);
				$result_conventionnel = calculresult_conventionnel($tab_rep);
			}

		case "resultat_departement":
			$pagetitle = "Resultat de la departement";
			$etud_sect = ModelEtudiant::getEtud_bypromo($id_sect);//Comment obtenir le departement de l'étudiant?
			foreach ($etud_sect as $etudiant) {
				$tab_rep = ModelSelectionner::select_by_num_user($etudiant["id_etudiant"]);
				$result_realiste = calculresult_realiste($tab_rep);
				$result_investigatif = calculresult_investigatif($tab_rep);
				$result_artistique = calculresult_artistique($tab_rep);
				$result_social = calculresult_social($tab_rep);
				$result_entrepreneur = calculresult_entrepreneur($tab_rep);
				$result_conventionnel = calculresult_conventionnel($tab_rep);
			}

