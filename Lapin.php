<?php
session_start();
// On crée une variable qui est VRAIE seulement si l'admin est connecté
$estAdmin = (isset($_SESSION['user']) && $_SESSION['user'] === 'admin');
//require_once 'filtre_donnee_chien.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <title>Adopt US</title>
  <link rel="stylesheet" href="lapin.css">
</head>
<body>
  <h1>Lapin</h1>
        <?php if (isset($_SESSION['id_adoptant'])): // Remplace 'id' par ta variable de session active ?>
    <div class="navBarItem">
        <a href="logout.php">Déconnexion</a>
    </div>
<?php endif; ?>
  </div>
  <?php if (isset($_SESSION['id_admin'])): // Remplace 'id' par ta variable de session active ?>
    <div class="navBarItem">
        <a href="logout.php">Déconnexion</a>
    </div>
<?php endif; ?>
  </div>
  <nav class="navBar">
    <div class="navBarItem">
      <a href="index.php">Accueil</a>
    </div>
    <!-- Sous-menu Chien -->
    <div class="navBarItem">
      <a href="Chien.php">Chien</a>
    </div>

    <!-- Sous-menu Chat -->
    <div class="navBarItem">
      <a href="Chat.php">Chat</a>
    </div>

    <div class="navBarItem">
      <a href="Lapin.php">Lapin</a>
    </div>

    <div class="navBarItem">
        <a href="Contact.php">Contact</a></li>
    </div>

     <div class="navBarItem">
        <a href="Ajouter&Supp.php" style="color:rgb(247, 33, 33);" id="admiBtn">Ajout & Suppression</a>
    </div>

     <div class="navBarItem">
      <a href="Admin.php" style="color: rgb(159, 20, 20);" id="admiBtn" >Admin</a>
    </div>

     <div class="navBarItem">
      <a href="Connexion.php" id="connexnBtn">Connexion</a>
    </div>

  <div class="navBarItem">
    <a href="Adopter.php">Adopter</a>
  </div>
</nav>

 <div class="main-container">
    <aside class="search-sidebar">
  <form method="GET" action="filtre_donnee_chien.php"> <div class="filter-group">
      <label>Nom:</label>
      <select name="tri"> <option value="A-Z">A -> Z</option>
        <option value="Z-A">Z -> A</option>
      </select>
    </div>

    <div class="filter-group">
      <label>Sexe:</label>
      <select name="sexe"> <option value="tous">Tous</option>
        <option value="M">Mâle</option>
        <option value="F">Femelle</option>
      </select>
    </div>

    <div class="filter-group">
      <label>Âge:</label>
      <select name="age_cat"> <option value="junior">Moins de 2 ans</option>
        <option value="adulte">Adulte</option>
        <option value="senior">Senior</option>
      </select>
    </div>

    <div class="filter-group">
      <label>Taille:</label>
      <select name="taille"> <option value="petit">0</option>
        <option value="moyen">5</option>
        <option value="grand">8</option>
      </select>
    </div>

    <div class="filter-group">
      <label>Couleur:</label>
      <select name="couleur"> <option value="unie">UnieColor</option>
        <option value="bi">Bicolor</option>
        <option value="tri">TriColor</option>
      </select>
    </div>
    <button type="submit">Filtrer</button> </form>
</aside>

    <section class="results-grid">
    <div class="card" data-sexe="F" data-age="24" data-couleur="blanc">
      <div class="card-image">
        <img src="lapin_blanc_vienne.jpg" alt="Blanc de Vienne" width="550">
      </div>
      <div class="card-content">
        <h3>Race: Blanc de Vienne</h3>
        <h4>NOM: Rosalie</h4>
        <p>AGE: 6 ans</p> 
        <p>SEXE: FEMELLE</p>
        <button onclick="window.location.href='Rosalie.php'" class="button-slide">Voir plus</button>
      </div>
    </div>
    <div class="card" data-sexe="M" data-age="120" data-couleur="blond-brun">
      <div class="card-image">
        <img src="lapin_garenne.jpg" alt="Lapin Garenne" width="550">
      </div>
      <div class="card-content">
        <h3>Race: Garenne</h3>
        <h4>NOM: Remon</h4>
        <p>AGE: 3 ans</p>
        <p>SEXE: MALE</p>
        <button onclick="window.location.href='Lapin_Garenne.php'" class="button-slide">Voir plus</button>
      </div>
    </div>
    <div class="card" data-sexe="F" data-age="12" data-couleur="blanc">
      <div class="card-image">
        <img src="lapin_chinchilla_blanc.jpg" alt="Chinchilla" width="550">
      </div>
      <div class="card-content">
        <h3>Race: Chinchilla</h3>
        <h4>NOM: Luisiane</h4>
        <p>AGE: 7 mois</p>
        <p>SEXE: FEMELLE</p>
        <button onclick="window.location.href='Chinchilla.php'" class="button-slide">Voir plus</button>
      </div>
    </div>
    <div class="card" data-sexe="M" data-age="18" data-couleur="blanc gris">
      <div class="card-image">
        <img src="lapin_chinchilla_gris_blanc.jpg" alt="Chinchilla" width="550">
      </div>
      <div class="card-content">
        <h3>Race: Chinchilla</h3>
        <h4>NOM: Yun</h4>
        <p>AGE: 1 ans</p> 
        <p>SEXE: MALE</p>
        <button onclick="window.location.href='Yun.php'" class="button-slide">Voir plus</button>
      </div>
    </div>
    <div class="card" data-sexe="F" data-age="5" data-couleur="noir blanc">
      <div class="card-image">
        <img src="Lapin_nain_angora.jpg" alt="Nain Angora" width="550">
      </div>
      <div class="card-content">
        <h3>Race: Nain Angora</h3>
        <h4>NOM: Helline</h4>
        <p>AGE: 5 ans</p>
        <p>SEXE: FEMELLE</p>
        <button onclick="window.location.href='Helline.php'" class="button-slide">Voir plus</button>
      </div>
    </div>
    <div class="card" data-sexe="M" data-age="8" data-couleur="blond">
      <div class="card-image">
        <img src="Lapin_nain_tete_de_lion.jpg" alt="Nain Tete De Lion">
      </div>
      <div class="card-content">
        <h3>Race: Nain Tete De Lion</h3>
        <h4>NOM: Eliot</h4>
        <p>AGE: 4 mois</p>
        <p>SEXE: MALE</p>
        <button onclick="window.location.href='Eliot.php'" class="button-slide">Voir plus</button>
      </div>
    </div>
    <div class="card" data-sexe="F" data-age="12" data-couleur="blond noir">
      <div class="card-image">
        <img src="Lapin_belier_nain_tri.jpg" alt="Belier Gain" width="550">
      </div>
      <div class="card-content">
        <h3>Race: Belier Gain</h3>
        <h4>NOM: Fiona</h4>
        <p>AGE: 10 ans</p>
        <p>SEXE: FEMELLE</p>
        <button onclick="window.location.href='Belier_Gain.php'" class="button-slide">Voir plus</button>
      </div>
    </div>

    <section class="container-galerie">
      <?php if ($isAdmin): ?>
        <div class="card add-card" onclick="window.location.href='formulaire_ajout.php?type=lapin'">
            <div class="add-icon">+</div>
            <p>Ajouter un lapin</p>
        </div>
    <?php endif; ?>

    <?php foreach ($chien as $animal): 
        $estArchive = ($animal['statut'] == 'archive');

        // Si c'est archivé et qu'on n'est pas admin, on cache (on passe au suivant)
        if ($estArchive && !$isAdmin) continue;

        // Si c'est archivé, on ajoute la classe "grisee" pour le CSS
        $classeCSS = ($estArchive) ? "card grisee" : "card";
    ?>
        
        <div class="<?php echo $classeCSS; ?>">
            <img src="img/<?php echo $animal['photo_chemin']; ?>" width="100%">
            <div class="card-content">
                <h3><?php echo $animal['nom']; ?></h3>
                <p><b>Race:</b> <?php echo $animal['nom_race']; ?></p>
                <p><b>Âge:</b> <?php echo $animal['age']; ?></p>
                <p><b>Poids:</b> <?php echo $animal['poids']; ?> kg</p>
                <p><b>Taille:</b> <?php echo $animal['taille']; ?> cm</p>
                <p><b>Couleur:</b> <?php echo $animal['couleur']; ?></p>

                <?php if ($isAdmin): ?>
                    <a href="supprimer.php?id=<?php echo $animal['ID_animal']; ?>" class="btn-suppr">
                        Supprimer
                    </a>
                <?php endif; ?>
            </div>
        </div>

    <?php endforeach; ?>
    </section>
</body>
</html>
