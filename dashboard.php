<?php
require_once 'backend/transaction.php';
require_once 'backend/loan.php';

$conn = Database::connect();

$userId = $_SESSION['user']['id'] ?? null;
if (!$userId) {
    header('location:index.php');
    exit;
}

$account = new Transaction($conn);

$accNo   = $account->getAccountNumber($userId);
$balance = $account->showBalance($userId);

$totalIn  = $account->getTotalIn($accNo);
$totalOut = $account->getTotalOut($accNo);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Dashboard</title>
</head>


<body>
    <div class="container">

        <div class="row mt-4" style="justify-content:space-between">
            <h2>Welcome,
                <?php
                print_r($_SESSION['user']['name']);
                ?>
            </h2>
            <a href="backend/logout.php"><button type="submit" class="btn btn-danger">Logout</button></a>
        </div>
        <p>Your Account No. <?php
        print_r($accNo);
        ?></p>
        <?php if (isset($_SESSION['msg'])): ?>
            <div
                style="background-color: <?php echo $_SESSION['msg_class']; ?>; color: white; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                <?php
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
                unset($_SESSION['msg_class']);
                ?>
            </div>
        <?php endif; ?>
        <div class="row">

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Balance</h5>
                        <?php
                        print_r($balance);
                        ?>
                    </div>
                    <div class="card-footer d-flex" style="justify-content:space-between">
                        <a href="deposit.php"><button type="button" class="btn btn-primary">Add Balance</button></a>
                        <a href="withdraw.php"><button type="button" class="btn btn-primary">Withdraw
                                Balance</button></a>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Loans</h5>
                        <?php
                        $obAccount = new Loan($conn);
                        $loans = $obAccount->getLoans($accNo);
                        $total = 0;
                        foreach ($loans as $loan):
                            $total = $total + 1;
                        endforeach;
                        print_r($total);
                        ?>
                    </div>
                    <div class="card-footer">
                        <a href="all_loans.php"><button type="button" class="btn btn-primary">All Loan</button></a>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body d-flex" style="justify-content:space-between">
                        <div>
                            <h5 class="card-title">Total In</h5>
                            <p class="card-text">
                                <?php print_r(number_format($totalIn, 2)); ?>
                            </p>
                        </div>
                        <div>
                            <h5 class="card-title">Total Out</h5>
                            <p class="card-text">
                                <?php print_r(number_format($totalOut, 2)); ?>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer d-flex" style="justify-content:space-between">
                        <a href="all_transactions.php"><button type="button" class="btn btn-primary">All
                                Transaction</button></a>
                        <a href="transaction.php"><button type="button" class="btn btn-primary">Transfer</button></a>

                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
</body>

</html>