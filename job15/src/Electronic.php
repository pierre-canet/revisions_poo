<?php

namespace App;

use DateTime;
use App\Abstract\AbstractProduct;
use App\Database\Connexion;

class Electronic extends AbstractProduct
{
    private string $brand = '';
    private int $waranty_fee = 0;
    public function setBrand(string $brand)
    {
        $this->brand = $brand;
    }
    public function setWarantyFee(int $fee)
    {
        $this->waranty_fee = $fee;
    }
    public function getBrand(): string
    {
        return $this->brand;
    }
    public function getWarantyFee(): int
    {
        return $this->waranty_fee;
    }

    public function findOneById(int $id)
    {
        $db = new Connexion();
        $conn = $db->getConnexion();
        $sql = "
            SELECT p.*, e.brand, e.waranty_fee
            FROM product p
            INNER JOIN electronic e ON p.id = e.product_id
            WHERE p.id = $id
        ";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) === 1) {
            $data = mysqli_fetch_assoc($result);
            $this->setId($data['id']);
            $this->setName($data['name']);
            $this->setPhotos([$data['photos']]);
            $this->setPrice((int)$data['price']);
            $this->setDescription($data['description']);
            $this->setQuantity((int)$data['quantity']);
            $this->setCategory_id((int)$data['category_id']);
            $this->setCreatedAt(new DateTime($data['createdAt']));
            $this->setUpdatedAt(new DateTime($data['updatedAt']));
            $this->setBrand($data['brand']);
            $this->setWarantyFee((int)$data['waranty_fee']);
            return $this;
        }
        return false;
    }

    public static function findAll(): array
    {
        $electronics = [];

        $db = new Connexion();
        $conn = $db->getConnexion();

        $sql = "
            SELECT p.*, e.brand, e.waranty_fee
            FROM product p
            INNER JOIN electronic e ON p.id = e.product_id
        ";

        $result = mysqli_query($conn, $sql);

        while ($data = mysqli_fetch_assoc($result)) {
            $electronic = new Electronic();
            $electronic->setId($data['id']);
            $electronic->setName($data['name']);
            $electronic->setPhotos([$data['photos']]);
            $electronic->setPrice((int)$data['price']);
            $electronic->setDescription($data['description']);
            $electronic->setQuantity((int)$data['quantity']);
            $electronic->setCategory_id((int)$data['category_id']);
            $electronic->setCreatedAt(new DateTime($data['createdAt']));
            $electronic->setUpdatedAt(new DateTime($data['updatedAt']));
            $electronic->setBrand($data['brand']);
            $electronic->setWarantyFee((int)$data['waranty_fee']);

            $electronics[] = $electronic;
        }

        return $electronics;
    }

    public function create()
    {
        if (!parent::create()) {
            return false;
        }

        $db = new Connexion();
        $conn = $db->getConnexion();

        $sql = "
            INSERT INTO electronic (product_id, brand, waranty_fee)
            VALUES (
                {$this->getId()},
                '{$this->brand}',
                {$this->waranty_fee}
            )
        ";

        return mysqli_query($conn, $sql) ? $this : false;
    }

    public function update()
    {
        $db = new Connexion();
        $conn = $db->getConnexion();
        $sqlProduct = "
        UPDATE product SET
            name = '{$this->getName()}',
            photos = '{$this->getPhotos()[0]}',
            price = {$this->getPrice()},
            description = '{$this->getDescription()}',
            quantity = {$this->getQuantity()},
            category_id = {$this->getCategory_id()},
            updatedAt = NOW()
        WHERE id = {$this->getId()}
    ";

        if (!mysqli_query($conn, $sqlProduct)) {
            return false;
        }
        $sqlElectronic = "
        UPDATE electronic SET
            brand = '{$this->brand}',
            waranty_fee = {$this->waranty_fee}
        WHERE product_id = {$this->getId()}
    ";

        return mysqli_query($conn, $sqlElectronic) ? $this : false;
    }
    public function addStocks(int $stock): self
    {
        if ($stock > 0) {
            $this->quantity += $stock;
        }

        return $this;
    }

    public function removeStocks(int $stock): self
    {
        if ($stock > 0) {
            $this->quantity -= $stock;

            if ($this->quantity < 0) {
                $this->quantity = 0;
            }
        }

        return $this;
    }
}
