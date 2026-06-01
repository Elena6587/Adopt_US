<?php
session_start();
require 'db.php';

$error = '';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $mdp = $_POST['mot_de_passe'] ?? '';

    if (!empty($login) && !empty($mdp)) {
        // On cherche si l'utilisateur existe
        $stmt = $pdo->prepare("SELECT * FROM Admin WHERE login = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch();

        if ($user) {
            // Connexion si le mot de passe est bon
            if ($mdp === $user['mot_de_passe']) {
                $_SESSION['admin_id'] = $user['id_admin']; // L’ID réel de l’admin
                header('Location: Ajouter&Supp.php');
                exit();
            }

            } else {
                $error = 'Mot de passe incorrect .';
            }
        } else {
            // CRÉATION AUTOMATIQUE ICI
            $insert = $pdo->prepare("INSERT INTO Admin (login, mot_de_passe) VALUES (?, ?)");
            $insert->execute([$login, $mdp]);
            $msg = "Compte créé, vous pouvez vous connecter.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>Adopt US</title>
</head>
<body>
  <?php require_once 'header.php';?>

<h1>Connexion Admin</h1>
    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>


    <div class="identifiant">
        <form method="POST" action="">
            <label for="identifiant">Identifiant:</label><br>
            <input type="text" id="identifiant" name="login" required><br>
            
            <label for="mdp">Mot de passe:</label><br>
            <input type="password" id="mdp" name="mot_de_passe" required><br>
            </br>
            <button type="submit" name="connection">Se connecter</button>
        </form>
    </div>
  </body>
</head>
</html>