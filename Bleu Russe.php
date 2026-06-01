<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Bleu.css">
</head>
<body>
  <div class="container">
    <h1>Chat</h1>
    <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Bleu Russe yeux grix.jpg" alt="Bleu Russe">
    </div>
    <div class="card-content">
        <h3>Race: Bleu Russes</h3>
        <h4>NOM: Yanis</h4>
        <p>AGE: 18 mois</p> 
        <p>SEXE: MALE</p>
        <p>TAILLE: 30 cm</p>
        <p>POIDS: 2,05 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Yanis')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "28 Octobre 2026";
        const heure = "16h55";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>