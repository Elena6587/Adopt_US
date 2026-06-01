<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Shorthair.css">
</head>
<div class="container">
    <h1>Chat</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="American Shorthair blond.jpg" alt="American Shorthair">
    </div>
    
    <div class="card-content">
        <h3>Race: American Shorthair </h3>
        <h4>NOM: Carline</h4>
        <p>AGE: 5 ans</p>
        <p>SEXE: MALE</p>
        <p>TAILLE: 26 cm</p>
        <p>POIDS: 4,05 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Carline')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "8 Mars 2026";
        const heure = "15h25";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>