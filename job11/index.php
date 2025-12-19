<?php
require_once 'Connexion.php';
require_once 'Product.php';
$database = new Connexion();
$conn = $database->getConnexion();
$clothing = new Clothing();
$clothing->setName("T-shirt oversize");
$clothing->setPhotos(["tshirt.jpg"]);
$clothing->setPrice(25);
$clothing->setQuantity(10);
$clothing->setCategory_id(2);

$clothing->setSize("L");
$clothing->setColor("Noir");
$clothing->setType("T-shirt");
$clothing->setMaterialFee(5);

$clothing->create();
$electronic = new Electronic();
$electronic->setName("Casque Bluetooth");
$electronic->setPhotos(["casque.jpg"]);
$electronic->setPrice(120);
$electronic->setQuantity(4);
$electronic->setCategory_id(3);

$electronic->setBrand("Sony");
$electronic->setWarantyFee(20);

$electronic->create();
