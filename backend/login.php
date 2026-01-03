<?php
include_once('dbConnect.php');

$email = $_POST['email'];
$password = $_POST['password'];

$acc_user = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$acc_user->execute([$email, $password]);
$user_found = $acc_user->fetch();

if ($user_found) {
    $_SESSION['user'] = $user_found;
    header("location:../dashboard.php");
} else {
    $_SESSION['msg'] = "Invailid Credential.";
    $_SESSION['msg_class'] = "#dc3545";
    header("location:../login.php");
}


?>
