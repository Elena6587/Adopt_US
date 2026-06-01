<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Birmanie.css">
</head>
<body>
  <h1>Chat</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
         <img src="Sacré de Birmanie blanc noir gris.jpg" alt="Sacré de Birmanie">
    </div>
    <div class="card-content">
        <h3>Race: Sacré de Birmanie</h3>
        <h4>NOM: Warden</h4>
        <p>AGE: 30 ans</p>
        <p>SEXE: MALE</p>
        <button href="Adopter.php" onclick="demanderAdoption('Warden')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "22 Octobre 2026";
        const heure = "10h30";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>