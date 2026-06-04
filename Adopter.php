<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt us</title>
  <link rel="stylesheet" href="css/Adopte.css">
</head>
<body>
  <h1>Adopter</h1>
   <?php require_once 'header.php'?>
  
  <section class="recap-card">
            <h2>Récapitulatif de votre adoption</h2>
            
            <?php
            // On récupère les infos envoyées dans l'URL
            $nom = $_GET['nom'] ?? 'Animal';
            $date = $_GET['date'] ?? 'À définir';
            $heure = $_GET['heure'] ?? 'À définir';
            $lieu = $_GET['lieu'] ?? 'Notre centre';
            ?>

            <p>Vous avez choisi d'adopter : <strong><?php echo $nom; ?></strong></p>
            <div class="rdv-box">
                <h3>Votre Rendez-vous :</h3>
                <p><strong>Date :</strong> <?php echo $date; ?></p>
                <p><strong>Heure :</strong> <?php echo $heure; ?></p>
                <p><strong>Lieu :</strong> <?php echo $lieu; ?></p>
            </div>
            <div class="button-group">
        <button onclick="if(confirm('Annuler cette adoption ?')) { window.location.href='index.php'; }" class="button-cancel">
            Annuler</button>
        </section>
    </div>
</body>
</html>