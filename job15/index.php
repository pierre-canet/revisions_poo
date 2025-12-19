<?php
require_once __DIR__ . '/vendor/autoload.php';



$database = new \App\Database\Connexion();
$conn = $database->getConnexion();

$clothing = new \App\Clothing();
$clothing->findOneById(10);

$clothing
    ->addStocks(10)
    ->removeStocks(4)
    ->update();

echo "Stock actuel : " . $clothing->getQuantity();
