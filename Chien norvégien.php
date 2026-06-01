<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Norvegin.css">
</head>
<body>
  <h1>Chien</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Chien norvégien de Macareux blond blanc.jpg" alt="Norvégien">
    </div>
    <div class="card-content">
        <h3>Race: Chien norvégien de Macareux</h3>
        <h4>NOM: Navie</h4>
        <p>AGE: 12 ans</p>
        <p>SEXE: FEMELLE</p>
        <p>TAILLE: 34 cm</p>
        <p>POIDS: 7.58 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Navie')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "2 Juin 2026";
        const heure = "13h00";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>