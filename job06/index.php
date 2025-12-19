<?php
require_once 'Connexion.php';
require_once 'Product.php';
$database = new Connexion();
$conn = $database->getConnexion();

$category = new Category(1);


$products = $category->getProducts();

if (!empty($products)) {
    echo "<h2>Produits de la catégorie '{$category->getName()}' :</h2>";
    foreach ($products as $prod) {
        echo "<p>{$prod->getName()} - Prix : {$prod->getPrice()} €</p>";
        echo "<img src='{$prod->getPhotos()[0]}' alt='{$prod->getName()}' width='100'><br>";
    }
} else {
    echo "Aucun produit dans cette catégorie.";
}
