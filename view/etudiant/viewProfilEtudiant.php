<div class="container profile">
	<!--
	<div class="span3">
		<img src="img/mini.png" alt="">
	</div>
	-->
	<center>
	<div class="span6">
			<h2>Votre test de personnalité à donné le résultat suivant</h2>		
			<canvas id="myChart" width="60%" height="30%" ></canvas>
<!--Mail php test -->

<?php

/*
//$realiste = $profil[0]
//$investigateur = $profil[1]
//$artistique
//$social
//$entreprenant
//$conventionnel

*/
$mail = 'test@hotmail.fr'; //Saisir le mail de destination
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn$*).[a-z]{2,4}$#", $mail))
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
$header = "From: ".$passage_ligne;
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
//mail($mail,$sujet,$message,$header);
print_r($mail);
print_r($sujet);
print_r($message);
print_r($header);
//==========
?>


			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
			<script>
				var var_labels = <?php echo json_encode($labels); ?>;
				var var_profil = <?php echo json_encode($profil, JSON_NUMERIC_CHECK); ?>;
				//var var_profil_promo = <?php //echo json_encode($profil_promo, JSON_NUMERIC_CHECK); ?>;
				var ctx = document.getElementById("myChart");
				var data = {
				    labels: var_labels,
				    datasets: [
				        {
				            label: "Ma personnalité",
				            backgroundColor: "rgba(0,0,0,0.4)",
				            borderColor: "rgba(0,0,0,1)",
				            pointBackgroundColor: "rgba(0,0,0,1)",
				            pointBorderColor: "rgba(0,0,0,0)",
				            pointHoverBackgroundColor: "#fff",
				            pointHoverBorderColor: "rgba(0,0,0,1)",
				            data: var_profil
				        }
				       /* {
				            label: "Personnalité de ma promo",
				            backgroundColor: "rgba(255,99,132,0.2)",
				            borderColor: "rgba(255,99,132,1)",
				            pointBackgroundColor: "rgba(255,99,132,1)",
				            pointBorderColor: "#fff",
				            pointHoverBackgroundColor: "#fff",
				            pointHoverBorderColor: "rgba(255,99,132,1)",
				            data: var_profil_promo
				        }*/
				    ]
				};
				var myChart = new Chart(ctx, {
				    type: "radar",
				    data: data,
				    
				    options: {
				            scale: {
				                ticks: {
				                    beginAtZero: true
				                }
				            }
				    }
				});
			</script>
	</div>
	</center>
</div>
