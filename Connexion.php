<?php
session_start();
require 'db.php'; 

$error = '';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifiant = trim($_POST['identifiant'] ?? '');
    $mdp = $_POST['mdp'] ?? '';

    if (!empty($identifiant) && !empty($mdp)) {
        $stmt = $pdo->prepare("SELECT * FROM Adoptant WHERE identifiant = ?");
        $stmt->execute([$identifiant]);
        $user = $stmt->fetch();

        if ($user) {
            if (password_verify($mdp, $user['mot_de_passe'])) {
                $_SESSION['user'] = 'user'; 
                $_SESSION['user_id'] = $user['ID_adoptant'];
                $_SESSION['user_nom'] = $user['nom'];
                header('Location: index.php');
                exit();
            } else {
                $error = 'Mot de passe incorrect.';
            }
        } else {
            $mdpHache = password_hash($mdp, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO Adoptant (identifiant, mot_de_passe) VALUES (?, ?)");
            
            if ($insert->execute([$identifiant, $mdpHache])) {
                $_SESSION['user'] = 'user';
                $_SESSION['user_id'] = $pdo->lastInsertId();
                $_SESSION['user_nom'] = $identifiant;
                header('Location: Acceuil.php');
                exit();
            } else {
                $error = "Erreur lors de la création du compte.";
            }
        }
    } else {
        $error = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/connexion.css">
    <title>Adopt US</title>
</head>
<body>

<?php require_once 'header.php'; ?>

<h1>Connexion Client</h1>

<?php if ($error): ?>
    <div class="error" style="color: red; text-align: center; margin-bottom: 15px; font-weight: bold;"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="identifiant">
    <form method="POST" action="">
        <label for="identifiant">Identifiant:</label><br>
        <input type="text" id="identifiant" name="identifiant" required><br>

        <label for="mdp">Mot de passe:</label><br>
        <input type="password" id="mdp" name="mdp" required><br><br>

        <button type="submit" name="connection">Se connecter</button>
    </form>
</div>
</body>
</html>