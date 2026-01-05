<?php
require_once 'account.php';
require_once 'transaction_traits.php';

class Transaction extends Account implements TransactionInterface
{
    use TransactionTrait;

    public function getTransaction(int $accNo): array
    {
        $stmt = $this->getConnection()->prepare(
            "SELECT * FROM transactions WHERE from_acc = ?"
        );
        $stmt->execute([$accNo]);
        return $stmt->fetchAll();
    }

    public function getTotalIn(int $accNo): float
    {
        $stmt = $this->getConnection()->prepare(
            "SELECT SUM(amount) FROM transactions WHERE to_acc = ?"
        );
        $stmt->execute([$accNo]);
        return (float) ($stmt->fetchColumn() ?? 0);
    }

    public function getTotalOut(int $accNo): float
    {
        $stmt = $this->getConnection()->prepare(
            "SELECT SUM(amount) FROM transactions WHERE from_acc = ?"
        );
        $stmt->execute([$accNo]);
        return (float) ($stmt->fetchColumn() ?? 0);
    }
}
