<?php
include_once('dbConnect.php');

class Account
{
    protected $conn;
    protected $accNumber;
    protected $balance;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function showBalance($user)
    {
        $res = $this->conn->prepare("SELECT balance FROM accounts WHERE user = ?");
        $res->execute([$user]);
        return $res->fetch();
    }

    public function getAccno($user)
    {
        $res = $this->conn->prepare("SELECT acc_number FROM accounts WHERE user = ?");
        $res->execute([$user]);
        return $res->fetch();
    }

    public function getUser($acc_no)
    {
        $res = $this->conn->prepare("SELECT user FROM accounts WHERE acc_number = ?");
        $res->execute([$acc_no]);
        return $res->fetch();
    }

    public function updateBalance($user, $value)
    {
        $this->user = $user;
        $this->balance = $value;

        $res = $this->conn->prepare("UPDATE accounts SET balance='$this->balance' WHERE user=?");
        return $res->execute([$user]);
    }
}
// $userid = $_SESSION['user']['id'];
// $acc_user = $conn->prepare("SELECT * FROM accounts WHERE user = ?");
// $acc_user->execute([$userid]);
// $acc_found = $acc_user->fetch();
// echo $acc_found['balance']
?>
