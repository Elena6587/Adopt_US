<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Curl.css">
</head>
<body>
<div class="container">

    <h1>Chat</h1>

    <?php require_once 'header.php';?>
    <div class="card">
        <div class="card-image">
            <img src="American Curl blanc gris.jpg" alt="American Curl">
        </div>
        <div class="card-content">
            <h3>Race: American Curl</h3>
            <h4>NOM: Galos</h4>
            <p>AGE: 10 mois</p> 
            <p>SEXE: FEMELLE</p>
            <p>TAILLE: 32 cm</p>
            <p>POIDS: 2,25 kg</p>
            <button onclick="demanderAdoption('Galos')" class="button-slide">
                Adopter
            </button>
        </div>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
    let confirmation = confirm("Confirmer l'adoption de " + nomChien + " ?");
    if (confirmation) {
        // On définit les infos du rendez-vous
        const date = "10 Fevrier 2026";
        const heure = "10h30";
        const lieu = "123 Rue de la Paix, Paris";
        // On envoie tout vers la page Adopter.php dans l'URL
        window.location.href = "Adopter.php?nom=" + nomChien + "&date=" + date + "&heure=" + heure + "&lieu=" + lieu;
    }
}
  </script>
</body>
</html>