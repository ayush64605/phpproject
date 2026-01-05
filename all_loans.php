<?php
require_once 'backend/loan.php';
$conn = Database::connect();

$userId = $_SESSION['user']['id'] ?? null;
if (!$userId) {
    header('location:index.php');
    exit;
}

$account = new Loan($conn);
$accNo = $account->getAccountNumber($userId);
$loans = $account->getLoans($accNo);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>All Loan</title>
</head>


<body>
    <div class="container justify-content-center align-item-center d-flex">
        <div class="row  mt-4 loginform justify-content-center">
            <div class="justify-content-center" style="width:100%">
                <div class="row mt-4" style="justify-content:space-between">
                    <h5><b>Loan of Your Account</b>
                    </h5>
                    <a href="dashboard.php"><button type="button" class="btn btn-primary">Dashboard</button></a>
                    <a href="loan.php"><button type="button" class="btn btn-primary">Add Loan</button></a>
                </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Loan Number</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Rest Amount</th>
                            <th scope="col">Add Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($loans)): ?>
                            <?php foreach ($loans as $loan): ?>
                                <tr>
                                    <td><?= $loan['loan_no']; ?></td>
                                    <td><?= $loan['amount']; ?></td>
                                    <td><?= $loan['restamount']; ?></td>
                                    <td> <a href="addfund.php?loan_no=<?= $loan['loan_no']; ?>"><button type=" button"
                                                name="Withdraw" class="btn btn-primary">Add Fund</button></a>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">No loans found for this account.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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