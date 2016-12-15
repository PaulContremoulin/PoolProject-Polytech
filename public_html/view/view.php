<!DOCTYPE html>
<html lang="fr">
<head>
	<title><?php echo $pagetitle;?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="font/css/fontello.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
</head>
	<body>
		<?php
			require_once("header.php");
			// Si $controleur='accueil' et $view='default',
			// alors $filepath=".../view/accueil/"
			//       $filename="viewDefaultAccueil.php";
			// et on charge '.../view/accueil/viewDefaultAccueil.php'
			$filepath = "{$ROOT}{$DS}view{$DS}{$controller}{$DS}";
			$filename = "view".ucfirst($view) . ucfirst($controller) . '.php';
			require "{$filepath}{$filename}";//vue concernée
			require_once("footer.php");
		?>
    </body>
</html>
