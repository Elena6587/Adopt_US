<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Cymric.css">
</head>
<body>
  <div class="container">
    <h1>Chat</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Cymric marron noir.jpg" alt="Cymric">
    </div>
    <div class="card-content">
        <h3>Race: Cymric</h3>
        <h4>NOM: Iman</h4>
        <p>AGE: 28 ans</p>
        <p>SEXE: MALE</p>
        <p>TAILLE: 31 cm</p>
        <p>POIDS: 5,30 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Iman')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "17 Avril 2026";
        const heure = "16h40";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>