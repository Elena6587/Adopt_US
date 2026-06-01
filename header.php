<nav class="navBar">
    <div class="navBarItem">
      <?php if (isset($_SESSION['user_id']))?>
      <a href="index.php">Accueil</a>
    </div>
    <!-- Sous-menu Chien -->
    <div class="navBarItem">
      <a href="Chien.php">Chien</a>
    </div>

    <!-- Sous-menu Chat -->
    <div class="navBarItem">
      <a href="Chat.php">Chat</a>
    </div>

    <!--<div class="navBarItem">
      <a href="Lapin.php">Lapin</a>
    </div>-->
    <div class="navBarItem">
      <a href="Connexion.php" id="connexnBtn">Connexion</a>
    </div>

    <div class="navBarItem">
        <a href="Contact.php">Contact</a></li>
    </div>

    <div class="navBarItem">
        <a href="Ajouter&Supp.php" style="color:rgb(247, 33, 33);" id="admiBtn" >Ajout & Suppression</a>
    </div>

    <div class="navBarItem">
      <a href="Admin.php" style="color: rgb(159, 20, 20);" id="admiBtn" >Admin</a>
    </div>

    <div class="navBarItem">
      <a href="Sauvegarde.php" id="sauvBtn" >Sauvegarder</a>
    </div>
    
    <div class="navBarItem">
        <a href="Adopter.php">Adopter</a>
    </div>
    <?php if (isset($_SESSION['user_id'])): ?>
      <div class="navBarItem"><a href="logout.php">Déconnexion</a></div>
    <?php elseif (isset($_SESSION['admin_id'])): ?>
      <div class="navBarItem"><a href="logout.php">Déconnexion</a></div>
    <?php endif; ?>
</nav>
<br>