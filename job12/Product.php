<?php
require_once 'Connexion.php';
class Product
{
    //Initialisation des propriétés de classes

    public function __construct(
        private int $id = 0,
        private string $name = '',
        private array $photos = [''],
        private int $price = 0,
        private string $description = '',
        private int $quantity = 0,
        private ?DateTime $createdAt = null,
        private ?DateTime $updatedAt = null,
        private int $category_id = 0
    ) {}

    //Initialisation des Setter
    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setPhotos(array $photos)
    {
        $this->photos = $photos;
    }
    public function setPrice(int $price)
    {
        $this->price = $price;
    }
    public function setDescription(string $description)
    {
        $this->description = $description;
    }
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }
    public function setCreatedAt(Datetime $createdAt)
    {
        $this->createdAt = $createdAt;
    }
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
    public function setCategory_id(int $category_id)
    {
        $this->category_id = $category_id;
    }

    //Initialisation des Getter
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getPhotos(): array
    {
        return $this->photos;
    }
    public function getPrice(): int
    {
        return $this->price;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getQuantity(): int
    {
        return $this->quantity;
    }
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
    public function getCategory_id()
    {
        return $this->category_id;
    }
    public function getCategory(): ?Category
    {

        $db = new Connexion();
        $conn = $db->getConnexion();


        $sql = "SELECT * FROM category WHERE id = {$this->category_id}";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $categoryData = mysqli_fetch_assoc($result);


            return new Category(
                $categoryData['id'],
                $categoryData['name'],
                $categoryData['description'],
                new DateTime($categoryData['createdAt']),
                new DateTime($categoryData['updatedAt'])
            );
        }

        return null;
    }
    public function findOneById(int $id)
    {
        $db = new Connexion();
        $conn = $db->getConnexion();
        $sql = "SELECT * FROM product WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
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

            return $this;
        }
        return false;
    }
    public static function findAll(): array
    {
        $products = [];
        $db = new Connexion();
        $conn = $db->getConnexion();
        $sql = "SELECT * FROM product";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $product = new Product();
                $product->setId($data['id']);
                $product->setName($data['name']);
                $product->setPhotos([$data['photos']]);
                $product->setPrice((int)$data['price']);
                $product->setDescription($data['description']);
                $product->setQuantity((int)$data['quantity']);
                $product->setCategory_id((int)$data['category_id']);
                $product->setCreatedAt(new DateTime($data['createdAt']));
                $product->setUpdatedAt(new DateTime($data['updatedAt']));
                $products[] = $product;
            }
        }
        return $products;
    }
    public function create()
    {
        $db = new Connexion();
        $conn = $db->getConnexion();
        $name = mysqli_real_escape_string($conn, $this->name);
        $photo = mysqli_real_escape_string($conn, $this->photos[0]);
        $description = mysqli_real_escape_string($conn, $this->description);
        $price = $this->price;
        $quantity = $this->quantity;
        $category_id = $this->category_id;
        $createdAt = $this->createdAt
            ? $this->createdAt->format('Y-m-d H:i:s')
            : date('Y-m-d H:i:s');
        $updatedAt = $this->updatedAt
            ? $this->updatedAt->format('Y-m-d H:i:s')
            : date('Y-m-d H:i:s');
        $sql = "
            INSERT INTO product (name, photos, price, description, quantity, createdAt, updatedAt, category_id)
            VALUES ('$name', '$photo', $price, '$description', $quantity, '$createdAt', '$updatedAt', $category_id)
        ";
        if (mysqli_query($conn, $sql)) {
            $this->id = mysqli_insert_id($conn);
            return $this;
        }
        return false;
    }
    public function update()
    {
        if ($this->id <= 0) {
            return false;
        }

        $db = new Connexion();
        $conn = $db->getConnexion();
        $name = mysqli_real_escape_string($conn, $this->name);
        $photo = mysqli_real_escape_string($conn, $this->photos[0]);
        $description = mysqli_real_escape_string($conn, $this->description);
        $price = $this->price;
        $quantity = $this->quantity;
        $category_id = $this->category_id;
        $updatedAt = $this->updatedAt
            ? $this->updatedAt->format('Y-m-d H:i:s')
            : date('Y-m-d H:i:s');
        $sql = "
            UPDATE product SET
                name = '$name',
                photos = '$photo',
                price = $price,
                description = '$description',
                quantity = $quantity,
                updatedAt = '$updatedAt',
                category_id = $category_id
            WHERE id = {$this->id}
        ";
        if (mysqli_query($conn, $sql)) {
            return $this;
        }
        return false;
    }
}
class Category
{
    public function __construct(private int $id = 0, private string $name = '', private string $description = '', private ?DateTime $createdAt = null, private ?DateTime $updatedAt = null) {}

    //Initialisation des Setter
    public function setId(int $id)
    {
        $this->id = $id;
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function setDescription(string $description)
    {
        $this->description = $description;
    }
    public function setCreatedAt(Datetime $createdAt)
    {
        $this->createdAt = $createdAt;
    }
    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    //Initialisation des Getter
    public function getId(): int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }
    public function getProducts(): array
    {
        $products = [];


        $db = new Connexion();
        $conn = $db->getConnexion();
        $sql = "SELECT * FROM product WHERE category_id = {$this->id}";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($productData = mysqli_fetch_assoc($result)) {
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
                $products[] = $product;
            }
        }

        return $products;
    }
}
class Clothing extends Product
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
        if (!parent::update()) {
            return false;
        }

        $db = new Connexion();
        $conn = $db->getConnexion();

        $sql = "
        UPDATE clothing SET
            size = '{$this->size}',
            color = '{$this->color}',
            type = '{$this->type}',
            material_fee = {$this->material_fee}
        WHERE product_id = {$this->getId()}
    ";

        return mysqli_query($conn, $sql) ? $this : false;
    }
}
class Electronic extends Product
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
        if (!parent::update()) {
            return false;
        }

        $db = new Connexion();
        $conn = $db->getConnexion();

        $sql = "
            UPDATE electronic SET
                brand = '{$this->brand}',
                waranty_fee = {$this->waranty_fee}
            WHERE product_id = {$this->getId()}
        ";

        return mysqli_query($conn, $sql) ? $this : false;
    }
}
