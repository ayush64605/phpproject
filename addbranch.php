<?php
require_once 'backend/admin/setter.php';
require_once 'backend/admin/getter.php';
require_once 'backend/dbConnect.php';

$conn = Database::connect();

$userId = $_SESSION['admin']['id'] ?? null;
if (!$userId) {
    header('location:index.php');
    exit;
}

$get_data = new Getter($conn);

$cities = $get_data->getCities();

if (isset($_POST['branch_submit'])) {
    $add = new Setter($conn);

    $add->addBranches($_POST['name'], $_POST['city']);

    $_SESSION['msg'] = "Added successfully.";
    $_SESSION['msg_class'] = "#28a745";


    header("location:all_branch.php");
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
    <title>Add Branch</title>
</head>


<body>
    <div class="container justify-content-center align-item-center d-flex">
        <div class="row  mt-4 loginform justify-content-center">
            <div class="justify-content-center" style="width:100%">
                <div class="row mt-4" style="justify-content:space-between">
                    <h5><b>Add Branch</b>
                    </h5>
                    <a href="admindashboard.php"><button type="button" class="btn btn-primary">Dashboard</button></a>
                </div>
                <form class="mt-4" action="" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Enter Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter Name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCity">City</label>
                        <select name="city" id="city" class="form-control">
                            <option value="">Select City</option>
                            <?php foreach ($cities as $city): ?>
                                <option value="<?= $city['id'] ?>"><?= $city['name'] ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <button type="submit" name="branch_submit" class="btn btn-primary">Add</button>
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