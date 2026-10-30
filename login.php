<?php
$error = $_GET['error'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AniHub Login</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Georgia, "Times New Roman", serif;
            min-height: 100vh;
            background: #ffffff;
        }

        .page {
            min-height: 100vh;
            display: flex;
        }

        /* =========================
           LEFT SIDE
        ========================== */

        .left-side {
            width: 50%;
            min-height: 100vh;

            background-image:
                linear-gradient(
                    rgba(20, 55, 38, 0.55),
                    rgba(20, 55, 38, 0.55)
                ),
                url("1000013644.jpe");

            background-size: cover;
            background-position: center;

            position: relative;
            color: white;
            padding: 38px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 9px;

            font-size: 17px;
            font-weight: bold;
        }

        .brand-icon {
            width: 22px;
            height: 22px;

            border: 2px solid white;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 11px;
        }

        .quote {
            position: absolute;
            left: 38px;
            right: 45px;
            bottom: 50px;
        }

        .quote h1 {
            font-size: 27px;
            line-height: 1.25;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .quote .name {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        .quote .location {
            font-size: 10px;
        }

        /* =========================
           RIGHT SIDE
        ========================== */

        .right-side {
            width: 50%;
            min-height: 100vh;

            background: #ffffff;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 40px;
        }

        .login-box {
            width: 100%;
            max-width: 500px;
        }

        .login-box h2 {
            font-size: 28px;
            color: #1c1c1c;
            margin-bottom: 6px;
        }

        .subtitle {
            color: #777;
            font-size: 12px;
            margin-bottom: 28px;
        }

        /* Form */

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;

            font-size: 11px;
            font-weight: bold;

            color: #555;

            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;

            height: 43px;

            padding: 0 13px;

            border: none;
            border-radius: 6px;

            background: #f8f7f4;

            color: #333;

            font-family: Arial, sans-serif;
            font-size: 12px;

            outline: none;
        }

        .form-group input:focus {
            box-shadow: 0 0 0 1px #1f6b45;
        }

        /* Password */

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 45px;
        }

        .eye {
            position: absolute;
            right: 14px;
            top: 50%;

            transform: translateY(-50%);

            color: #999;
            font-size: 14px;

            cursor: pointer;
        }

        /* Error */

        .error {
            background: #fcebea;
            color: #b3261e;

            padding: 10px 12px;

            border-radius: 5px;

            font-family: Arial, sans-serif;
            font-size: 11px;

            margin-bottom: 18px;
        }

        /* Login button */

        .login-button {
            width: 100%;
            height: 43px;

            border: none;
            border-radius: 6px;

            background: #1f6b45;
            color: white;

            font-size: 12px;
            font-weight: bold;

            cursor: pointer;

            margin-top: 8px;
        }

        .login-button:hover {
            background: #185638;
        }

        /* Register */

        .register {
            text-align: center;

            margin-top: 14px;

            font-family: Arial, sans-serif;
            font-size: 10px;

            color: #777;
        }

        .register a {
            color: #1f6b45;
            font-weight: bold;
            text-decoration: none;
        }

        .register a:hover {
            text-decoration: underline;
        }

        /* =========================
           MOBILE
        ========================== */

        @media (max-width: 768px) {

            .page {
                flex-direction: column;
            }

            .left-side {
                width: 100%;
                min-height: 45vh;

                padding: 25px;
            }

            .quote {
                left: 25px;
                right: 25px;
                bottom: 25px;
            }

            .quote h1 {
                font-size: 22px;
            }

            .right-side {
                width: 100%;
                min-height: 55vh;

                padding: 30px 25px;
            }

            .login-box h2 {
                font-size: 24px;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <!-- LEFT SIDE -->
    <div class="left-side">

        <div class="brand">
            <div class="brand-icon">✦</div>
            <span>AniHub</span>
        </div>

        <div class="quote">
            <h1>
                "Selling directly through AniHub
                transformed our farm security.
                We set prices, and bypass third
                party wholesalers."
            </h1>

            <div class="name">
                Vance Organic Farm
            </div>

            <div class="location">
                Napa Valley, California
            </div>
        </div>

    </div>


    <!-- RIGHT SIDE -->
    <div class="right-side">

        <div class="login-box">

            <h2>Welcome Back</h2>

            <p class="subtitle">
                Log in to your AniHub account.
            </p>

            <?php if (!empty($error)): ?>

                <div class="error">
                    <?php echo htmlspecialchars($error); ?>
                </div>

            <?php endif; ?>


            <form action="login_process.php" method="POST">

                <!-- Email -->
                <div class="form-group">

                    <label for="email">
                        Email Address
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                    >

                </div>


                <!-- Password -->
                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <div class="password-wrapper">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required
                        >

                        <span
                            class="eye"
                            onclick="togglePassword()"
                        >◉</span>

                    </div>

                </div>


                <!-- Login -->
                <button
                    type="submit"
                    class="login-button"
                >
                    Log In
                </button>

            </form>


            <!-- Create Account -->
            <div class="register">

                Don't have an account?
                <a href="register.php">
                    Create an account
                </a>

            </div>

        </div>

    </div>

</div>


<script>
    function togglePassword() {

        const password =
            document.getElementById("password");

        if (password.type === "password") {
            password.type = "text";
        } else {
            password.type = "password";
        }
    }
</script>

</body>
</html>
