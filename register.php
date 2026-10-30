<?php

require_once 'database.php';

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'buyer';

    if ($full_name === '' || $email === '' || $password === '') {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (strlen($password) < 8) {
        $error = 'Password must be at least 8 characters.';
    } elseif (!in_array($role, ['buyer', 'farmer'])) {
        $error = 'Invalid account type.';
    } else {

        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {

            $error = 'Email address is already registered.';

        } else {

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare(
                "INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "ssss",
                $full_name,
                $email,
                $hashed_password,
                $role
            );

            if ($stmt->execute()) {
                $message = 'Account created successfully. You can now log in.';
            } else {
                $error = 'Something went wrong. Please try again.';
            }

            $stmt->close();
        }

        $check->close();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AniHub Register</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            background: #f2f8f1;
        }

        .left-section {
            width: 50%;
            min-height: 100vh;
            background-image:
                linear-gradient(rgba(20, 70, 35, 0.65), rgba(20, 70, 35, 0.65)),
                url("1000013644.jpe");
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            color: white;
        }

        .left-content {
            max-width: 500px;
            text-align: center;
        }

        .logo {
            font-size: 42px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .logo span {
            color: #9ccc65;
        }

        .quote {
            font-size: 22px;
            line-height: 1.5;
            font-weight: 500;
        }

        .right-section {
            width: 50%;
            min-height: 100vh;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 35px;
        }

        .register-container {
            width: 100%;
            max-width: 430px;
        }

        .register-container h1 {
            color: #2e7d32;
            font-size: 32px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #777;
            font-size: 15px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            color: #333;
            font-size: 14px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            height: 48px;
            border: 1px solid #d5d5d5;
            border-radius: 8px;
            padding: 0 14px;
            font-size: 15px;
            outline: none;
        }

        .form-group input:focus {
            border-color: #4caf50;
        }

        .password-box {
            position: relative;
        }

        .password-box input {
            padding-right: 50px;
        }

        .eye {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 20px;
            user-select: none;
        }

        .role-title {
            color: #333;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .role-container {
            display: flex;
            gap: 10px;
            margin-bottom: 18px;
        }

        .role-button {
            flex: 1;
            height: 45px;
            border: 1px solid #d5d5d5;
            background: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            color: #555;
        }

        .role-button.active {
            background: #e8f5e9;
            border-color: #4caf50;
            color: #2e7d32;
            font-weight: bold;
        }

        .terms {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            font-size: 13px;
            color: #666;
            margin-bottom: 20px;
            line-height: 1.4;
        }

        .terms input {
            margin-top: 3px;
        }

        .terms a {
            color: #2e7d32;
            text-decoration: none;
        }

        .create-button {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 8px;
            background: #2e7d32;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .create-button:hover {
            background: #256628;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 14px;
        }

        .login-link a {
            color: #2e7d32;
            font-weight: bold;
            text-decoration: none;
        }

        .error-message {
            background: #ffebee;
            color: #c62828;
            padding: 10px 12px;
            border-radius: 7px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .success-message {
            background: #e8f5e9;
            color: #2e7d32;
            padding: 10px 12px;
            border-radius: 7px;
            margin-bottom: 18px;
            font-size: 14px;
        }

        @media (max-width: 768px) {

            body {
                flex-direction: row;
            }

            .left-section {
                width: 50%;
                min-height: 100vh;
                padding: 15px;
            }

            .right-section {
                width: 50%;
                min-height: 100vh;
                padding: 15px;
            }

            .logo {
                font-size: 25px;
            }

            .quote {
                font-size: 13px;
            }

            .register-container h1 {
                font-size: 21px;
            }

            .subtitle {
                font-size: 11px;
                margin-bottom: 15px;
            }

            .form-group {
                margin-bottom: 11px;
            }

            .form-group label {
                font-size: 11px;
                margin-bottom: 4px;
            }

            .form-group input {
                height: 38px;
                font-size: 11px;
                padding: 0 8px;
            }

            .password-box input {
                padding-right: 35px;
            }

            .eye {
                right: 8px;
                font-size: 15px;
            }

            .role-title {
                font-size: 11px;
                margin-bottom: 5px;
            }

            .role-container {
                gap: 5px;
                margin-bottom: 11px;
            }

            .role-button {
                height: 35px;
                font-size: 10px;
            }

            .terms {
                font-size: 9px;
                margin-bottom: 12px;
            }

            .create-button {
                height: 38px;
                font-size: 12px;
            }

            .login-link {
                font-size: 10px;
                margin-top: 12px;
            }
        }

    </style>

</head>

<body>

    <div class="left-section">

        <div class="left-content">

            <div class="logo">
                Ani<span>Hub</span>
            </div>

            <div class="quote">
                Connecting farmers and buyers for a better harvest.
            </div>

        </div>

    </div>

    <div class="right-section">

        <div class="register-container">

            <h1>Join the Harvest</h1>

            <p class="subtitle">
                Create your AniHub account and get started.
            </p>

            <?php if ($error): ?>

                <div class="error-message">
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endif; ?>

            <?php if ($message): ?>

                <div class="success-message">
                    <?= htmlspecialchars($message) ?>
                </div>

            <?php endif; ?>

            <form method="POST" action="">

                <div class="role-title">
                    Account Type
                </div>

                <div class="role-container">

                    <button
                        type="button"
                        class="role-button active"
                        id="buyerButton"
                        onclick="selectRole('buyer')">
                        Buyer
                    </button>

                    <button
                        type="button"
                        class="role-button"
                        id="farmerButton"
                        onclick="selectRole('farmer')">
                        Farmer
                    </button>

                </div>

                <input
                    type="hidden"
                    name="role"
                    id="role"
                    value="buyer">

                <div class="form-group">

                    <label for="full_name">
                        Full Name
                    </label>

                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        placeholder="Enter your full name"
                        required>

                </div>

                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        required>

                </div>

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="password-box">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            minlength="8"
                            required>

                        <span
                            class="eye"
                            id="eye"
                            onclick="togglePassword()">
                            👁
                        </span>

                    </div>

                </div>

                <div class="terms">

                    <input
                        type="checkbox"
                        id="terms"
                        required>

                    <label for="terms">
                        I agree to the
                        <a href="#">Terms and Conditions</a>
                        and
                        <a href="#">Privacy Policy</a>.
                    </label>

                </div>

                <button
                    type="submit"
                    class="create-button">
                    Create Account
                </button>

            </form>

            <div class="login-link">

                Already have an account?
                <a href="login.php">Log in</a>

            </div>

        </div>

    </div>

    <script>

        function selectRole(role) {

            document.getElementById("role").value = role;

            const buyerButton = document.getElementById("buyerButton");
            const farmerButton = document.getElementById("farmerButton");

            buyerButton.classList.remove("active");
            farmerButton.classList.remove("active");

            if (role === "buyer") {
                buyerButton.classList.add("active");
            } else {
                farmerButton.classList.add("active");
            }
        }

        function togglePassword() {

            const password = document.getElementById("password");
            const eye = document.getElementById("eye");

            if (password.type === "password") {

                password.type = "text";
                eye.textContent = "🙈";

            } else {

                password.type = "password";
                eye.textContent = "👁";

            }
        }

    </script>

</body>

</html>
