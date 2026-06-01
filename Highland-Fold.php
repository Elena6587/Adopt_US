<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Highland.css">
</head>
<body>
  <h1>Chat</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Highland-Fold.jpg" alt="Highland-Fold" width="90%">
    </div>
    <div class="card-content">
        <h3>Race: Highland-Fold</h3>
        <h4>NOM: Jule</h4>
        <p>AGE: 16 ans</p>
        <p>SEXE: MALE</p>
        <button href="Adopter.php" onclick="demanderAdoption('Jule')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "14 Decembre 2026";
        const heure = "10h17";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>