<?php
require_once 'dbConnect.php';

$conn = Database::connect();

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$city = $_POST['city'];
$branch = $_POST['branch'];


$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->execute([$email]);

if ($check->fetch()) {
    $_SESSION['msg'] = "User Already Registered";
    $_SESSION['msg_class'] = "#dc3545";
    header("Location: ../register.php");
    exit;
}

$conn->prepare(
    "INSERT INTO users (name, email, password, city, branch) VALUES (?, ?, ?, ?, ?)"
)->execute([$name, $email, $password, $city, $branch]);

$userId = $conn->lastInsertId();
$accNo = mt_rand(10000, 99999);

$conn->prepare(
    "INSERT INTO accounts (user, acc_number, balance)
     VALUES (?, ?, ?)"
)->execute([$userId, $accNo, 1000]);

$conn->prepare(
    "INSERT INTO transactions (from_acc, to_acc, amount)
     VALUES (?, ?, ?)"
)->execute(["Initial Balance", $accNo, 1000]);

$_SESSION['msg'] = "Account created successfully";
$_SESSION['msg_class'] = "#28a745";
header("Location: ../index.php");
