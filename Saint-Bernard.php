<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/SaintBer.css">
</head>
<body>
  <h1>Chien</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Saint-Bernard.jpg" alt="Saint-Bernard">
    </div>
    <div class="card-content">
        <h3>Race: Saint-Bernard</h3>
        <h4>NOM: Juliette</h4>
        <p>AGE: 36 ans</p>
        <p>SEXE: FEMELLE</p>
        <p>TAILLE: 80 cm</p>
        <p>POIDS: 78 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Juliette')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "22 Octobre 2026";
        const heure = "8h20";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>