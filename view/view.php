<!DOCTYPE html>
<html lang="fr">
<head>
	<title><?php echo $pagetitle;?></title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/stylish-portfolio.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="css/mystyle.css" rel="stylesheet">
	<!--<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>-->
</head>
	<body>
		<?php
			require_once("navbar.php"); 
			if(isset($msgError)){
				require_once("viewError.php");
			}
		?>
		<header id="top" class="header">
			<div class="text-vertical-center">
			<?php
				$filepath = "{$ROOT}{$DS}view{$DS}{$controller}{$DS}";
				$filename = "view".ucfirst($view) . ucfirst($controller) . '.php';
				require "{$filepath}{$filename}";//vue concernée
				require_once("footer.php");
			?>
			</div>
		</header>
    </body>
</html>
