<?php
session_start();

// Vérification client connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: Connexion.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title>Adopt us</title>
    <link rel="stylesheet" href="css/adoptions.css">
</head>
<body>
    <h1>Adopt US</h1>
    <?php require_once 'header.php';?>

    <div class="container-galerie">
        <div class="card">
            <div class="card-image">
                <img src="Images/American Curl blanc gris.jpg" alt="American Curl">
            </div>
            <div class="card-content">
                <h3>Race: American Curl</h3>
                <h4>Nom: GALGOS</h4>
                <p>Âge: 10 mois</p> 
                <p>Sexe: Femelle</p>
                <p>Taille : 32 cm</p>
                <p>Poids : 2,25 kg:</p>
                <a href="American Curl.php" class="button-slide">Voir plus</a>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="Images/Jack Russell Terrier marron noir.jpg" alt="Jack Russel">
            </div>
            <div class="card-content">
                <h3>Race: Jack Russell</h3>
                <h4>Nom: Filos</h4>
                <p>Âge: 2 ans</p>
                <p>Sexe: Male</p>
                <p>Taille : 25 cm</p>
                <p>Poids : 7,05 kg:</p>
                <a href="Jack_Russell.php" class="button-slide">Voir plus</a>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="Images/American Shorthair blond.jpg" alt="American Shorthair">
            </div>
            <div class="card-content">
                <h3>Race: American Shorthair</h3>
                <h4>Nom: Carline</h4>
                <p>Âge: 5 ans</p>
                <p>Sexe: Male</p>
                <p>Taille : 26 cm</p>
                <p>Poids : 4,05 kg:</p>
                <a href="American Shorthair.php" class="button-slide">Voir plus</a>
            </div>
        </div>
        <div class="card">
            <div class="card-image">
                <img src="Images/Alaskan Klee Kai gris blanc.jpg" alt="Alaskan Klee Kai">
            </div>
            <div class="card-content">
                <h3>Race: Alaskan Klee Kai</h3>
                <h4>Nom: Reyline</h4>
                <p>Âge: 10 ans</p>    
                <p>Sexe: Femelle</p>
                <p>Taille: 38 cm</p>
                <p>Poids: 8 kg</p>
                <a href="Alaskan_Klee.php" class="button-slide">Voir plus</a>
            </div>
        </div>
    </div>
</body>
</html>