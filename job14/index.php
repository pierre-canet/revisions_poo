<?php
require_once 'Connexion.php';
require_once 'Product.php';
require_once 'StockableInterface.php';
$database = new Connexion();
$conn = $database->getConnexion();
$clothing = new Clothing();
$clothing->findOneById(11);

$clothing
    ->addStocks(20)
    ->removeStocks(4)
    ->update();

echo "Stock actuel : " . $clothing->getQuantity();
