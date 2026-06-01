<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/havana.css">
</head>
<body>
  <div class="container">
    <h1>Chat</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Havana Brown noir.jpg" alt="Havana Brown">
    </div>
    <div class="card-content">
        <h3>Race: Havana Brown</h3>
        <h4>NOM: Zack</h4>
        <p>AGE: 25 ans</p>
        <p>SEXE: MALE</p>
        <p>TAILLE: 28,25 cm</p>
        <p>POIDS: 6,08 kg</p>
       <button href="Adopter.php" onclick="demanderAdoption('Zack')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "14 Decembre 2026";
        const heure = "15h21";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>