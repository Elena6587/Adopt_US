<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Staffor.css">
</head>
<body>
  <h1>Chien</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="American Staffordshire Terrier orange blanc.jpg" alt="American Staffordshire">
    </div>
    <div class="card-content">
        <h3>Race: American Staffordshire</h3>
        <h4>NOM: Dermio</h4>
        <p>AGE: 4 mois</p>
        <p>SEXE: MALE</p>
        <p>TAILLE: 47 cm</p>
        <p>POIDS: 30.09 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Dermio')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "15 Octobre 2026";
        const heure = "16h20";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>