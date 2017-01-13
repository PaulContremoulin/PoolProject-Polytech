<!--HEADER-->

<!-- Navigation -->
<a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
<nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
        <?php if(!empty($_SESSION['login']) && isset($_SESSION['login']) && $_GET["controller"]=="etudiant"){ ?>
        <li class="<?php if ($view=="profil") {echo "active"; }?>"><a href="index.php?controller=etudiant&amp;action=profil"><i class="icon-user"></i> Mon Profil</a></li>
        <li class="<?php if ($view=="test") {echo "active"; }?>"><a href="index.php?controller=etudiant&amp;action=test"><i class="icon-user"></i> Test de personnalité</a></li>
        <li><a href="index.php?controller=etudiant&amp;action=deconnexion"><i class="icon-user"></i>  Se déconnecter</a></li>
        <?php } else if (!empty($_SESSION['login']) && isset($_SESSION['login']) && $_GET["controller"]=="admin"){ ?>
        <li><a href="index.php?controller=admin&amp;action=resultats"><i class="icon-user"></i> Resultats</a></li>
        <li><a href="index.php?controller=admin&amp;action=questionnaire"><i class="icon-doc-text"></i> Gestion Questionnaire</a></li>
        <li><a href="index.php?controller=admin&amp;action=code"><i class="icon-doc-text"></i>Code Test</a></li>
        <li><a href="index.php?controller=admin&amp;action=admins"><i class="icon-doc-text"></i>Gestion Administrateur</a></li><li><a href="index.php?controller=admin&amp;action=promo><i class="icon-doc-text"></i>Gestion Promo</a></li>
        <li><a href="index.php?controller=admin&amp;action=deconnexion"><i class="icon-doc-text"></i>Deconnexion</a></li>
        <?php }else if($_GET["controller"]=="etudiant"){ ?>
        <li><a href="index.php?controller=etudiant&amp;action=profil"><i class="icon-user"></i> Connexion</a></li>
        <li><a href="index.php?controller=etudiant&amp;action=inscription"><i class="icon-doc-text"></i> Inscription</a></li>
        <li><a href="index.php"><i class="icon-doc-text"></i>Etudiant/Admin</a></li>
        <?php }else{ ?>
          <li><a href="index.php?controller=admin&amp;action=profil"><i class="icon-user"></i> Connexion</a></li>
          <li><a href="index.php"><i class="icon-doc-text"></i>Etudiant/Admin</a></li>
        <?php } ?> 
    </ul>
</nav>








<!-- Ancien HEADER -->
<?php /*
<!-- Tête de page -->
<div class="navbar">
  <div class="navbar-inner">
    <div class="container"> 
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </a>
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
</div> */

?>
