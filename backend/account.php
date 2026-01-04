<?php
require_once 'dbConnect.php';

abstract class Account
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

    public function showBalance(int $userId): float
    {
        $stmt = $this->conn->prepare(
            "SELECT balance FROM accounts WHERE user = ?"
        );
        $stmt->execute([$userId]);
        return (float) $stmt->fetchColumn();
    }

    public function getAccountNumber(int $userId): int
    {
        $stmt = $this->conn->prepare(
            "SELECT acc_number FROM accounts WHERE user = ?"
        );
        $stmt->execute([$userId]);
        return (int) $stmt->fetchColumn();
    }

    public function getUserByAccount(int $accNo): int
    {
        $stmt = $this->conn->prepare(
            "SELECT user FROM accounts WHERE acc_number = ?"
        );
        $stmt->execute([$accNo]);
        return (int) $stmt->fetchColumn();
    }

    public function updateBalance(int $userId, float $amount): bool
    {
        if ($amount < 0) {
            throw new Exception("Balance cannot be negative");
        }

        $stmt = $this->conn->prepare(
            "UPDATE accounts SET balance = ? WHERE user = ?"
        );
        return $stmt->execute([$amount, $userId]);
    }
}
