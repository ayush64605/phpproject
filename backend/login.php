<?php
session_start();
require_once 'dbConnect.php';

$conn = Database::connect();

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare(
    "SELECT * FROM users WHERE email = ? AND password = ?"
);
$stmt->execute([$email, $password]);
$user = $stmt->fetch();

if ($user) {
    $_SESSION['user'] = $user;
    header("Location: ../dashboard.php");
    exit;
} else {
    $_SESSION['msg'] = "Invalid Credential";
    $_SESSION['msg_class'] = "#dc3545";
    header("Location: ../index.php");
    exit;
}
