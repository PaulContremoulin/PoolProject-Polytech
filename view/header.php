<!-- Tête de page -->
<div class="navbar">
  <div class="navbar-inner">
    <div class="container"> 
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span> 
      <!--<a href="./index.php"><img src="img/polytech.png" alt=""></a>-->
      <ul class="nav nav-collapse pull-right">
        <?php if(!empty($_SESSION['login']) && isset($_SESSION['login'])){ ?>
          <li class="<?php if ($view=="profil") {echo "active"; }?>"><a href="index.php?controller=etudiant&amp;action=profil"><i class="icon-user"></i> Votre Profil</a></li>
          <li class="<?php if ($view=="test") {echo "active"; }?>"><a href="index.php?controller=etudiant&amp;action=test"><i class="icon-doc-text"></i> Test de personnalité</a></li>
          <li><a href="index.php?controller=etudiant&amp;action=deconnexion"><i class="icon-power"></i>  Se déconnecter</a></li>
        <?php } ?>
      </ul>
      <div class="nav-collapse collapse"></div>
    </div>
  </div>
</div>