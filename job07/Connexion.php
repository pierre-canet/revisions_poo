<?php
class Connexion
{
    private $connexion;

    public function __construct()
    {
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "draft-shop";

        $this->connexion = mysqli_connect($host, $username, $password, $database);

        if (!$this->connexion) {
            die("Erreur de connexion : " . mysqli_connect_error());
        }
    }
    public function getConnexion()
    {
        return $this->connexion;
    }
}
