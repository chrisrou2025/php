<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $bdd = new PDO('mysql:host=localhost;dbname=france', 'root', 'root');
    $req = $bdd->query('SELECT `ville_id` , `ville_nom` , `ville_population_2012` FROM `villes_france_free` LIMIT 100');
    $villes = $req->fetchAll(PDO::FETCH_ASSOC);
    ?>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Nom de la ville</th>
        <th>Population 2012</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($villes as $ville) { ?>
        <tr>
            <td><?= $ville['ville_id']; ?></td>
            <td><?= $ville['ville_nom']; ?></td>
            <td><?= $ville['ville_population_2012']; ?></td>
            <td><a href="ville-voir.php?id=<?= $ville['ville_id']; ?>">Voir</a> | 
                <a href="ville-modifier.php?id=<?= $ville['ville_id']; ?>">Modifier</a> | 
                <a href="ville-supprimer.php?id=<?= $ville['ville_id']; ?>">Supprimer</a></td>
        </tr>
    <?php } ?>
</body>

</html>