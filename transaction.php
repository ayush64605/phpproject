<?php
require_once 'backend/transaction.php';
$conn = Database::connect();

$userId = $_SESSION['user']['id'] ?? null;
if (!$userId) {
    header('location:index.php');
    exit;
}

if (isset($_POST['transaction'])) {
    $account = new Transaction($conn);

    $senderBalance = $account->showBalance($userId);
    $senderAccNo   = $account->getAccountNumber($userId);

    $receiverUserId = $account->getUserByAccount($_POST['acc_no']);
    if (!$receiverUserId) {
        $_SESSION['msg'] = "Invalid Account Number.";
        $_SESSION['msg_class'] = "#dc3545";
        header("location:dashboard.php");
        exit;
    }

    $receiverBalance = $account->showBalance($receiverUserId);

    if ($senderBalance < $_POST['amount']) {
        $_SESSION['msg'] = "Insufficient Balance.";
        $_SESSION['msg_class'] = "#dc3545";
        header("location:dashboard.php");
        exit;
    }

    $account->updateBalance($userId, $senderBalance - $_POST['amount']);
    $account->updateBalance($receiverUserId, $receiverBalance + $_POST['amount']);
    $account->addTransaction($senderAccNo, $_POST['acc_no'], $_POST['amount']);

    $_SESSION['msg'] = "Transfer successful.";
    $_SESSION['msg_class'] = "#28a745";
    header("location:dashboard.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.css"> -->

    <title>Transfer Money</title>
</head>


<body>
    <!--KDwNNHt3ZtBwPRHFAf3N-->
    <div class="container justify-content-center align-item-center d-flex">
        <div class="row  mt-4 loginform justify-content-center">
            <div style="width:100%">
                <div class="row mt-4" style="justify-content:space-between">
                    <h5><b>Accoutn Transfer</b>
                    </h5>
                    <a href="dashboard.php"><button type="button" class="btn btn-primary">Dashboard</button></a>
                </div>
                <form class="mt-4" action="" method="post">
                    <div class="form-group">
                        <label for="acc_no">Account No.</label>
                        <input type="text" class="form-control" id="acc_no" aria-describedby="acc_no"
                            placeholder="Enter Account No." name="acc_no">
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" id="amount" placeholder="Enter Amount" name="amount">
                    </div>
                    <?php if (isset($_SESSION['msg'])): ?>
                        <div
                            style="background-color: <?php echo $_SESSION['msg_class']; ?>; color: white; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                            <?php
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']); // Clear message after showing
                            unset($_SESSION['msg_class']);
                            ?>
                        </div>
                    <?php endif; ?>
                    <button type="submit" name="transaction" class="btn btn-primary mt-4">Transfer</button>
                </form>
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