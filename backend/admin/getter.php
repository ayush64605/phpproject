<?php
class Getter
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    protected function getConnection(): PDO
    {
        return $this->conn;
    }

    public function getCities(): array
    {
        $stmt = $this->getConnection()->prepare(
            "SELECT * FROM cities"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getBranches(): array
    {
        $stmt = $this->getConnection()->prepare(
            "SELECT * FROM branches;"
        );
        $stmt->execute();
        return $stmt->fetchAll();
        // $data = $stmt->fetchAll();
        // print_r($data);
        // exit;
        //"SELECT branches.name, cities.name FROM branches INNER JOIN cities ON branches.city = cities.id;"

    }
}
