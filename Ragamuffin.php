<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Ragamuffin.css">
</head>
<body>
  <h1>Chat</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Ragamuffin.jpg" alt="Braque" width="70%">
    </div>
    <div class="card-content">
        <h3>Race: Ragamuffin</h3>
        <h4>NOM: Ruby</h4>
        <p>AGE: 19 ans</p>
        <p>SEXE: MALE</p>
        <p>TAILLE: 40 cm</p>
        <p>POIDS: 10 kg</p>
       <button href="Adopter.php" onclick="demanderAdoption('Ruby')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "28 Octobre 2026";
        const heure = "10h15";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>