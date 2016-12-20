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
          <li class="<?php if ($first_part==" Votre Profil") {echo "active"; }?>"><a href="index.php?controller=etudiant&amp;action=profil"><i class="icon-user"></i> Votre Profil</a></li>
          <li class="<?php if ($first_part==" Personnalité") {echo "active"; }?>"><a href="skills.html"><i class="icon-trophy"></i> Personnalité</a></li>
          <li class="<?php if ($first_part==" Test de personnalité") {echo "active"; }?>"><a href="resume.html"><i class="icon-doc-text"></i> Test de personnalité</a></li>
          <li class="<?php if ($first_part==" Se déconnecter") {echo "active"; }?>"><a href="resume.html"><i class="icon-power"></i>  Se déconnecter</a></li>
        <?php } else { ?>
          <li class="<?php if ($first_part==" Se connecter") {echo "active"; }?>"><a href="index.php?controller=etudiant&amp;action=connexion"><i class="icon-power"></i> Se connecter</a></li>
        <?php } ?>
      </ul>
      <div class="nav-collapse collapse"></div>
    </div>
  </div>
</div>