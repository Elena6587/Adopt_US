<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Devon.css">
</head>
<body>
  <div class="container">
    <h1>Chat</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Devon Rex blond.jpg" alt="Devon Rex">
    </div>
    <div class="card-content">
        <h3>Race: Devon Rex </h3>
        <h4>NOM: Luna</h4>
        <p>AGE: 23 ans</p>
        <p>SEXE: FEMELLE</p>
        <p>TAILLE: 26,5 cm</p>
        <p>POIDS: 3,23 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Luna')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "17 Decembre 2026";
        const heure = "16h00";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>