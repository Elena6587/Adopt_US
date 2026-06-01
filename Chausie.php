<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/Chausie.css">
</head>
<body>
  <h1>Chat</h1>
   <?php require_once 'header.php';?>

  <div class="card">
    <div class="card-image">
        <img src="Chausie-chasse-les-rats.jpg" alt="Chausie" width="90%">
    </div>
    <div class="card-content">
        <h3>Race: Chausie</h3>
        <h4>NOM: Touran</h4>
        <p>AGE: 5 ans</p>
        <p>SEXE: MALE</p>
        <button onclick="demanderAdoption('Touran')" class="button-slide">Adopter</a>
    </div>
</div>
<script>
function demanderAdoption(nomChien) {
      // 1er message : Demande de confirmation
      let confirmation = confirm("Êtes-vous sûr de vouloir adopter " + nomChien + " ?");

      // 2ème étape : Si l'utilisateur clique sur "Accepter"
      if (confirmation) {
        alert(nomChien + " a bien été adopté(e) !\n\nVous devez maintenant venir le récupérer au 123 Rue de la Paix, 75000 Paris. \n\n Le paiement se fera directement sur place.");
      }
    }
  </script>
</body>
</html>