<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recherche</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- <?php
    $bdd = new PDO('mysql:host=localhost;dbname=france', 'root', 'root');
    $req = $bdd->query('SELECT `ville_nom` FROM `villes_france_free` WHERE `ville_nom` LIKE :search ORDER BY `ville_nom` ASC LIMIT 10');
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $villes = $req->fetchAll(PDO::FETCH_ASSOC);
    ?> -->
<!-- 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const searchButton = document.getElementById('SearchButton');

            searchButton.addEventListener('click', function () {
                const query = searchInput.value.trim();<
                if (query) {
                    window.location.href = `recherche-villes.php?search=${encodeURIComponent(query)}`;
                }
            });

            searchInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    searchButton.click();
                }
            });
        });
    </script> -->

    <h1>Lancer une recherche !</h1>
    <div class="search-input-container">
        <input type="text" name="searchInput" id="search" placeholder="Que recherchez vous ?">
        <button id="SearchButton">Rechercher</button>
    </div>
    <div class="results">
        <?php if ($search): ?>
            <h2>Résultats pour "<?php echo htmlspecialchars($search); ?>"</h2>
            <ul>
                <?php foreach ($villes as $ville): ?>
                    <li><?php echo htmlspecialchars($ville['ville_nom']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun résultat trouvé.</p>
        <?php endif; ?> 
</body>

</html>