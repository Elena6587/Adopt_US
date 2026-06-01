<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Reyline.css">
</head>
<body>
  <h1>Chien</h1>
    <?php require_once 'header.php';?>

  
  <div class="card">
    <div class="card-image">
        <img src="Alaskan Klee Kai gris blanc.jpg" alt="Alaskan Klee Kai" width="49%">
    </div>
    <div class="card-content">
        <h3>Race: Alaskan Klee Kai</h3>
        <h4>NOM: Reyline</h4>
        <p>AGE: 10 ans</p>
        <p>SEXE: FEMELLE</p>
        <p>TAILLE: 38 cm</p>
        <p>POIDS: 8 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Reyline')" class="button-slide">Adopter</a>
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