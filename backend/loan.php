<?php
include_once('dbConnect.php');
include_once('account.php');
include_once('transaction_traits.php');

class Loan extends Account
{
    use TransactionTrait;

    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addLoan($acc_no, $amount)
    {
        $this->amount = $amount;
        $this->acc_no = $acc_no;

        $loan_number = mt_rand(10000, 99999);


        $stmt = $this->conn->prepare("INSERT INTO loans (loan_no, acc_no, amount, restamount) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$loan_number, $acc_no, $amount, $amount]);
    }

    public function getLoans($acc_no)
    {
        $res = $this->conn->prepare("SELECT * FROM loans WHERE acc_no = ?");
        $res->execute([$acc_no]);
        return $res->fetchAll();
    }

    public function updateLoanBalance($loan_no, $value)
    {
        $this->loan_no = $loan_no;
        $this->balance = $value;

        $res = $this->conn->prepare("UPDATE loans SET restamount='$this->balance' WHERE loan_no=?");
        return $res->execute([$loan_no]);
    }

    public function getLoanAmount($loan_no)
    {
        $res = $this->conn->prepare("SELECT restamount FROM loans WHERE loan_no = ?");
        $res->execute([$loan_no]);
        return $res->fetch();
    }

}
?>
