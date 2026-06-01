<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Rosalie.css">
</head>
<body>
  <h1>Lapin</h1>
  <nav class="navBar">
    <div class="navBarItem">
      <a href="Acceuil.php">Accueil</a>
    </div>
    <!-- Sous-menu Chien -->
    <div class="navBarItem">
      <a href="Chien.php">Chien</a>
    </div>

    <!-- Sous-menu Chat -->
    <div class="navBarItem">
      <a href="Chat.php">Chat</a>
    </div>

    <div class="navBarItem">
      <a href="Lapin.php">Lapin</a>
    </div>

    <div class="navBarItem">
        <a href="Contact.php">Contact</a></li>
    </div>

     <div class="navBarItem">
        <a href="Ajouter&Supp.php" style="color:rgb(247, 33, 33);" id="admiBtn" >Ajout & Suppression</a></li>
    </div>

    <div class="navBarItem">
      <a href="Admin.php" style="color: rgb(159, 20, 20);" id="admiBtn" >Admin</a>
    </div>

     <div class="navBarItem">
      <a href="Connexion.php" id="connexnBtn">Connexion</a>
    </div>

  <div class="navBarItem">
    <a href="Adopter.php">Adopter</a>
  </div>
</nav>
  
  <div class="card">
    <div class="card-image">
      <img src="lapin_blanc_vienne.jpg" alt="Blanc de Vienne" width="350">
    </div>
    <div class="card-content">
        <h3>Race: Blanc de Vienne</h3>
        <h4>NOM: Rosalie</h4>
        <p>AGE: 6 ans</p> 
        <p>SEXE: FEMELLE</p>
        <button href="Adopter.php" onclick="demanderAdoption('Rosalie')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "30 Janvier 2026";
        const heure = "18h10";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>