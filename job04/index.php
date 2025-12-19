<?php
require_once 'Connexion.php';
require_once 'Product.php';
$database = new Connexion();
$conn = $database->getConnexion();


$id = 7;
$sql = "SELECT * FROM product WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $productData = mysqli_fetch_assoc($result);
} else {
    die("Produit non trouvé !");
}

$product = new Product();
$product->setId($productData['id']);
$product->setName($productData['name']);


$product->setPhotos([$productData['photos']]);

$product->setPrice((int)$productData['price']);
$product->setDescription($productData['description']);
$product->setQuantity((int)$productData['quantity']);
$product->setCategory_id((int)$productData['category_id']);


$product->setCreatedAt(new DateTime($productData['createdAt']));
$product->setUpdatedAt(new DateTime($productData['updatedAt']));

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>job04</title>
</head>

<body>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>id</th>
                <th>nom</th>
                <th>photo</th>
                <th>prix</th>
                <th>description</th>
                <th>quantity</th>
                <th>createdAt</th>
                <th>updatedAt</th>
                <th>category_id</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= $product->getId(); ?></td>
                <td><?= $product->getName(); ?></td>
                <td><img src="<?= $product->getPhotos()[0]; ?>" alt="<?= $product->getName(); ?>" width="100"></td>
                <td><?= $product->getPrice(); ?> €</td>
                <td><?= $product->getDescription(); ?></td>
                <td><?= $product->getQuantity(); ?></td>
                <td><?= $product->getCreatedAt()->format('d/m/Y H:i'); ?></td>
                <td><?= $product->getUpdatedAt()->format('d/m/Y H:i'); ?></td>
                <td><?= $product->getCategory_id(); ?></td>
            </tr>
        </tbody>
    </table>

</body>

</html>