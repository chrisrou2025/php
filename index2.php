<?php

function direBonjour($prenom)
{

    echo "Bonjour, " . $prenom . " !";
}

direBonjour("Christian");

echo "<br>";

function calculerAireRectangle($longueur, $largeur)
{

    $aire = $longueur * $largeur;

    return $aire;
}

$resultat = calculerAireRectangle(10, 5);

echo "L'aire du rectangle est : " . $resultat;

echo "<br>";

function estMajeur($age) {
    // Si l'âge est supérieur ou égal à 18, retourner true
    if ($age >= 18) {
        return true;
    } else {
        // Sinon, retourner false
        return false;
    }
}

// Exemple d'utilisation de la fonction
$age_utilisateur = 20; // Vous pouvez modifier cette valeur pour tester

// Utilisation de la fonction pour déterminer le statut
if (estMajeur($age_utilisateur)) {
    echo "Vous êtes majeur.";
} else {
    echo "Vous êtes mineur.";
}

echo "<br>";

function estPair($nombre) {
  // Un nombre est pair si le reste de sa division par 2 est 0.
  if ($nombre % 2 == 0) {
    return true;
  } else {
    return false;
  }
}

// Exemples d'utilisation :
$nombre1 = 4;
$nombre2 = 7;
$nombre3 = 0;
$nombre4 = -2;
$nombre5 = -3;

echo "$nombre1 est pair : " . (estPair($nombre1) ? 'true' : 'false') . "<br>"; // Affiche "4 est pair : true"
echo "$nombre2 est pair : " . (estPair($nombre2) ? 'true' : 'false') . "<br>"; // Affiche "7 est pair : false"
echo "$nombre3 est pair : " . (estPair($nombre3) ? 'true' : 'false') . "<br>"; // Affiche "0 est pair : true"
echo "$nombre4 est pair : " . (estPair($nombre4) ? 'true' : 'false') . "<br>"; // Affiche "-2 est pair : true"
echo "$nombre5 est pair : " . (estPair($nombre5) ? 'true' : 'false') . "<br>"; // Affiche "-3 est pair : false"

echo "<br>";

function convertirCelsiusEnFahrenheit($celsius) {
  // Formule de conversion: F = C * 1.8 + 32
  $fahrenheit = ($celsius * 1.8) + 32;
  return $fahrenheit;
}

// Exemples d'utilisation :
$celsius1 = 0;   // Point de congélation de l'eau
$celsius2 = 25;  // Une température ambiante agréable
$celsius3 = 100; // Point d'ébullition de l'eau
$celsius4 = -10; // Température froide

echo "$celsius1 °C équivaut à " . convertirCelsiusEnFahrenheit($celsius1) . " °F<br>";
echo "$celsius2 °C équivaut à " . convertirCelsiusEnFahrenheit($celsius2) . " °F<br>";
echo "$celsius3 °C équivaut à " . convertirCelsiusEnFahrenheit($celsius3) . " °F<br>";
echo "$celsius4 °C équivaut à " . convertirCelsiusEnFahrenheit($celsius4) . " °F<br>";

echo "<br>";

function compterVoyelles($texte) {
  $nombreVoyelles = 0;
  // Convertir le texte en minuscules pour simplifier la comparaison
  $texteMinuscules = strtolower($texte);

  // Définir la liste des voyelles
  $voyelles = ['a', 'e', 'i', 'o', 'u', 'y'];

  // Parcourir chaque caractère de la chaîne
  for ($i = 0; $i < strlen($texteMinuscules); $i++) {
    $caractere = $texteMinuscules[$i];
    // Vérifier si le caractère est une voyelle
    if (in_array($caractere, $voyelles)) {
      $nombreVoyelles++;
    }
  }

  return $nombreVoyelles;
}

// Exemples d'utilisation :
$texte1 = "Bonjour le Monde";
$texte2 = "PHP est amusant";
$texte3 = "Rythme";
$texte4 = "AEIOU";
$texte5 = "xyz";
$texte6 = "";

echo "Le texte \"$texte1\" contient " . compterVoyelles($texte1) . " voyelles.<br>"; // Attendu : 5 (o, ou, e, o, e)
echo "Le texte \"$texte2\" contient " . compterVoyelles($texte2) . " voyelles.<br>"; // Attendu : 5 (e, a, u, a)
echo "Le texte \"$texte3\" contient " . compterVoyelles($texte3) . " voyelles.<br>"; // Attendu : 1 (y)
echo "Le texte \"$texte4\" contient " . compterVoyelles($texte4) . " voyelles.<br>"; // Attendu : 5
echo "Le texte \"$texte5\" contient " . compterVoyelles($texte5) . " voyelles.<br>"; // Attendu : 0
echo "Le texte \"$texte6\" contient " . compterVoyelles($texte6) . " voyelles.<br>"; // Attendu : 0

echo "<br>";

function genererMotDePasse($longueur) {
  // Définir les caractères possibles : lettres (majuscules et minuscules) et chiffres
  $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  $motDePasse = '';
  $longueurCaracteres = strlen($caracteres);

  // Vérifier si la longueur demandée est valide
  if ($longueur <= 0) {
    return "La longueur du mot de passe doit être supérieure à 0.";
  }

  // Construire le mot de passe caractère par caractère
  for ($i = 0; $i < $longueur; $i++) {
    // Choisir un caractère aléatoire parmi tous les caractères possibles
    $indexAleatoire = rand(0, $longueurCaracteres - 1);
    $motDePasse .= $caracteres[$indexAleatoire];
  }

  return $motDePasse;
}

// Exemples d'utilisation :
echo "Mot de passe de 8 caractères : " . genererMotDePasse(8) . "<br>";
echo "Mot de passe de 12 caractères : " . genererMotDePasse(12) . "<br>";
echo "Mot de passe de 16 caractères : " . genererMotDePasse(16) . "<br>";
echo "Mot de passe de 0 caractères : " . genererMotDePasse(0) . "<br>"; // Exemple d'erreur

echo "<br>";


function formaterDateFr($date) {
  // Crée un objet DateTime à partir de la chaîne de date YYYY-MM-DD
  $objetDate = DateTime::createFromFormat('Y-m-d', $date);

  // Vérifie si la création de l'objet DateTime a réussi
  if ($objetDate === false) {
    return "Format de date invalide. Attendu : YYYY-MM-DD";
  }

  // Formate l'objet DateTime au format JJ/MM/AAAA
  return $objetDate->format('d/m/Y');
}

// Exemples d'utilisation :
$date1 = "2023-10-26";
$date2 = "2024-01-01";
$date3 = "2025-12-31";
$date4 = "2023/10/26"; // Format incorrect
$date5 = "2023-2-5";   // Format correct mais mois/jour avec un seul chiffre

echo "Date originale : $date1 => Date formatée : " . formaterDateFr($date1) . "<br>";
echo "Date originale : $date2 => Date formatée : " . formaterDateFr($date2) . "<br>";
echo "Date originale : $date3 => Date formatée : " . formaterDateFr($date3) . "<br>";
echo "Date originale : $date4 => Date formatée : " . formaterDateFr($date4) . "<br>"; // Devrait afficher un message d'erreur
echo "Date originale : $date5 => Date formatée : " . formaterDateFr($date5) . "<br>"; // Fonctionne grâce à createFromFormat qui est tolérant

echo "<br>";

function trouverMax($tab) {
  // Vérifier si le tableau est vide
  if (empty($tab)) {
    return "Le tableau est vide."; // Ou lancer une exception, selon le comportement souhaité
  }

  // Initialiser la variable du maximum avec le premier élément du tableau
  $max = $tab[0];

  // Parcourir le reste du tableau pour trouver le plus grand nombre
  for ($i = 1; $i < count($tab); $i++) {
    if ($tab[$i] > $max) {
      $max = $tab[$i];
    }
  }

  return $max;
}

// Exemples d'utilisation :
$tableau1 = [10, 5, 20, 8, 15];
$tableau2 = [3, 9, 1, 6, 2];
$tableau3 = [-5, -1, -10, -3];
$tableau4 = [7];
$tableau5 = []; // Tableau vide

echo "Le maximum du tableau 1 est : " . trouverMax($tableau1) . "<br>"; // Attendu : 20
echo "Le maximum du tableau 2 est : " . trouverMax($tableau2) . "<br>"; // Attendu : 9
echo "Le maximum du tableau 3 est : " . trouverMax($tableau3) . "<br>"; // Attendu : -1
echo "Le maximum du tableau 4 est : " . trouverMax($tableau4) . "<br>"; // Attendu : 7
echo "Le maximum du tableau 5 est : " . trouverMax($tableau5) . "<br>"; // Attendu : Le tableau est vide.

?>
