<?php
include_once('dbConnect.php');
include_once('account.php');
include_once('transaction_traits.php');


class Transaction extends Account
{

    use TransactionTrait;

    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function getTransaction($acc_no)
    {
        $res = $this->conn->prepare("SELECT * FROM transactions WHERE from_acc = ?");
        $res->execute([$acc_no]);
        return $res->fetchAll();
    }

    public function getTotalIn($acc_no)
    {
        $res = $this->conn->prepare("SELECT SUM(amount) FROM transactions WHERE to_acc = ?");
        $res->execute([$acc_no]);
        $total = $res->fetchColumn();
        return $total ? $total : 0;
    }

    public function getTotalOut($acc_no)
    {
        $res = $this->conn->prepare("SELECT SUM(amount) FROM transactions WHERE from_acc = ?");
        $res->execute([$acc_no]);
        $total = $res->fetchColumn();
        return $total ? $total : 0;
    }

}
?>
