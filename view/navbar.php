    <!--HEADER-->
    <!-- Navigation -->
<a id="menu-toggle" href="#" class="btn btn-dark btn-lg toggle"><i class="fa fa-bars"></i></a>
<nav id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <a id="menu-close" href="#" class="btn btn-light btn-lg pull-right toggle"><i class="fa fa-times"></i></a>
        <?php if(!empty($_SESSION['login']) && isset($_SESSION['login']) && $_GET["controller"]=="etudiant"){ ?>
        <li class="<?php if ($view=="profil") {echo "active"; }?>"><a href="index.php?controller=etudiant&amp;action=profil"><i class="fa fa-user" aria-hidden="true"></i> Mon Profil</a></li>
        <li class="<?php if ($view=="test") {echo "active"; }?>"><a href="index.php?controller=etudiant&amp;action=code"><i class="fa fa-file-text-o" aria-hidden="true"></i> Test de personnalité</a></li>
        <li><a href="index.php?controller=etudiant&amp;action=deconnexion"><i class="fa fa-power-off" aria-hidden="true"></i>  Se déconnecter</a></li>
        <?php } else if (!empty($_SESSION['login']) && isset($_SESSION['login']) && $_GET["controller"]=="admin"){ ?>
        <li><a href="index.php?controller=admin&amp;action=resultats"><i class="fa fa-bar-chart" aria-hidden="true"></i> Statistiques </a></li>
        <li><a href="index.php?controller=admin&amp;action=questionnaire"><i class="fa fa-file-text-o" aria-hidden="true"></i> Gestion Questionnaire</a></li>
        <li><a href="index.php?controller=admin&amp;action=code"><i class="fa fa-key" aria-hidden="true"></i>Code Test</a></li>
        <li><a href="index.php?controller=admin&amp;action=admins"><i class="fa fa-users" aria-hidden="true"></i> Gestion Administrateur</a></li>
        <li><a href="index.php?controller=admin&amp;action=promo"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Gestion Promo</a></li>
        <li><a href="index.php?controller=admin&amp;action=deconnexion"><i class="fa fa-power-off" aria-hidden="true"></i> Deconnexion</a></li>
        <?php } ?> 
    </ul>
</nav>

        <?php /*}else if($_GET["controller"]=="etudiant"){ ?>
        <li><a href="index.php?controller=etudiant&amp;action=profil"><i class="icon-user"></i> Connexion</a></li>
        <li><a href="index.php?controller=etudiant&amp;action=inscription"><i class="icon-doc-text"></i> Inscription</a></li>
        <li><a href="index.php"><i class="icon-doc-text"></i>Etudiant/Admin</a></li>
        <?php }else{ ?>
          <li><a href="index.php?controller=admin&amp;action=profil"><i class="icon-user"></i> Connexion</a></li>
          <li><a href="index.php"><i class="icon-doc-text"></i>Etudiant/Admin</a></li>
        <?php }*/ ?> 

