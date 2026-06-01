<?php
session_start();
require_once 'db.php';

$isAdmin = (isset($_SESSION['user']) && $_SESSION['user'] === 'admin');

$tri_nom  = $_GET['tri']     ?? 'A-Z';
$sexe     = $_GET['sexe']    ?? 'tous';
$age_cat  = $_GET['age_cat'] ?? 'tous';
$taille   = $_GET['taille']  ?? 'tous';
$couleur  = $_GET['couleur'] ?? 'tous';

$chats = [
    ['nom' => 'Galos',    'race' => 'American Curl',      'sexe' => 'F', 'age' => 10,  'taille' => 32.00, 'poids' => '2,25', 'couleur' => 'unie',  'img' => 'American Curl blanc gris.jpg',           'page' => 'American Curl.php'],
    ['nom' => 'Carline',  'race' => 'American Shorthair', 'sexe' => 'M', 'age' => 60,  'taille' => 26.00, 'poids' => '4,05', 'couleur' => 'bico',  'img' => 'American Shorthair blond.jpg',           'page' => 'American Shorthair.php'],
    ['nom' => 'Louisian', 'race' => 'Angora Turc',        'sexe' => 'F', 'age' => 204, 'taille' => 34.50, 'poids' => '5',    'couleur' => 'unie',  'img' => 'Angora Turc vert.jpg',                   'page' => 'Angora Turc.php'],
    ['nom' => 'Yanis',    'race' => 'Bleu Russe',         'sexe' => 'M', 'age' => 18,  'taille' => 30.00, 'poids' => '2,05', 'couleur' => 'unie',  'img' => 'Bleu Russe yeux grix.jpg',               'page' => 'Bleu Russe.php'],
    ['nom' => 'Floris',   'race' => 'British Shorthair',  'sexe' => 'F', 'age' => 14,  'taille' => 22.00, 'poids' => '1,16', 'couleur' => 'unie',  'img' => 'British Shorthair gris yeux marron.jpg', 'page' => 'British Shorthair.php'],
    ['nom' => 'Iman',     'race' => 'Cymric',             'sexe' => 'M', 'age' => 336, 'taille' => 31.00, 'poids' => '5,30', 'couleur' => 'trico', 'img' => 'Cymric marron noir.jpg',                 'page' => 'Cymric.php'],
    ['nom' => 'Luna',     'race' => 'Devon Rex',          'sexe' => 'F', 'age' => 276, 'taille' => 26.50, 'poids' => '3,23', 'couleur' => 'unie',  'img' => 'Devon Rex blond.jpg',                    'page' => 'Devon Rex.php'],
    ['nom' => 'Zack',     'race' => 'Havana Brown',       'sexe' => 'M', 'age' => 300, 'taille' => 28.25, 'poids' => '6,08', 'couleur' => 'unie',  'img' => 'Havana Brown noir.jpg',                  'page' => 'Havana.php'],
    ['nom' => 'Rageta',   'race' => 'Maine Coon',         'sexe' => 'F', 'age' => 5,   'taille' => 12.50, 'poids' => '3',    'couleur' => 'bico',  'img' => 'Maine Coon blond orange.jpg',            'page' => 'Maine Coon.php'],
    ['nom' => 'Rekie',    'race' => 'Ocicat',             'sexe' => 'M', 'age' => 9,   'taille' => 19.50, 'poids' => '7',    'couleur' => 'bico',  'img' => 'Ocicat gris noir.jpg',                   'page' => 'Ocicat.php'],
    ['nom' => 'Mariam',   'race' => 'Ocicat',             'sexe' => 'F', 'age' => 180, 'taille' => 33.35, 'poids' => '5',    'couleur' => 'bico',  'img' => 'Ocicat orange blond.jpg',                'page' => 'Mariam.php'],
    ['nom' => 'Simon',    'race' => 'Siamois',            'sexe' => 'M', 'age' => 120, 'taille' => 12.50, 'poids' => '3,08', 'couleur' => 'bico',  'img' => 'Siamois blanc gris.jpg',                 'page' => 'Siamois.php'],
    ['nom' => 'Firone',   'race' => 'Snowshoe',           'sexe' => 'F', 'age' => 36,  'taille' => 30.00, 'poids' => '1,08', 'couleur' => 'trico', 'img' => 'Snowshoe.jpg',                           'page' => 'Snowshoe.php'],
    ['nom' => 'Ruby',     'race' => 'Ragamuffin',         'sexe' => 'M', 'age' => 228, 'taille' => 40.00, 'poids' => '10',   'couleur' => 'bico',  'img' => 'Ragamuffin.jpg',                         'page' => 'Ragamuffin.php'],
];

// =====================================================
// RÉCUPÉRATION DES CHATS DEPUIS LA BDD
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
            AND p.id_photo = (
                SELECT MIN(id_photo) FROM Photo WHERE ID_animal = a.ID_animal
            )
        WHERE LOWER(e.nom_espece) = 'chat'
        AND a.statut = 'A adopter'
        GROUP BY a.ID_animal
    ");
    $stmtDB->execute();
    $chatsDB = $stmtDB->fetchAll(PDO::FETCH_ASSOC);

    // Noms déjà dans le tableau en dur (pour éviter les doublons)
    $nomsExistants = array_map(fn($c) => strtolower($c['nom']), $chats);

    foreach ($chatsDB as $c) {
        // Si le chat est déjà dans le tableau en dur → on skip
        if (in_array(strtolower($c['nom']), $nomsExistants)) {
            continue;
        }

        $ageMois = 0;
        if (!empty($c['date_naissance'])) {
            $naissance = new DateTime($c['date_naissance']);
            $now = new DateTime();
            $ageMois = (int)($naissance->diff($now)->days / 30);
        }

        $chats[] = [
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
    $chats = array_values(array_filter($chats, fn($c) => $c['sexe'] === $sexe));
}

// --- Filtre ÂGE (en mois) ---
if ($age_cat === 'junior') {
    $chats = array_values(array_filter($chats, fn($c) => $c['age'] < 24));
} elseif ($age_cat === 'adulte') {
    $chats = array_values(array_filter($chats, fn($c) => $c['age'] >= 24 && $c['age'] < 96));
} elseif ($age_cat === 'senior') {
    $chats = array_values(array_filter($chats, fn($c) => $c['age'] >= 96));
}

// --- Filtre TAILLE (en cm) ---
if ($taille === 'petit') {
    $chats = array_values(array_filter($chats, fn($c) => $c['taille'] <= 25));
} elseif ($taille === 'moyen') {
    $chats = array_values(array_filter($chats, fn($c) => $c['taille'] > 25 && $c['taille'] <= 35));
} elseif ($taille === 'grand') {
    $chats = array_values(array_filter($chats, fn($c) => $c['taille'] > 35));
}

// --- Filtre COULEUR ---
if ($couleur !== 'tous') {
    $chats = array_values(array_filter($chats, fn($c) => $c['couleur'] === $couleur));
}

// --- TRI NOM ---
usort($chats, function($a, $b) use ($tri_nom) {
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
  <link rel="stylesheet" href="css/chat.css">
</head>
<body>
  <h1>Chat</h1>
  <?php require_once 'header.php'; ?>
  <br>

<div class="main-container">

    <aside class="search-sidebar">
        <form method="GET" action="chat.php">
            <div class="filter-group">
                <label>Nom :</label>
                <select name="tri">
                    <option value="A-Z" <?= $tri_nom === 'A-Z' ? 'selected' : '' ?>>A → Z</option>
                    <option value="Z-A" <?= $tri_nom === 'Z-A' ? 'selected' : '' ?>>Z → A</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Sexe :</label>
                <select name="sexe">
                    <option value="tous" <?= $sexe === 'tous' ? 'selected' : '' ?>>Tous</option>
                    <option value="M"    <?= $sexe === 'M'    ? 'selected' : '' ?>>Mâle</option>
                    <option value="F"    <?= $sexe === 'F'    ? 'selected' : '' ?>>Femelle</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Âge :</label>
                <select name="age_cat">
                    <option value="tous"   <?= $age_cat === 'tous'   ? 'selected' : '' ?>>Tous</option>
                    <option value="junior" <?= $age_cat === 'junior' ? 'selected' : '' ?>>Moins de 2 ans</option>
                    <option value="adulte" <?= $age_cat === 'adulte' ? 'selected' : '' ?>>Adulte (2 à 8 ans)</option>
                    <option value="senior" <?= $age_cat === 'senior' ? 'selected' : '' ?>>Senior (+ de 8 ans)</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Taille :</label>
                <select name="taille">
                    <option value="tous"  <?= $taille === 'tous'  ? 'selected' : '' ?>>Tous</option>
                    <option value="petit" <?= $taille === 'petit' ? 'selected' : '' ?>>Petit (≤ 25 cm)</option>
                    <option value="moyen" <?= $taille === 'moyen' ? 'selected' : '' ?>>Moyen (26 à 35 cm)</option>
                    <option value="grand" <?= $taille === 'grand' ? 'selected' : '' ?>>Grand (+ de 35 cm)</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Couleur :</label>
                <select name="couleur">
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
            <div class="card add-card" onclick="window.location.href='formulaire_ajout.php?type=chat'">
                <div class="add-icon">+</div>
                <p>Ajouter un chat</p>
            </div>
        <?php endif; ?>

        <?php if (empty($chats)): ?>
            <p>Aucun chat ne correspond à vos critères.</p>
        <?php else: ?>
            <?php foreach ($chats as $c): ?>
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