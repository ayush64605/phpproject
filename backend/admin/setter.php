<?php
include('../dbConnect.php');

class Setter
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

    public function addCity(string $name): bool
    {
        $stmt = $this->getConnection()->prepare(
            "INSERT INTO cities (name)
             VALUES (?)"
        );

        return $stmt->execute([$name]);
    }

    public function addBranches(string $name, int $city): bool
    {
        $stmt = $this->getConnection()->prepare(
            "INSERT INTO branches (name, city)
             VALUES (?, ?)"
        );

        return $stmt->execute([$name, $city]);
    }
}
