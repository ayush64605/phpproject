<?php
include_once('dbConnect.php');
include_once('account.php');

trait TransactionTrait
{
    public function addTransaction($from_acc, $to_acc, $amount)
    {
        $this->amount = $amount;
        $this->from_acc = $from_acc;
        $this->to_acc = $to_acc;
        $stmt = $this->conn->prepare("INSERT INTO transactions (from_acc, to_acc, amount) VALUES (?, ?, ?)");
        return $stmt->execute([$from_acc, $to_acc, $amount]);
    }
}

?>
