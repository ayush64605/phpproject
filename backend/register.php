<?php
include_once('dbConnect.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$existing = $conn->prepare("SELECT * FROM users WHERE email = ?");
$existing->execute([$email]);
$user_found = $existing->fetch();

if ($user_found) {
    $_SESSION['msg'] = "User Already Registered.";
    $_SESSION['msg_class'] = "#dc3545";
    header("location: ../register.php");
    exit();
} else {
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

    if ($stmt->execute([$name, $email, $password])) {
        $new_user_id = $conn->lastInsertId();
        $acc_number = mt_rand(10000, 99999);

        $stmt2 = $conn->prepare("INSERT INTO accounts (user, acc_number, balance) VALUES (?, ?, ?)");

        if ($stmt2->execute([$new_user_id, $acc_number, 1000])) {
            $_SESSION['msg'] = "Account created successfully, Please Login.";
            $_SESSION['msg_class'] = "#28a745";
        } else {
            $_SESSION['msg'] = "Account creation failed.";
            $_SESSION['msg_class'] = "#dc3545";
        }
    } else {
        $_SESSION['msg'] = "Error creating user.";
        $_SESSION['msg_class'] = "#dc3545";
    }
    header("location: ../register.php");
    exit();
}
