<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/MaineCoon.css">
</head>
<body>
  <div class="container">
    <h1>Chat</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Maine Coon blond orange.jpg" alt="Maine Coon">
    </div>
    <div class="card-content">
        <h3>Race: Maine Coon</h3>
        <h4>NOM: Rageta</h4>
        <p>AGE: 5 mois</p>
        <p>SEXE: FEMELLE</p>
        <p>TAILLE: 12,5 cm</p>
        <p>POIDS: 3 kg</p>
         <button href="Adopter.php" onclick="demanderAdoption('Rageta')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "13 Novembre 2026";
        const heure = "10h25";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>