<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Sokoke.css">
</head>
<body>
  <h1>Chat</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Sokoke-chat.jpg" alt="Sokoke-chat" width="90%">
    </div>
    <div class="card-content">
        <h3>Race: Sokoke-chat</h3>
        <h4>NOM: Yunali</h4>
        <p>AGE: 2 ans</p>
        <p>SEXE: FEMELLE</p>
        <button href="Adopter.php" onclick="demanderAdoption('Yunali')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "21 Octobre 2026";
        const heure = "10h45";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>