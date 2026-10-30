<?php

include "database.php";

$name = "Sarah Santos";
$email = "sarah@gmail.com";
$password = "12345678";
$role = "farmer";

// Check if the email already exists
$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    echo "Account already exists! You can use this account to log in.";
    exit;
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the new account
$sql = "INSERT INTO users (full_name, email, password, role)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param(
    "ssss",
    $name,
    $email,
    $hashed_password,
    $role
);

if ($stmt->execute()) {
    echo "Account created successfully!";
} else {
    echo "Error creating account: " . $stmt->error;
}

$stmt->close();
$check->close();
$conn->close();

?>