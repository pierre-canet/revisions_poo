<?php
class Product
{
    //Initialisation des propriétés de classes

    public function __construct(
        private int  $id = 0,
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
}
//Initialisation d'objets tests
$object01 = new Product(1, 'Caméléon', ['https://cdn.pixabay.com/photo/2018/03/13/01/46/yemen-chameleon-3221437_640.jpg'], 300, 'Ceci est un caméléon de compagnie', 13, new DateTime(), new DateTime(), 1);
$object02 = new Product(2, 'Stickman', ['https://img.freepik.com/vecteurs-libre/collection-stickman-dessines-main_23-2149217626.jpg'], 1, 'Ceci est un stickman', 1, new DateTime(), new DateTime(), 1);
$object03 = new Category(1, 'animaux de compagnie', 'Retrouvez ici les animaux de compagnie de vos rêves ! Que vous les vouliez exotiques, mignons, sauvages ou sociables, vous trouverez votre bonheur dnas cette partie du magasin !', new DateTime(), new DateTime());

//Initialisation des var_dump des objets tests
var_dump($object01);
var_dump($object02);
var_dump($object03);


?>

<!DOCTYPE html>

<html lang="fr">

<body>
    <img src="<?php echo $object01->getPhotos()[0]; ?>" alt="">
    <img src="<?php echo $object02->getPhotos()[0]; ?>" alt="">
    <img src="photo.jpg" alt="">

</body>

</html>