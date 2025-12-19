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
