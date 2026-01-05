<?php
session_start();
require_once '../dbConnect.php';

$conn = Database::connect();

$email = $_POST['email'];
$password = $_POST['password'];

$stmt = $conn->prepare(
    "SELECT * FROM admins WHERE email = ? AND password = ?"
);
$stmt->execute([$email, $password]);
$user = $stmt->fetch();

if ($user) {
    $_SESSION['admin'] = $user;
    header("Location: ../../admindashboard.php");
    exit;
} else {
    $_SESSION['msg'] = "Invalid Credential";
    $_SESSION['msg_class'] = "#dc3545";
    header("Location: ../../adminlogin.php");
    exit;
}
