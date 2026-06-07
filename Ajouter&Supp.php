<?php
session_start();
require 'db.php';

// Vérification admin connecté
if (!isset($_SESSION['admin_id'])) {
    header('Location: Admin.php');
    exit();
}

$errors = [];  // ← mettre ICI en premier
$msg = '';

$id_admin = isset($_SESSION['admin_id']) ? (int)$_SESSION['admin_id'] : null;
if (!$id_admin) {
    $errors[] = "Session admin invalide.";
}

// =====================================================
// 1. GESTION DES ACTIONS
// =====================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {

    $action = $_POST['action'];

    // AJOUTER UN ANIMAL
    if ($action === 'add') {
        $nom          = trim($_POST['nom'] ?? '');
        $date_naissance = $_POST['date_naissance'] ?? null;
        $taille       = $_POST['taille'] ?? null;
        $poids        = $_POST['poids'] ?? null;
        $couleur      = $_POST['couleur'] ?? '';
        $sexe         = $_POST['sexe'] ?? '';
        $comportement = $_POST['comportement'] ?? null;
        $statut       = $_POST['statut'] ?? '';
        $id_type_race = (int)($_POST['id_type_race'] ?? 0);  // UN SEUL champ de race
        $id_adoptant  = null;

        if ($action === 'add') {
            /*var_dump([
                'session_admin_id' => $_SESSION['admin_id'] ?? 'VIDE',
                'id_type_race'     => $_POST['id_type_race'] ?? 'VIDE',
            ]);
    die();
    // ... reste du code*/
        }
        if (empty($errors)) {
            try {
                // INSERTION
                $sql = "INSERT INTO Animal
                    (date_naissance, nom, taille, poids, couleur, sexe, comportement, statut, ID_adoptant, ID_type_race, ID_admin)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    $date_naissance,
                    $nom,
                    $taille,
                    $poids,
                    $couleur,
                    $sexe,
                    $comportement,
                    $statut,
                    $id_adoptant,
                    $id_type_race,
                    $id_admin
                ]);

                // Récupérer l'ID de l'animal créé
                $id_animal_cree = $pdo->lastInsertId();

                // PHOTO
                $nom_fichier = $_FILES['photo']['name'];

                if (move_uploaded_file($_FILES['photo']['tmp_name'], "Images/" . $nom_fichier)) {
                    $stmtP = $pdo->prepare("INSERT INTO Photo (photo_chemin, ID_animal) VALUES (?, ?)");
                    $stmtP->execute([$nom_fichier, $id_animal_cree]);
                }

                // REDIRECTION SELON ESPÈCE
                $stmtEspece = $pdo->prepare("
                    SELECT e.nom_espece
                    FROM Type_race r
                    INNER JOIN Espece e ON r.ID_espece = e.ID_espece
                    WHERE r.ID_type_race = ?
                ");
                $stmtEspece->execute([$id_type_race]);
                $espece = $stmtEspece->fetch(PDO::FETCH_ASSOC);

                if ($espece) {
                    $nom_espece = strtolower($espece['nom_espece']);
                    if ($nom_espece === 'chien') {
                        header('Location: Chien.php');
                        exit();
                    } elseif ($nom_espece === 'chat') {
                        header('Location: Chat.php');
                        exit();
                    }
                }

                $msg = "L'animal $nom a été ajouté avec succès !";

            } catch (Exception $e) {
                $errors[] = "Erreur lors de l'ajout : " . $e->getMessage();
            }
        }
    }

    // SUPPRESSION
    if ($action === 'delete' && isset($_POST['id'])) {
        try {
            $stmt = $pdo->prepare("DELETE FROM Animal WHERE ID_animal = ?");
            $stmt->execute([$_POST['id']]);
            $msg = "Suppression effectuée avec succès.";
        } catch (Exception $e) {
            $errors[] = "Erreur lors de la suppression : " . $e->getMessage();
        }
    }
}

// Modification
    if ($action === 'update' && isset($_POST['id'])) {
        try {
            $stmt = $pdo->prepare("Update Animal SET ID_animal = ?, date_naissance=?, nom=?, taille=?, poids=?, couleur=?");
            $stmt->execute([$_POST['id']]);
            $msg = "Modification effectuée avec succès.";
        } catch (Exception $e) {
            $errors[] = "Erreur lors de la modification : " . $e->getMessage();
        }
    }


// RÉCUPÉRATION DES RACES
$stmtRaces = $pdo->query("
    SELECT r.ID_type_race, r.nom_race, e.nom_espece
    FROM Type_race r
    LEFT JOIN Espece e ON r.ID_espece = e.ID_espece
");
$races = $stmtRaces->fetchAll(PDO::FETCH_ASSOC);

// RECUPERATION DES ANIMAUX
$stmtAnimaux = $pdo->query("
    SELECT a.ID_animal, a.nom, a.sexe, a.statut, r.nom_race
    FROM Animal a
    LEFT JOIN Type_race r ON a.ID_type_race = r.ID_type_race
    ORDER BY a.nom ASC
");
$animaux = $stmtAnimaux->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Admin - Gestion des Animaux</title>
  <link rel="stylesheet" href="css/ajout_supp.css">
  <style>
    body { font-family: Arial, sans-serif; max-width: 900px; margin: auto; padding: 20px;}
    h1, h2 { text-align: center; color: #333; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px;}
    th, td { border: 1px solid #ccc; padding: 10px; text-align: left;}
    th { background-color: #f4f4f4; }
    .error { color: red; font-weight: bold; background: #fee; padding: 10px; border-radius: 5px; margin-bottom: 20px; border: 1px solid red; }
    .msg { color: green; font-weight: bold; text-align: center; padding: 10px; background: #efe; border-radius: 5px; margin-bottom: 20px; border: 1px solid green;}
    label { display: block; margin: 10px 0 5px; font-weight: bold;}
    input, select, textarea { width: 100%; padding: 8px; box-sizing: border-box; }
    button { padding: 10px 20px; margin-top: 15px; cursor: pointer; background: #4CAF50; color: white; border: none; border-radius: 3px; }
    .btn-suppr { background-color:#B52C24; color:white; border:none; cursor:pointer; padding: 5px 10px; }
  </style>
</head>
<body>
  <?php require_once 'header.php'; ?>
  <div class="main-container">
  <h1>Gestion des Animaux</h1>
  <?php if (!empty($errors)): ?>
      <div class="error">
          <?php foreach ($errors as $error): ?>
              <p style="margin: 5px 0;"><?= htmlspecialchars($error) ?></p>
          <?php endforeach; ?>
      </div>
  <?php endif; ?>

  <?php if (!empty($msg)): ?>
      <div class="msg">
          <p style="margin: 0;"><?= htmlspecialchars($msg) ?></p>
      </div>
  <?php endif; ?>

  <div class="admin-form">
      <h2>Ajouter un Animal</h2>
      <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="add" />

        <label>Nom :</label>
        <input type="text" name="nom" required>

        <label>Race / Espèce :</label>
        <select name="id_type_race" required>
          <option value="">-- Sélectionnez une race --</option>
          <optgroup label="Chiens">
            <?php foreach($races as $r): ?>
              <?php if(isset($r['nom_espece']) && strtolower($r['nom_espece']) === 'chien'): ?>
                <option value="<?= $r['ID_type_race'] ?>"><?= htmlspecialchars($r['nom_race']) ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </optgroup>

          <optgroup label="Chats">
            <?php foreach($races as $r): ?>
              <?php if(isset($r['nom_espece']) && strtolower($r['nom_espece']) === 'chat'): ?>
                <option value="<?= $r['ID_type_race'] ?>"><?= htmlspecialchars($r['nom_race']) ?></option>
              <?php endif; ?>
            <?php endforeach; ?>
          </optgroup>
        </select>

        <div style="display:flex; gap:20px;">
            <div style="flex:1;">
                <label>Taille (cm) :</label>
                <input type="number" step="0.01" name="taille">
            </div>
            <div style="flex:1;">
                <label>Poids (kg) :</label>
                <input type="number" step="0.01" name="poids">
            </div>
        </div>

        <label>Date de naissance :</label>
        <input type="date" name="date_naissance" required>

        <label>Sexe :</label>
        <select name="sexe" required>
          <option value="M">Mâle</option>
          <option value="F">Femelle</option>
        </select>

        <label>Couleur :</label>
        <select name="couleur" required>
          <option value="unie">Unie</option>
          <option value="bico">Bicolore</option>
          <option value="trico">Tricolore</option>
        </select>

        <label>Statut :</label>
        <select name="statut" required>
            <option value="A adopter">A adopter</option>
        </select>

        <label>Image :</label>
        <input id="button-img" type="file" name="photo" accept="image/*">

        <button type="submit" class="button-add">Ajouter au refuge</button>
      </form>
  </div>

  <table class="admin-table">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Race</th>
        <th>Sexe</th>
        <th>Statut</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($animaux)): ?>
          <?php foreach($animaux as $a): ?>
          <tr>
            <td><?= htmlspecialchars($a['nom'] ?? '') ?></td>
            <td><?= htmlspecialchars($a['nom_race'] ?? 'Non spécifiée') ?></td>
            <td><?= htmlspecialchars($a['sexe'] ?? '') ?></td>
            <td><?= htmlspecialchars($a['statut'] ?? '') ?></td>
            <td>
              <form method="POST" style="display:inline;" onsubmit="return confirm('Confirmer la suppression de cet animal ?');">
                <input type="hidden" name="action" value="delete" />
                <input type="hidden" name="id" value="<?= $a['ID_animal'] ?>" />
                <button type="submit" class="btn-suppr">Supprimer</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
      <?php else: ?>
          <tr>
              <td colspan="5" style="text-align: center;">Aucun animal enregistré pour le moment.</td>
          </tr>
      <?php endif; ?>
    </tbody>
  </table>
  <p style="text-align:center; margin-top:30px;">
    <a href="index.php" style="text-decoration:none; color:#B52C24; font-weight:bold;">Retour à l'accueil</a>
  </p>
</div>
</body>
</html>