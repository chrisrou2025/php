<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche villes</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php
    // Initialise les variables pour éviter les avis "undefined variable" si aucune recherche n'est effectuée
    $resultat = [];
    $nb_resultat = 0;
    $msg = ""; // Message d'information ou d'erreur

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        try {
            // Établit la connexion à la base de données
            $bdd = new PDO('mysql:host=localhost;dbname=france', 'root', 'root');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Définit le mode d'erreur sur l'exception

            // Modifie la requête SQL pour utiliser le placeholder :q et inclure `ville_id`
            $sql = "SELECT `ville_id`, `ville_nom_reel`, `ville_population_2012`, `ville_departement` FROM villes_france_free WHERE `ville_nom_reel` LIKE :q ORDER BY `ville_nom_reel` ASC";

            $req = $bdd->prepare($sql);
            // Ajoute le caractère de pourcentage pour une recherche "commence par".
            $search_term = trim($_GET['search']) . '%'; // Ajout de trim() pour nettoyer les espaces
            $req->bindParam(':q', $search_term, PDO::PARAM_STR);

            $req->execute();
            $nb_resultat = $req->rowCount();
            $resultat = $req->fetchAll(PDO::FETCH_ASSOC); // Récupère les résultats sous forme de tableau associatif

        } catch (PDOException $e) {
            $msg = "<p>Erreur de connexion à la base de données : " . $e->getMessage() . "</p>";
        }
    } else {
        $msg = "<p>Veuillez saisir un terme de recherche.</p>";
    }
    ?>
    <header id="main-header">
        <div class="row-limit-size">
            <h1>Lancer une recherche !</h1>
            <form action="recherche.php" method="get">
                <input type="text" name="search" id="searchInput" placeholder="Que recherchez-vous ?" value="<?= $_GET['search'] ?? '' ?>">
                <button type="submit" id="SearchButton">Rechercher</button>
            </form>
        </div>
    </header>
    <?php
    // Affiche le message d'erreur ou d'invite si applicable
    if (!empty($msg)) {
        echo '<div class="row-limit-size">' . $msg . '</div>';
    }

    if (isset($nb_resultat) && $nb_resultat > 0) {
    ?>
        <div class="row-limit-size">
            <p>Nombre de résultats : <?= $nb_resultat ?></p>
        </div>
        <div id="reponse" class="row-limit-size">
            <?php foreach ($resultat as $ville) : ?>
                <div class='ville'>
                    <h2><?= $ville['ville_nom_reel'] ?></h2>
                    <div class='infos'>
                        <p>Il y a <strong><?= number_format($ville['ville_population_2012'], 0, ',', ' ') ?></strong> habitants.</p>
                        <p>Département : <strong><?= $ville['ville_departement'] ?></strong></p>
                    </div>
                    <a href="ville.php?id=<?= $ville['ville_id'] ?>" class="more"></a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php
    } else if (isset($_GET['search']) && !empty(trim($_GET['search'])) && empty($msg)) {
        // Affiche "Aucun résultat trouvé" uniquement si une recherche a été faite et sans erreur
        echo "<div class='row-limit-size'><p>Aucun résultat trouvé.</p></div>";
    }
    ?>
</body>

</html>