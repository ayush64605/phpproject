<?php
require_once 'backend/admin/getter.php';
require_once 'backend/dbConnect.php';

$conn = Database::connect();

$userId = $_SESSION['admin']['id'] ?? null;
if (!$userId) {
    header('location:login.php');
    exit;
}

$get_data = new Getter($conn);

$cities = $get_data->getCities();
$braches = $get_data->getBranches();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Dashboard</title>
</head>


<body>
    <div class="container">

        <div class="row mt-4" style="justify-content:space-between">
            <h2>Welcome Admin
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
                        <h5 class="card-title">Total City</h5>
                        <?php
                        $total_city = 0;
                        foreach ($cities as $city):
                            $total_city = $total_city + 1;
                        endforeach;
                        print_r($total_city);
                        ?>
                    </div>
                    <div class="card-footer d-flex" style="justify-content:space-between">
                        <a href="all_cities.php"><button type="button" class="btn btn-primary">All Cities</button></a>
                        <a href="addcity.php"><button type="button" class="btn btn-primary">Add City</button></a>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Branches</h5>
                        <?php
                        $total_branch = 0;
                        foreach ($braches as $branch):
                            $total_branch = $total_branch + 1;
                        endforeach;
                        print_r($total_branch);
                        ?>
                    </div>
                    <div class="card-footer d-flex" style="justify-content:space-between">
                        <a href="all_branch.php"><button type="button" class="btn btn-primary">All Branches</button></a>
                        <a href="addbranch.php"><button type="button" class="btn btn-primary">Add Branch</button></a>
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