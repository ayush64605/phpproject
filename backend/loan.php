<?php
require_once 'account.php';
require_once 'transaction_traits.php';

class Loan extends Account implements TransactionInterface
{
    use TransactionTrait;

    public function addLoan(int $accNo, float $amount): bool
    {
        if ($amount <= 0) {
            throw new Exception("Invalid loan amount");
        }

        $loanNo = mt_rand(10000, 99999);

        $stmt = $this->getConnection()->prepare(
            "INSERT INTO loans (loan_no, acc_no, amount, restamount)
             VALUES (?, ?, ?, ?)"
        );

        return $stmt->execute([$loanNo, $accNo, $amount, $amount]);
    }

    public function getLoans(int $accNo): array
    {
        $stmt = $this->getConnection()->prepare(
            "SELECT * FROM loans WHERE acc_no = ?"
        );
        $stmt->execute([$accNo]);
        return $stmt->fetchAll();
    }

    public function updateLoanBalance(int $loanNo, float $amount): bool
    {
        $stmt = $this->getConnection()->prepare(
            "UPDATE loans SET restamount = ? WHERE loan_no = ?"
        );
        return $stmt->execute([$amount, $loanNo]);
    }

    public function getLoanAmount(int $loanNo): float
    {
        $stmt = $this->getConnection()->prepare(
            "SELECT restamount FROM loans WHERE loan_no = ?"
        );
        $stmt->execute([$loanNo]);
        return (float) $stmt->fetchColumn();
    }
}
