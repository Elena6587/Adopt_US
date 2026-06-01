<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="Pinscher.css">
</head>
<body>
  <h1>Chien</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Pinscher Nain marron.jpg" alt="Pinscher">
    </div>
    <div class="card-content">
        <h3>Race: Pinscher Nain</h3>
        <h4>NOM: Guler</h4>
        <p>AGE: 33 ans</p>
        <p>SEXE: MALE</p>
        <p>TAILLE: 29.3 cm</p>
        <p>POIDS: 6 kg</p>
         <button href="Adopter.php" onclick="demanderAdoption('Guler')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "3 Novembre 2026";
        const heure = "9h10";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>