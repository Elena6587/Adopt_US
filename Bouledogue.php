<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Fatie.css">
</head>
<body>
  <h1>Chien</h1>
    <?php require_once 'header.php';?>
    
  <div class="card">
    <div class="card-image">
        <img src="Bouledogue Français blanc noir.jpg" alt="Bouledogue Français"  width="30%">>
    </div>
    <div class="card-content">
        <h3>Race: Bouledogue Français</h3>
        <h4>NOM: Fate</h4>
        <p>AGE: 18 mois</p> 
        <p>SEXE: MALE</p>
        <p>TAILLE: 33 cm</p>
        <p>POIDS: 10.12 kg</p>
        <button href="Adopter.php" onclick="demanderAdoption('Fatie')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "27 Juin 2026";
        const heure = "16h48";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>