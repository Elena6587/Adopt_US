<?php
session_start();
require 'db.php';

// Vérification admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: Admin.php');
    exit();
}

// Liste des tables à sauvegarder
$tables = ['Animal', 'Adoptant', 'Photo', 'Type_race', 'Espece'];

$message = "";

// Export SQL
if (isset($_POST['export'])) {
    $sqlDump = "-- Sauvegarde BDD Adoptus\n";
    $sqlDump .= "-- Date : " . date('Y-m-d H:i:s') . "\n\n";

    foreach ($tables as $table) {
        try {
            // Structure de la table
            $res = $pdo->query("SHOW CREATE TABLE `$table`");
            $row = $res->fetch(PDO::FETCH_ASSOC);
            $sqlDump .= "DROP TABLE IF EXISTS `$table`;\n";
            $sqlDump .= $row['Create Table'] . ";\n\n";

            // Données
            $rows = $pdo->query("SELECT * FROM `$table`");
            while ($data = $rows->fetch(PDO::FETCH_ASSOC)) {
                $sqlDump .= "INSERT INTO `$table` VALUES(";
                $values = [];
                foreach ($data as $value) {
                    $values[] = ($value === null) ? "NULL" : $pdo->quote($value);
                }
                $sqlDump .= implode(", ", $values) . ");\n";
            }
            $sqlDump .= "\n";

        } catch (PDOException $e) {
            $message = "Erreur sur la table $table : " . $e->getMessage();
        }
    }

    if (empty($message)) {
        // Téléchargement du fichier
        header('Content-Type: application/sql');
        header('Content-Disposition: attachment; filename="sauvegarde_adoptus_' . date('Ymd_His') . '.sql"');
        echo $sqlDump;
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Sauvegarde BDD</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<?php require 'header.php'; ?>
<h1>Sauvegarde de la Base de Données</h1>

<?php if (!empty($message)): ?>
    <p style="color:red; text-align:center;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<div style="text-align:center; margin-top:30px;">
    <form method="POST">
        <button type="submit" name="export" style="padding:10px 20px; font-size:18px;">
            ⬇️ Télécharger la sauvegarde SQL
        </button>
    </form>
</div>

</body>
</html>