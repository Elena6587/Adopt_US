<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Teckel.css">
</head>
<body>
  <h1>Chien</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Teckel marron.jpg" alt="Teckel">
    </div>
    <div class="card-content">
        <h3>Race: Teckel</h3>
        <h4>NOM: Oka</h4>
        <p>AGE: 40 ans</p>
        <p>SEXE: FEMELLE</p>
        <p>TAILLE: 43 cm</p>
        <p>POIDS: 8,05 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Oka')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "15 Octobre 2026";
        const heure = "15h25";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>