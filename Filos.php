<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Filos.css">
</head>
<body>
  <h1>Chien</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Jack Russell Terrier marron noir.jpg" alt="Jack Russel">
    </div>
    <div class="card-content">
        <h3>Race: Jack Russell Terrier</h3>
        <h4>NOM: Filos</h4>
        <p>AGE: 2 ans</p> 
        <p>SEXE: MALE</p>
        <p>TAILLE: 25 cm</p>
        <p>POIDS: 7.05 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Filos')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "10 Decembre 2026";
        const heure = "13h04";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>