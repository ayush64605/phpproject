<?php
include_once 'backend/loan.php';
$user = $_SESSION['user']['id'];
if (!$user) {
    header('location:index.php');
}
if (isset($_POST['loan'])) {
    $account = new Loan($conn);

    $user = $_SESSION['user']['id'];
    $rs = $account->showBalance($user);
    $acc_no = $account->getAccno($user);

    $amount = $rs['balance'];

    if ($amount < $_POST['amount']) {
        $_SESSION['msg'] = "Enter Vaild Amount.";
        $_SESSION['msg_class'] = "#dc3545";
        header("location:dashboard.php");
    } else {
        $res2 = $account->addLoan($acc_no['acc_number'], $_POST['amount']);

        if ($res2) {
            $_SESSION['msg'] = "Loan Added successfully.";
            $_SESSION['msg_class'] = "#28a745";
            header("location:dashboard.php");

        } else {
            $_SESSION['msg'] = "Load Apply failed.";
            $_SESSION['msg_class'] = "#dc3545";
            header("location:dashboard.php");
        }
    }
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
    <title>Add Loan</title>
</head>


<body>
    <div class="container justify-content-center align-item-center d-flex">
        <div class="row  mt-4 loginform justify-content-center">
            <div class="justify-content-center" style="width:100%">
                <div class="row mt-4" style="justify-content:space-between">
                    <h5><b>Add Loan To Your Account</b>
                    </h5>
                    <a href="dashboard.php"><button type="button" class="btn btn-primary">Dashboard</button></a>
                </div>
                <form class="mt-4" action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Amount</label>
                        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter Amount" name="amount">
                    </div>
                    <button type="submit" name="loan" class="btn btn-primary">Add</button>
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
