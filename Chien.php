<?php
session_start();
require_once 'db.php';

$isAdmin = (isset($_SESSION['user']) && $_SESSION['user'] === 'admin');

$tri_nom  = $_GET['Input'][1] ?? 'A-Z';
$sexe     = $_GET['Input'][2] ?? 'tous';
$age_cat  = $_GET['Input'][3] ?? 'tous';
$taille   = $_GET['Input'][4] ?? 'tous';
$couleur  = $_GET['Input'][5] ?? 'tous';

$chiens = [
    ['nom' => 'Filos',    'race' => 'Jack Russell',             'sexe' => 'M', 'age' => 24,  'taille' => 25, 'poids' => '7,05',  'couleur' => 'trico', 'img' => 'Jack Russell Terrier marron noir.jpg',           'page' => 'Filos.php'],
    ['nom' => 'Reyline',  'race' => 'Alaskan Klee Kai',         'sexe' => 'F', 'age' => 120, 'taille' => 38, 'poids' => '8',     'couleur' => 'bico',  'img' => 'Alaskan Klee Kai gris blanc.jpg',                'page' => 'Alaskan_Klee.php'],
    ['nom' => 'Luxie',    'race' => 'Basenji',                  'sexe' => 'F', 'age' => 12,  'taille' => 40, 'poids' => '9',     'couleur' => 'bico',  'img' => 'Basenji blanc blond ou orange.jpg',              'page' => 'Basenji.php'],
    ['nom' => 'Fate',     'race' => 'Bouledogue Français',      'sexe' => 'M', 'age' => 18,  'taille' => 33, 'poids' => '10.12', 'couleur' => 'bico',  'img' => 'Bouledogue Français blanc noir.jpg',             'page' => 'Bouledogue.php'],
    ['nom' => 'Heline',   'race' => 'Bouledogue Français',      'sexe' => 'M', 'age' => 5,   'taille' => 34, 'poids' => '11.02', 'couleur' => 'bico',  'img' => 'Bouledogue Français blond blanc.jpg',            'page' => 'Heline.php'],
    ['nom' => 'Marco',    'race' => 'Carlin',                   'sexe' => 'F', 'age' => 8,   'taille' => 28, 'poids' => '6.87',  'couleur' => 'unie',  'img' => 'Carlin blond morron noir.jpg',                   'page' => 'Carlin.php'],
    ['nom' => 'Navie',    'race' => 'Chien norvégien de Macareux','sexe' => 'F','age' => 144,'taille' => 34, 'poids' => '7.58',  'couleur' => 'bico',  'img' => 'Chien norvégien de Macareux blond blanc.jpg',    'page' => 'Chien norvégien.php'],
    ['nom' => 'Blue',     'race' => 'Chihuahua',                'sexe' => 'M', 'age' => 120, 'taille' => 20, 'poids' => '2',     'couleur' => 'unie',  'img' => 'Chihuahua blanc.jpg',                           'page' => 'Chihuahua.php'],
    ['nom' => 'Regna',    'race' => 'Chihuahua',                'sexe' => 'F', 'age' => 132, 'taille' => 18, 'poids' => '1,05',  'couleur' => 'bico',  'img' => 'Chihuahua noir marron ou orange.jpg',            'page' => 'Regna.php'],
    ['nom' => 'Dermio',   'race' => 'American Staffordshire',   'sexe' => 'M', 'age' => 4,   'taille' => 47, 'poids' => '30.09', 'couleur' => 'bico',  'img' => 'American Staffordshire Terrier orange blanc.jpg', 'page' => 'Staffordshire.php'],
    ['nom' => 'Tersa',    'race' => 'Anglo-Français',           'sexe' => 'F', 'age' => 228, 'taille' => 49, 'poids' => '21.34', 'couleur' => 'bico',  'img' => 'Anglo-Français de Petite Vènerie blond.jpg',     'page' => 'Anglo-Français.php'],
    ['nom' => 'Rick',     'race' => 'Berger Allemand',          'sexe' => 'M', 'age' => 24,  'taille' => 63, 'poids' => '38.98', 'couleur' => 'bico',  'img' => 'Berger Allemand orange noir.jpg',                'page' => 'Berger.php'],
    ['nom' => 'Amore',    'race' => 'Berger Belge Malinois',    'sexe' => 'F', 'age' => 168, 'taille' => 58, 'poids' => '32',    'couleur' => 'bico',  'img' => 'Berger Belge Malinois blond noir.jpg',           'page' => 'Amore.php'],
    ['nom' => 'Roti',     'race' => 'Braque de Weimar',         'sexe' => 'M', 'age' => 204, 'taille' => 57, 'poids' => '29.15', 'couleur' => 'unie',  'img' => 'Braque de Weimar gris.jpg',                     'page' => 'Braque.php'],
    ['nom' => 'Amanda',   'race' => 'Dalmatien',                'sexe' => 'F', 'age' => 96,  'taille' => 57, 'poids' => '28.40', 'couleur' => 'bico',  'img' => 'Dalmatien.jpg',                                 'page' => 'Dalmatien.php'],
    ['nom' => 'Halbert',  'race' => 'Dobermann',                'sexe' => 'M', 'age' => 84,  'taille' => 72, 'poids' => '45',    'couleur' => 'bico',  'img' => 'Dobermann noir orange.jpg',                     'page' => 'Dobermann.php'],
    ['nom' => 'Roxanie',  'race' => 'Jack Russell',             'sexe' => 'F', 'age' => 36,  'taille' => 38, 'poids' => '5,05',  'couleur' => 'trico', 'img' => 'Jack Russell Terrier marron noir.jpg',           'page' => 'JackRussell.php'],
    ['nom' => 'Damina',   'race' => 'Jagdterrier',              'sexe' => 'M', 'age' => 48,  'taille' => 38, 'poids' => '10',    'couleur' => 'bico',  'img' => 'Jagdterrier.jpg',                               'page' => 'Jagdterrier.php'],
    ['nom' => 'Rika',     'race' => 'Labrador Retriever',       'sexe' => 'F', 'age' => 60,  'taille' => 56, 'poids' => '31.01', 'couleur' => 'unie',  'img' => 'Labrador Retriever blond.jpg',                  'page' => 'Labrador.php'],
    ['nom' => 'Guler',    'race' => 'Pinscher Nain',            'sexe' => 'M', 'age' => 72,  'taille' => 29, 'poids' => '6',     'couleur' => 'unie',  'img' => 'Pinscher Nain marron.jpg',                      'page' => 'Pinscher.php'],
    ['nom' => 'Juliette', 'race' => 'Saint-Bernard',            'sexe' => 'F', 'age' => 108, 'taille' => 80, 'poids' => '78',    'couleur' => 'bico',  'img' => 'Saint-Bernard.jpg',                             'page' => 'Saint-Bernard.php'],
    ['nom' => 'Patique',  'race' => 'Tchouvatch Slovaque',      'sexe' => 'M', 'age' => 96,  'taille' => 65, 'poids' => '44',    'couleur' => 'unie',  'img' => 'Tchouvatch Slovaque blond.jpg',                 'page' => 'Tchouvatch.php'],
    ['nom' => 'Oka',      'race' => 'Teckel',                   'sexe' => 'F', 'age' => 84,  'taille' => 43, 'poids' => '8,05',  'couleur' => 'unie',  'img' => 'Teckel marron.jpg',                             'page' => 'Teckel.php'],
    ['nom' => 'Wonka',    'race' => 'Welsh Corgi Pembroke',     'sexe' => 'M', 'age' => 36,  'taille' => 27, 'poids' => '12,05', 'couleur' => 'trico', 'img' => 'Welsh Corgi Pembroke noir blond.jpg',           'page' => 'Welsh.php'],
];

// =====================================================
// RÉCUPÉRATION DES CHIENS DEPUIS LA BDD
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
    WHERE LOWER(e.nom_espece) = 'chien'
    AND a.statut = 'A adopter'
    GROUP BY a.ID_animal
");
    $stmtDB->execute();
    $chiensDB = $stmtDB->fetchAll(PDO::FETCH_ASSOC);

    // Noms déjà dans le tableau en dur (pour éviter les doublons)
    $nomsExistants = array_map(fn($c) => strtolower($c['nom']), $chiens);

    foreach ($chiensDB as $c) {
        // Si le chien est déjà dans le tableau en dur → on skip
        if (in_array(strtolower($c['nom']), $nomsExistants)) {
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
    $chiens = array_values(array_filter($chiens, fn($c) => $c['sexe'] === $sexe));
}

// --- Filtre ÂGE (en mois) ---
if ($age_cat === 'junior') {
    $chiens = array_values(array_filter($chiens, fn($c) => $c['age'] < 24));
} elseif ($age_cat === 'adulte') {
    $chiens = array_values(array_filter($chiens, fn($c) => $c['age'] >= 24 && $c['age'] < 96));
} elseif ($age_cat === 'senior') {
    $chiens = array_values(array_filter($chiens, fn($c) => $c['age'] >= 96));
}

// --- Filtre TAILLE (en cm) ---
if ($taille === 'petit') {
    $chiens = array_values(array_filter($chiens, fn($c) => $c['taille'] <= 35));
} elseif ($taille === 'moyen') {
    $chiens = array_values(array_filter($chiens, fn($c) => $c['taille'] > 35 && $c['taille'] <= 55));
} elseif ($taille === 'grand') {
    $chiens = array_values(array_filter($chiens, fn($c) => $c['taille'] > 55));
}

// --- Filtre COULEUR ---
if ($couleur !== 'tous') {
    $chiens = array_values(array_filter($chiens, fn($c) => $c['couleur'] === $couleur));
}

// --- TRI NOM ---
usort($chiens, function($a, $b) use ($tri_nom) {
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
  <link rel="stylesheet" href="css/chien.css">
</head>
<body>
  <h1>Chien</h1>
  <?php require_once 'header.php'; ?>
  <br>

<div class="main-container">

    <aside class="search-sidebar">
        <form method="GET" action="chien.php">
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
                <p>Ajouter un chien</p>
            </div>
        <?php endif; ?>

        <?php if (empty($chiens)): ?>
            <p>Aucun chien ne correspond à vos critères.</p>
        <?php else: ?>
            <?php foreach ($chiens as $c): ?>
                <div class="card">
                    <div class="card-image">
                        <?php $imgSrc = !empty($c['imgDB']) ? 'Images/' . $c['imgDB'] : (!empty($c['img']) ? 'Images/' . $c['img'] : 'Images/default.jpg');?>
                        <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($c['race']) ?>" width="550" onerror="this.src='Images/default.jpg'">
                    </div>
                    <div class="card-content">
                        <h3>Race : <?= htmlspecialchars($c['race']) ?></h3>
                        <h4>Nom : <?= htmlspecialchars($c['nom']) ?></h4>
                        <p>Âge : <?= afficherAge($c['age']) ?></p>
                        <p>Sexe : <?= $c['sexe'] === 'M' ? 'Mâle' : 'Femelle' ?></p>
                        <p>Taille : <?= $c['taille'] ?> cm</p>
                        <p>Poids : <?= $c['poids'] ?> kg</p>
                        <?php if ($isAdmin): ?>
                            <a href="supprimer.php?id=<?= htmlspecialchars($c['nom']) ?>" class="btn-suppr">Supprimer</a>
                        <?php endif; ?>
                        <button onclick="window.location.href='<?= htmlspecialchars($c['page']) ?>'" class="button-slide">Voir plus</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

    </section>
</div>
</body>
</html>