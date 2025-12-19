<?php

namespace App;

use DateTime;
use App\Abstract\AbstractProduct;
use App\Database\Connexion;

class Clothing extends AbstractProduct
{
    private string $size = '';
    private string $color = '';
    private string $type = '';
    private int $material_fee = 0;
    public function setSize(string $size)
    {
        $this->size = $size;
    }
    public function setColor(string $color)
    {
        $this->color = $color;
    }
    public function setType(string $type)
    {
        $this->type = $type;
    }
    public function setMaterialFee(int $fee)
    {
        $this->material_fee = $fee;
    }
    public function getSize(): string
    {
        return $this->size;
    }
    public function getColor(): string
    {
        return $this->color;
    }
    public function getType(): string
    {
        return $this->type;
    }
    public function getMaterialFee(): int
    {
        return $this->material_fee;
    }
    public function findOneById(int $id)
    {
        $db = new Connexion();
        $conn = $db->getConnexion();

        $sql = "
            SELECT p.*, c.size, c.color, c.type, c.material_fee
            FROM product p
            INNER JOIN clothing c ON p.id = c.product_id
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
            $this->setSize($data['size']);
            $this->setColor($data['color']);
            $this->setType($data['type']);
            $this->setMaterialFee((int)$data['material_fee']);
            return $this;
        }
        return false;
    }
    public static function findAll(): array
    {
        $clothes = [];
        $db = new Connexion();
        $conn = $db->getConnexion();
        $sql = "
        SELECT p.*, c.size, c.color, c.type, c.material_fee
        FROM product p
        INNER JOIN clothing c ON p.id = c.product_id
    ";
        $result = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_assoc($result)) {
            $clothing = new Clothing();
            $clothing->setId($data['id']);
            $clothing->setName($data['name']);
            $clothing->setPhotos([$data['photos']]);
            $clothing->setPrice((int)$data['price']);
            $clothing->setDescription($data['description']);
            $clothing->setQuantity((int)$data['quantity']);
            $clothing->setCategory_id((int)$data['category_id']);
            $clothing->setCreatedAt(new DateTime($data['createdAt']));
            $clothing->setUpdatedAt(new DateTime($data['updatedAt']));
            $clothing->setSize($data['size']);
            $clothing->setColor($data['color']);
            $clothing->setType($data['type']);
            $clothing->setMaterialFee((int)$data['material_fee']);
            $clothes[] = $clothing;
        }
        return $clothes;
    }
    public function create()
    {
        if (!parent::create()) {
            return false;
        }

        $db = new Connexion();
        $conn = $db->getConnexion();

        $sql = "
        INSERT INTO clothing (product_id, size, color, type, material_fee)
        VALUES (
            {$this->getId()},
            '{$this->size}',
            '{$this->color}',
            '{$this->type}',
            {$this->material_fee}
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
        $sqlClothing = "
        UPDATE clothing SET
            size = '{$this->size}',
            color = '{$this->color}',
            type = '{$this->type}',
            material_fee = {$this->material_fee}
        WHERE product_id = {$this->getId()}
    ";

        return mysqli_query($conn, $sqlClothing) ? $this : false;
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
