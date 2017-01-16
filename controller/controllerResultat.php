<?php

	require_once("{$ROOT}{$DS}model{$DS}modelEtudiant.php");
	require_once("{$ROOT}{$DS}model{$DS}modelSection.php");
	require_once("{$ROOT}{$DS}model{$DS}modelSelectionner");
	require_once("{$ROOT}{$DS}model{$DS}modelPromo");
	require_once("{$ROOT}{$DS}model{$DS}modelProfil");


	$action = $_GET['action'];

	
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
			$etud_promo = ModelEtudiant::getPromo($_SESSION['login']); //Comment obtenir la promo de l'étudiant?
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

