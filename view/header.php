<!--
Verifie quelle page est active
-->
<?php 
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$first_part = $components[1];
?>

<!-- Tête de page -->
<div class="navbar">
  <div class="navbar-inner">
    <div class="container"> 
      <a href="./index.php"><img src="img/polytech.png" alt=""></a>
      <ul class="nav nav-collapse pull-right">
        <?php if(!empty($_SESSION['login']) && isset($_SESSION['login'])){ ?>
          <li class="<?php if ($action=="profil") {echo "active"; }?>"><a href="index.php?controller=etudiant&amp;action=profil"><i class="icon-user"></i> Votre Profil</a></li>
          <li class="<?php if ($first_part==" Test de personnalité") {echo "active"; }?>"><a href="resume.html"><i class="icon-doc-text"></i> Test de personnalité</a></li>
          <li class="<?php if ($action=="deconnexion") {echo "active"; }?>"><a href="index.php?controller=etudiant&amp;action=deconnexion"><i class="icon-power"></i>  Se déconnecter</a></li>
        <?php } ?>
      </ul>
      <div class="nav-collapse collapse"></div>
    </div>
  </div>
</div>