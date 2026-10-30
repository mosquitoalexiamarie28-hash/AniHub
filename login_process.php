<?php

session_start();

include "database.php";

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {

    header("Location: login.php?error=" . urlencode("Please enter your email and password."));
    exit();

}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    header("Location: login.php?error=" . urlencode("Please enter a valid email address."));
    exit();

}

$sql = "SELECT * FROM users WHERE email = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 1) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        header("Location: dashboard.php");
        exit();

    } else {

        header("Location: login.php?error=" . urlencode("Incorrect password."));
        exit();

    }

} else {

    header("Location: login.php?error=" . urlencode("Account not found."));
    exit();

}

?>