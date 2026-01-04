<?php
interface TransactionInterface
{
    public function addTransaction(int $from, string $to, float $amount): bool;
}

trait TransactionTrait
{
    public function addTransaction(int $from, string $to, float $amount): bool
    {
        $stmt = $this->getConnection()->prepare(
            "INSERT INTO transactions (from_acc, to_acc, amount)
             VALUES (?, ?, ?)"
        );
        return $stmt->execute([$from, $to, $amount]);
    }
}
