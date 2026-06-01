<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Braque.css">
</head>
<body>
  <h1>Chien</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Braque de Weimar gris.jpg" alt="Braque">
    </div>
    <div class="card-content">
        <h3>Race: Braque de Weimar</h3>
        <h4>NOM: Roti</h4>
        <p>AGE: 17 ans</p>
        <p>SEXE: MALE</p>
        <p>TAILLE: 56.5 cm</p>
        <p>POIDS: 29.15 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Roti')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "15 Juin 2026";
        const heure = "15h48";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>