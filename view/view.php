<!DOCTYPE html>
<html>
    <head>
		<link rel="stylesheet" type="text/css" href="./view/stylesheet.css">
		<meta charset="UTF-8">
        <title><?php echo $pagetitle;?></title>
    </head>
    <body>
    	<div class="page">
			<?php
				require_once("header.php");
				// Si $controleur='accueil' et $view='default',
				// alors $filepath=".../view/accueil/"
				//       $filename="viewDefaultAccueil.php";
				// et on charge '.../view/accueil/viewDefaultAccueil.php'
				$filepath = "{$ROOT}{$DS}view{$DS}{$controller}{$DS}";
				$filename = "view".ucfirst($view) . ucfirst($controller) . '.php';
				require "{$filepath}{$filename}";
				require_once("footer.php");
			?>
		</div>
    </body>
</html>

