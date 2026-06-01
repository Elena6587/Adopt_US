<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/BritShorthair.css">
</head>
<body>
 <div class="container">
    <h1>Chat</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="British Shorthair gris yeux marron.jpg" alt="British Shorthair">
    </div>
    <div class="card-content">
        <h3>Race: British Shorthair</h3>
        <h4>NOM: Floris</h4>
        <p>AGE: 14 mois</p>
        <p>SEXE: FEMELLE</p>
        <p>TAILLE: 22 cm</p>
        <p>POIDS: 1,16 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Floris')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "10 Juin 2026";
        const heure = "14h46";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>