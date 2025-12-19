<?php
require_once 'Connexion.php';
require_once 'Product.php';
$database = new Connexion();
$conn = $database->getConnexion();
$product = new Product();
$result = $product->findOneById(1);

if ($result) {
    echo "<h2>Produit trouvé :</h2>";
    echo "<p>Nom : " . $product->getName() . "</p>";
    echo "<p>Prix : " . $product->getPrice() . " €</p>";
    echo "<img src='" . $product->getPhotos()[0] . "' alt='" . $product->getName() . "' width='100'>";
} else {
    echo "Produit non trouvé.";
}
