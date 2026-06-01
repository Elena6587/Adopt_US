<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Labrador.css">
</head>
<body>
  <h1>Chien</h1>
   <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Labrador Retriever blond.jpg" alt="Labrador">
    </div>
    <div class="card-content">
        <h3>Race: Labrador Retriever</h3>
        <h4>NOM: Rika</h4>
        <p>AGE: 25 ans</p>
        <p>SEXE: FEMELLE</p>
        <p>TAILLE: 56.7 cm</p>
        <p>POIDS: 31.01 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Rika')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "13 Novembre 2026";
        const heure = "14h08";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}ipt>
</body>
</html>