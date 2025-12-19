<?php
require_once 'Connexion.php';
require_once 'Product.php';
$database = new Connexion();
$conn = $database->getConnexion();
$product = new Product();
$product->setName("Dragon miniature");
$product->setPhotos(["https://example.com/dragon.jpg"]);
$product->setPrice(999);
$product->setDescription("Dragon de compagnie très affectueux");
$product->setQuantity(3);
$product->setCategory_id(1);
$product->setCreatedAt(new DateTime());
$product->setUpdatedAt(new DateTime());

$result = $product->create();

if ($result) {
    echo "Produit créé avec succès ! ID : " . $product->getId();
} else {
    echo "Erreur lors de la création du produit.";
}
