<?php
// recherche_ville.php - Gestion de la recherche de villes avec PDO et requêtes préparées

// --- Configuration de la base de données ---
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "root"; // Votre mot de passe pour la base de données
$dbName = "france"; // Le nom de votre base de données

// --- Connexion à la base de données avec PDO ---
try {
    $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    // Configurer PDO pour lancer des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Configurer le mode de récupération par défaut (ex: tableaux associatifs)
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // En cas d'erreur de connexion, affiche un message et arrête le script
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// --- Initialisation des variables ---
$searchResults = []; // Tableau pour stocker les noms de villes trouvées
$searchQuery   = ''; // Chaîne de recherche soumise par l'utilisateur

// --- Traitement de la recherche si le formulaire est soumis ---
if (isset($_POST['search_city']) && !empty($_POST['search_city'])) {
    // Nettoyage de la chaîne de recherche (trim pour les espaces, pas besoin d'échapper ici grâce à prepare())
    $searchQuery = trim($_POST['search_city']); 

    // --- Préparation de la requête SQL ---
    // Utilisation d'un placeholder (ex: :query) pour l'injection sécurisée des données
    $sql = "SELECT ville_nom_reel FROM villes_france_free WHERE ville_nom_reel LIKE :query LIMIT 30"; 
    
    try {
        $stmt = $pdo->prepare($sql); // Prépare la requête SQL
        
        // Liaison du paramètre :query. Le '%' est ajouté ici car il fait partie de la valeur du paramètre.
        $stmt->bindValue(':query', $searchQuery . '%', PDO::PARAM_STR); 
        
        $stmt->execute(); // Exécute la requête préparée

        // Récupération de tous les résultats
        $searchResults = $stmt->fetchAll(PDO::FETCH_COLUMN); // PDO::FETCH_COLUMN pour récupérer juste la colonne ville_nom_reel
                                                              // sans avoir un tableau associatif pour chaque ligne (plus direct)
    } catch (PDOException $e) {
        // Gérer les erreurs d'exécution de la requête si nécessaire
        // Pour un exemple simple, on peut juste loguer l'erreur ou afficher un message générique
        error_log("Erreur lors de l'exécution de la requête : " . $e->getMessage());
        // Vous pouvez définir un message d'erreur utilisateur ici si vous le souhaitez
        // $errorMessage = "Une erreur est survenue lors de la recherche.";
    }
}

// Pas besoin de fermer la connexion explicitement avec PDO, elle se ferme à la fin du script.
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche de Ville</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <h1 class="title">Liste de recherche</h1>

    <div class="search-container">
        <form action="" method="post" class="search-form-traditional">
            <input type="text" name="search_city" placeholder="Rechercher une ville..." 
                   value="<?= htmlspecialchars($searchQuery); ?>">
            <button type="submit">Recherche</button> 
        </form>
    </div>

    <div id="results_display" class="results-container">
        <?php 
        // --- Affichage des résultats ---
        if (!empty($searchResults)) {
            $count = 0;
            foreach ($searchResults as $city) {
                if ($count % 3 === 0) { echo '<div class="row">'; }
                
                echo '<div class="city-tile"><p>' . htmlspecialchars($city) . '</p></div>';
                
                if (($count + 1) % 3 === 0 || ($count + 1) === count($searchResults)) { echo '</div>'; }
                $count++;
            }
        } elseif (isset($_POST['search_city'])) { 
            echo '<p class="no-results">Aucune ville trouvée pour votre recherche.</p>';
        }
        ?>
    </div>
</body>
</html>