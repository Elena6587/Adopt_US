<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Tonkinois.css">
</head>
<body>
  <h1>Chat</h1>
   <?php require_once 'header.php';?>
  
  <div class="card">
    <div class="card-image">
        <img src="Tonkinois-race-de-chat.jpg" alt="Tonkinois-race-de-chat" width="90%">
    </div>
    <div class="card-content">
        <h3>Race: Tonkinois</h3>
        <h4>NOM: Justine</h4>
        <p>AGE: 20 ans</p>
        <p>SEXE: FEMELLE</p>
        <button href="Adopter.php" onclick="demanderAdoption('Justine')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "15 Octobre 2026";
        const heure = "14h30";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>