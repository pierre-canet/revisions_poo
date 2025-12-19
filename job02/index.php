<?php
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
$object01 = new Product(1, 'Drapeau', ['data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAT4AAACfCAMAAABX0UX9AAAAe1BMVEXMAAD/1wDIAAD/4QD/2gD/3QD/2wD/3gDxqgDhdQDpkQD7yQDXSwDUPgDjewD4wADmhwDWRgDRLgDdZgD+0gDlggDZUwDsmwDfbADPIgD/6QDgcQD2ugD/5ADpkwD5xADyrwD0tQDuogDQJwDbWgDTOQDtoADaVwDlhQDTHxaWAAADTUlEQVR4nO3ba2/aMBiG4fi1nYQECDQJhRZa6GHr//+FsxNSqNZxmjTP0n19gID48OqRT3FMkgAAAADAf2c+D11B1IoidAUxk7KU0DVE7M7au9A1RGyW57PQNcRLyrqm915vNZ54402SbPaXq9A1xaR40I0xaS6Sp8Y0+oEZ+BoyUS46cR3Xv+ZqQhe+0tbOu8xkbneha4mQPG6m/n26GdH0biDrPr416d3kIZF6Ke4NNxhV8mLti1Sj0JXESNZFUyVJ1RT03lvozcwvXD42OnQlMRrtF3tuCUjvvd7020sAkbgruOf4G9KmUwK8ncyzZkGAt3tVm3vyu92ryZ5D1xAbOWpwc5027NZfQdoyfxr9fO1DlDYzTeiSIiKtNsbaTNvmrftcmfSZ8e9C8qFVT7d9aO9aWeaPy/yeXiK5UXoctqxIyOwzvcOKeaKV4ZH5Bb5Nz49+KmPn6qxDetmXu7WpVaqh+Z0hxZBe+nWqeHXfZ2+hyorEIT0X1pfNFimVMjnN76T7IT3rx76Po7T83KtMuMqisNTDikW5tHRxlN/MJZqxdjlJ6i4/vZT3rv0djX8j94XlscdpXX4uvSSZZ378O4x2deank5C1xcDl16WXJIsuv+2Q39K1PrNl7jhDHh/7jOTNd2Q7HDJofXw74rtYPxDaqv/Qzby0vitINxGn/Vaz8Zc/iO8K8tjlV7rLkR8JLf9TuIpMfX6mWUnT3YgsQhcUh88+Km2fX55298Eha4rHalsPAe73Tk2X3gtD33mt0amefeY3y4ZNBD0JWlcU5EfX3LKy3j9m8zul/RYWGy7nvbv0jF8iZyqfjabFLtunp3hWeYHGKFuO+wHPOkN4rvUtaX2nycKlp+8TGaeH2D5pDludInXlWp3tDlSt1vo4wL4RHiYU/EZyn5iuhx2DSlvjb3SN1c1ya7v8nsjvDyT3K5SjTRW5a/Pnpil3xVgSWff5cdf7B2/9RvOXp2ki/f9S/WWV9v03SHH/Pdn54c2cOAlU+vw4a/A9Kf04p06d4+t+URHfd+Q5s7o6fQqycT/5+Y/qic2iKM6eAf944rYXAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIBf1AgbBt90jfUAAAAASUVORK5CYII='], 1991, 'Ceci est un drapeau', 1000000, new DateTime(), new DateTime(), 1);
$object02 = new Product(2, 'Stickman', ['https://img.freepik.com/vecteurs-libre/collection-stickman-dessines-main_23-2149217626.jpg'], 1, 'Ceci est un stickman', 1, new DateTime(), new DateTime(), 1);
$object03 = new Category(1, 'Catégorie 1', 'Test catégorie', new DateTime(),);
var_dump($object01);
var_dump($object02);
var_dump($object03);


?>

<!DOCTYPE html>

<html lang="fr">

<body>
    <img src="<?php echo $object01->getPhotos()[0]; ?>" alt="">
    <img src="<?php echo $object02->getPhotos()[0]; ?>" alt="">

</body>

</html>