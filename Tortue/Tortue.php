<?php
session_start();
require_once 'db.php';

$isAdmin = (isset($_SESSION['user']) && $_SESSION['user'] === 'admin');

$tri_nom  = $_GET['Input'][1] ?? 'A-Z';
$sexe     = $_GET['Input'][2] ?? 'tous';
$age_cat  = $_GET['Input'][3] ?? 'tous';
$taille   = $_GET['Input'][4] ?? 'tous';
$couleur  = $_GET['Input'][5] ?? 'tous';

$tortues = [
    ['nom' => 'Wiler',    'race' => 'Apalone Ferox',            'sexe' => 'F', 'age' => 9,  'taille' => 8.47, 'poids' => '5.87',  'couleur' => 'bico', 'img' => 'apalone.jpg',           'page' => 'Wiler.php'],
    ['nom' => 'Amin',  'race' => 'Apalone Mutica',              'sexe' => 'M', 'age' => 11, 'taille' => 9.27, 'poids' => '1.02',     'couleur' => 'unie',  'img' => 'Apalone_mutica.jpg',                'page' => 'Amin.php'],
    ['nom' => 'Julia',    'race' => 'Apalone Spinifera',        'sexe' => 'F', 'age' => 13,  'taille' => 9.94, 'poids' => '10.08',     'couleur' => 'bico',  'img' => 'Apalone_spinifera.jpg',              'page' => 'Julia.php'],
    ['nom' => 'Urion',     'race' => 'Tortue Geo',              'sexe' => 'M', 'age' => 6,  'taille' => 5.77, 'poids' => '8.46', 'couleur' => 'unie',  'img' => 'tortue_geo.jpg',             'page' => 'Urion.php'],
];

// =====================================================
// RÉCUPÉRATION DES Tortues DEPUIS LA BDD
// =====================================================
try {
    $stmtDB = $pdo->prepare("
    SELECT
        a.nom,
        a.sexe,
        a.taille,
        a.poids,
        a.couleur,
        a.date_naissance,
        r.nom_race,
        p.photo_chemin
    FROM Animal a
    INNER JOIN Type_race r ON a.ID_type_race = r.ID_type_race
    INNER JOIN Espece e ON r.ID_espece = e.ID_espece
    LEFT JOIN Photo p ON p.ID_animal = a.ID_animal
        AND p.ID_photo = (
            SELECT MIN(ID_photo) FROM Photo WHERE ID_animal = a.ID_animal
        )
    WHERE LOWER(e.nom_espece) = 'tortue'
    AND a.statut = 'A adopter'
    GROUP BY a.ID_animal
");
    $stmtDB->execute();
    $tortuesDB = $stmtDB->fetchAll(PDO::FETCH_ASSOC);

    // Noms déjà dans le tableau en dur (pour éviter les doublons)
    $nomsExistants = array_map(fn($t) => strtolower($t['nom']), $tortues);

    foreach ($tortuesDB as $t) {
        // Si le chien est déjà dans le tableau en dur → on skip
        if (in_array(strtolower($t['nom']), $nomsExistants)) {
            continue;
        }

        $ageMois = 0;
        if (!empty($c['date_naissance'])) {
            $naissance = new DateTime($c['date_naissance']);
            $now = new DateTime();
            $ageMois = (int)($naissance->diff($now)->days / 30);
        }

        $chiens[] = [
            'nom'     => $c['nom'],
            'race'    => $c['nom_race'],
            'sexe'    => $c['sexe'],
            'age'     => (int)$ageMois,
            'taille'  => (float)($c['taille'] ?? 0),
            'poids'   => $c['poids'] ?? '0',
            'couleur' => $c['couleur'] ?? 'unie',
            'img'     => null,
            'imgDB'   => $c['photo_chemin'],
            'page'    => '#',
        ];
    }
} catch (Exception $e) {
    // Si erreur BDD, on continue avec le tableau en dur uniquement
}

// --- Filtre SEXE ---
if ($sexe !== 'tous') {
    $tortues = array_values(array_filter($tortues, fn($t) => $t['sexe'] === $sexe));
}

// --- Filtre ÂGE (en mois) ---
if ($age_cat === 'junior') {
    $tortues = array_values(array_filter($tortues, fn($t) => $t['age'] < 24));
} elseif ($age_cat === 'adulte') {
    $tortues = array_values(array_filter($tortues, fn($t) => $t['age'] >= 24 && $t['age'] < 96));
} elseif ($age_cat === 'senior') {
    $tortues = array_values(array_filter($tortues, fn($t) => $t['age'] >= 96));
}

// --- Filtre TAILLE (en cm) ---
if ($taille === 'petit') {
    $tortues = array_values(array_filter($tortues, fn($t) => $t['taille'] <= 35));
} elseif ($taille === 'moyen') {
    $tortues = array_values(array_filter($tortues, fn($t) => $t['taille'] > 35 && $t['taille'] <= 55));
} elseif ($taille === 'grand') {
    $tortues = array_values(array_filter($tortues, fn($t) => $t['taille'] > 55));
}

// --- Filtre COULEUR ---
if ($couleur !== 'tous') {
    $tortues = array_values(array_filter($tortues, fn($t) => $t['couleur'] === $couleur));
}

// --- TRI NOM ---
usort($tortues, function($a, $b) use ($tri_nom) {
    return $tri_nom === 'A-Z'
        ? strcmp($a['nom'], $b['nom'])
        : strcmp($b['nom'], $a['nom']);
});

function afficherAge(int $mois): string {
    $ans   = floor($mois / 12);
    $reste = $mois % 12;
    if ($ans > 0 && $reste > 0) return "{$ans} ans et {$reste} mois";
    if ($ans > 0)                return "{$ans} ans";
    return "{$reste} mois";
}
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="css/tortue.css">
</head>
<body>
  <h1>Tortues</h1>
  <?php require_once 'header.php'; ?>
  <br>

<div class="main-container">

    <aside class="search-sidebar">
        <form method="GET" action="tortue.php">
            <div class="filter-group">
                <label>Nom :</label>
                <select name="Input[1]">
                    <option value="A-Z" <?= $tri_nom === 'A-Z' ? 'selected' : '' ?>>A → Z</option>
                    <option value="Z-A" <?= $tri_nom === 'Z-A' ? 'selected' : '' ?>>Z → A</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Sexe :</label>
                <select name="Input[2]">
                    <option value="tous" <?= $sexe === 'tous' ? 'selected' : '' ?>>Tous</option>
                    <option value="M"    <?= $sexe === 'M'    ? 'selected' : '' ?>>Mâle</option>
                    <option value="F"    <?= $sexe === 'F'    ? 'selected' : '' ?>>Femelle</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Âge :</label>
                <select name="Input[3]">
                    <option value="tous"   <?= $age_cat === 'tous'   ? 'selected' : '' ?>>Tous</option>
                    <option value="junior" <?= $age_cat === 'junior' ? 'selected' : '' ?>>Moins de 2 ans</option>
                    <option value="adulte" <?= $age_cat === 'adulte' ? 'selected' : '' ?>>Adulte (2 à 8 ans)</option>
                    <option value="senior" <?= $age_cat === 'senior' ? 'selected' : '' ?>>Senior (+ de 8 ans)</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Taille :</label>
                <select name="Input[4]">
                    <option value="tous"  <?= $taille === 'tous'  ? 'selected' : '' ?>>Tous</option>
                    <option value="petit" <?= $taille === 'petit' ? 'selected' : '' ?>>Petit (≤ 35 cm)</option>
                    <option value="moyen" <?= $taille === 'moyen' ? 'selected' : '' ?>>Moyen (36 à 55 cm)</option>
                    <option value="grand" <?= $taille === 'grand' ? 'selected' : '' ?>>Grand (+ de 55 cm)</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Couleur :</label>
                <select name="Input[5]">
                    <option value="tous"  <?= $couleur === 'tous'  ? 'selected' : '' ?>>Tous</option>
                    <option value="unie"  <?= $couleur === 'unie'  ? 'selected' : '' ?>>Unicolore</option>
                    <option value="bico"  <?= $couleur === 'bico'  ? 'selected' : '' ?>>Bicolore</option>
                    <option value="trico" <?= $couleur === 'trico' ? 'selected' : '' ?>>Tricolore</option>
                </select>
            </div>
            <button type="submit">Filtrer</button>
        </form>
    </aside>

    <section class="results-grid">

        <?php if ($isAdmin): ?>
            <div class="card add-card" onclick="window.location.href='formulaire_ajout.php?type=chien'">
                <div class="add-icon">+</div>
                <p>Ajouter une tortue</p>
            </div>
        <?php endif; ?>

        <?php if (empty($tortue)): ?>
            <p>Aucun tortue ne correspond à vos critères.</p>
        <?php else: ?>
            <?php foreach ($tortue as $t): ?>
                <div class="card">
                    <div class="card-image">
                        <?php $imgSrc = !empty($t['imgDB']) ? 'Images/' . $t['imgDB'] : (!empty($t['img']) ? 'Images/' . $t['img'] : 'Images/default.jpg');?>
                        <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($t['race']) ?>" width="550" onerror="this.src='Images/default.jpg'">
                    </div>
                    <div class="card-content">
                        <h3>Race : <?= htmlspecialchars($t['race']) ?></h3>
                        <h4>Nom : <?= htmlspecialchars($t['nom']) ?></h4>
                        <p>Âge : <?= afficherAge($t['age']) ?></p>
                        <p>Sexe : <?= $t['sexe'] === 'M' ? 'Mâle' : 'Femelle' ?></p>
                        <p>Taille : <?= $t['taille'] ?> cm</p>
                        <p>Poids : <?= $t['poids'] ?> kg</p>
                        <?php if ($isAdmin): ?>
                            <a href="supprimer.php?id=<?= htmlspecialchars($t['nom']) ?>" class="btn-suppr">Supprimer</a>
                        <?php endif; ?>
                        <button onclick="window.location.href='<?= htmlspecialchars($t['page']) ?>'" class="button-slide">Voir plus</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </section>
</div>
</body>
</html>