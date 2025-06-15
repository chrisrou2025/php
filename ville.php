<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la ville</title>
    <link rel="stylesheet" href="styles.css"> </head>

<body>
    <header id="main-header">
        <div class="row-limit-size">
            <h1>Détails de la ville</h1>
            <nav>
                <a href="recherche.php">Retour à la recherche</a>
            </nav>
        </div>
    </header>

    <div class="row-limit-size">
        <?php
        try {
            // Établit la connexion à la base de données
            $bdd = new PDO('mysql:host=localhost;dbname=france', 'root', 'root');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Définit le mode d'erreur sur l'exception

            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $ville_id = (int) $_GET['id']; // Convertit l'ID en entier pour la sécurité

                // Prépare la requête SQL pour récupérer les détails de la ville par son ID
                $sql = "SELECT `ville_nom_reel`, `ville_population_2012`, `ville_departement`, `ville_code_postal`, `ville_longitude_deg`, `ville_latitude_deg` FROM villes_france_free WHERE `ville_id` = :id";
                $req = $bdd->prepare($sql);
                $req->bindParam(':id', $ville_id, PDO::PARAM_INT);
                $req->execute();
                $ville = $req->fetch(PDO::FETCH_ASSOC);

                if ($ville) {
                    // Affiche les détails de la ville
        ?>
                    <div class="ville-details">
                        <h2><?= $ville['ville_nom_reel'] ?></h2>
                        <p><strong>Département :</strong> <?= $ville['ville_departement'] ?></p>
                        <p><strong>Population (2012) :</strong> <?= number_format($ville['ville_population_2012'], 0, ',', ' ') ?> habitants</p>
                        <p><strong>Code Postal :</strong> <?= $ville['ville_code_postal'] ?></p>
                        <p><strong>Coordonnées :</strong> <?= $ville['ville_latitude_deg'] ?>, <?= $ville['ville_longitude_deg'] ?></p>
                        </div>
        <?php
                } else {
                    echo "<p>Aucune ville trouvée avec cet ID.</p>";
                }
            } else {
                echo "<p>Aucun ID de ville spécifié.</p>";
            }
        } catch (PDOException $e) {
            echo "<p>Erreur de connexion à la base de données : " . $e->getMessage() . "</p>";
        }
        ?>
    </div>

</body>

</html>