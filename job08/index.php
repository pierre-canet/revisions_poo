<?php
require_once 'Connexion.php';
require_once 'Product.php';
$database = new Connexion();
$conn = $database->getConnexion();

$allProducts = Product::findAll();

if (!empty($allProducts)) {
    echo "<h2>Liste des produits :</h2>";
    foreach ($allProducts as $prod) {
        echo "<p>{$prod->getName()} - Prix : {$prod->getPrice()} €</p>";
        echo "<img src='{$prod->getPhotos()[0]}' alt='{$prod->getName()}' width='100'><br>";
    }
} else {
    echo "Aucun produit trouvé.";
}
