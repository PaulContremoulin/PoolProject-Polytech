<!-- Tête de page -->
<div class="navbar">
  <div class="navbar-inner">
    <div class="container"> 
      <a class="brand" href="./index.php"><img src="img/polytech.gif" alt=""></a>
      <ul class="nav nav-collapse pull-right">
        <?php if(!empty($_SESSION['nom'])){ ?>
          <li><a href="index.html" class="active"><i class="icon-user"></i> Votre Profil</a></li>
          <li><a href="skills.html"><i class="icon-trophy"></i> Personnalité</a></li>
          <li><a href="resume.html"><i class="icon-doc-text"></i> Test de personnalité</a></li>
        <?php } ?>
          <li><a href="contact.html"><i class="icon-mail"></i> Contactez-nous</a></li>
      </ul>
      <div class="nav-collapse collapse"></div>
    </div>
  </div>
</div>