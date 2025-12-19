<?php
require_once 'Connexion.php';
require_once 'Product.php';
$database = new Connexion();
$conn = $database->getConnexion();
$product = new Product();
$product->findOneById(7);

$product->setPrice(120);
$product->setQuantity(5);
$product->setUpdatedAt(new DateTime());

$result = $product->update();

if ($result) {
    echo "Produit mis à jour avec succès !";
} else {
    echo "Erreur lors de la mise à jour du produit.";
}
