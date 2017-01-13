<?php

$mail = $_SESSION['mail']; //Saisir le mail de destination
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
{
		$passage_ligne = "\r\n";
}
else
{
		$passage_ligne = "\n";
}


//=====Déclaration des messages au format texte et au format HTML.
$message_txt = "Voici vos résultats du test RIASEC:".$passage_ligne;
$message_txt .= $labels[0]." = ".$profil[0].$passage_ligne;
$message_txt .= $labels[1]." = ".$profil[1].$passage_ligne;
$message_txt .= $labels[2]." = ".$profil[2].$passage_ligne; 
$message_txt .= $labels[3]." = ".$profil[3].$passage_ligne; 
$message_txt .= $labels[4]." = ".$profil[4].$passage_ligne;
$message_txt .= $labels[5]." = ".$profil[5].$passage_ligne;
$message_html = ""; //Meme texte mais avec les balises html
//==========

$boundary = "-----=".md5(rand());

//=====Définition du sujet.

$sujet = "Envoi des résultats de votre test RIASEC";

//=====Création du header de l'e-mail
$header = "From: pool.polytech@gmail.com".$passage_ligne;
$header .= "Reply-to: ".$mail.$passage_ligne;
$header .= "MIME-Version: 1.0".$passage_ligne;
$header .= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========


//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;


//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
//$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
//$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
//$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
//==========
 
//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
//print_r($mail."\n");
//print_r($sujet."\n");
//print_r($message."\n");
//print_r($header."\n");
//==========
?>
