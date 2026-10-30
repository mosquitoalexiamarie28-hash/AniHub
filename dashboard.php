<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$full_name = $_SESSION['full_name'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>AniHub Dashboard</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f7f7f3;
            color: #333;
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 220px;
            height: 100vh;
            background: #176b3a;
            color: white;
            padding: 28px 15px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 8px;
            font-family: Georgia, serif;
            font-size: 21px;
            font-weight: bold;
            margin-bottom: 45px;
            padding-left: 8px;
        }

        .logo-icon {
            width: 27px;
            height: 27px;
            border-radius: 50%;
            background: white;
            color: #176b3a;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 14px;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin-bottom: 8px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            padding: 12px 13px;
            border-radius: 6px;
            font-size: 13px;
        }

        .menu a:hover,
        .menu a.active {
            background: #10552d;
        }

        .menu-icon {
            width: 18px;
            text-align: center;
        }


        /* MAIN */

        .main {
            margin-left: 220px;
            min-height: 100vh;
            padding: 38px 40px;
        }


        /* HEADER */

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .welcome h1 {
            font-family: Georgia, serif;
            color: #183d2b;
            font-size: 28px;
            margin-bottom: 7px;
        }

        .welcome p {
            color: #777;
            font-size: 13px;
        }

        .header-buttons {
            display: flex;
            gap: 10px;
        }

        .header-buttons button {
            padding: 11px 17px;
            border-radius: 7px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
        }

        .add-crop {
            background: #176b3a;
            color: white;
            border: 1px solid #176b3a;
        }

        .orders-desk {
            background: white;
            color: #176b3a;
            border: 1px solid #176b3a;
        }


        /* STAT CARDS */

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: white;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            padding: 20px;
            min-height: 125px;
        }

        .stat-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .stat-title {
            color: #777;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: .3px;
        }

        .stat-icon {
            color: #176b3a;
            font-size: 16px;
        }

        .stat-value {
            color: #183d2b;
            font-family: Georgia, serif;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 9px;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 10px;
            background: #e8f5ec;
            color: #176b3a;
            font-size: 9px;
            font-weight: bold;
        }

        .badge.warning {
            background: #fff0e8;
            color: #c45b20;
        }


        /* ORDERS */

        .orders-box {
            background: white;
            border: 1px solid #e5e5e5;
            border-radius: 12px;
            padding: 25px;
        }

        .orders-title {
            margin-bottom: 20px;
        }

        .orders-title h2 {
            font-family: Georgia, serif;
            color: #183d2b;
            font-size: 19px;
            margin-bottom: 5px;
        }

        .orders-title p {
            color: #888;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            color: #888;
            font-size: 10px;
            font-weight: bold;
            padding: 12px 10px;
            border-bottom: 1px solid #e9e9e9;
        }

        td {
            padding: 15px 10px;
            font-size: 12px;
            border-bottom: 1px solid #eeeeee;
        }

        tr:last-child td {
            border-bottom: none;
        }

        .order-id {
            color: #777;
            font-weight: bold;
        }

        .payout {
            color: #176b3a;
            font-weight: bold;
        }


        /* RESPONSIVE */

        @media (max-width: 1000px) {

            .stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .header {
                align-items: flex-start;
                gap: 20px;
            }

        }

        @media (max-width: 700px) {

            .sidebar {
                width: 180px;
            }

            .main {
                margin-left: 180px;
                padding: 25px;
            }

            .header {
                display: block;
            }

            .header-buttons {
                margin-top: 18px;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .orders-box {
                overflow-x: auto;
            }

            table {
                min-width: 650px;
            }

        }

    </style>

</head>

<body>


    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="logo">

            <div class="logo-icon">
                🌿
            </div>

            AniHub

        </div>


        <ul class="menu">

            <li>

                <a href="dashboard.php" class="active">

                    <span class="menu-icon">▦</span>

                    Dashboard

                </a>

            </li>


            <li>

                <a href="#">

                    <span class="menu-icon">◉</span>

                    My Products

                </a>

            </li>


            <li>

                <a href="#">

                    <span class="menu-icon">⚙</span>

                    Farm Settings

                </a>

            </li>


            <li>

                <a href="logout.php">

                    <span class="menu-icon">↪</span>

                    Logout

                </a>

            </li>

        </ul>

    </aside>



    <!-- MAIN CONTENT -->

    <main class="main">


        <!-- HEADER -->

        <section class="header">

            <div class="welcome">

                <h1>
                    Welcome back, <?php echo htmlspecialchars($full_name); ?>
                </h1>

                <p>
                    <?php echo ucfirst(htmlspecialchars($role)); ?>
                    Account • AniHub Marketplace
                </p>

            </div>


            <div class="header-buttons">

                <button class="add-crop">
                    + Add New Crop
                </button>

                <button class="orders-desk">
                    Orders Desk
                </button>

            </div>

        </section>



        <!-- STATISTICS -->

        <section class="stats">


            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Total Revenue
                    </span>

                    <span class="stat-icon">
                        ↗
                    </span>

                </div>

                <div class="stat-value">
                    $28,490.00
                </div>

                <span class="badge">
                    +12.4%
                </span>

            </div>



            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Active Listings
                    </span>

                    <span class="stat-icon">
                        ◈
                    </span>

                </div>

                <div class="stat-value">
                    14 Crops
                </div>

                <span class="badge">
                    Healthy
                </span>

            </div>



            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Pending Deliveries
                    </span>

                    <span class="stat-icon">
                        ♧
                    </span>

                </div>

                <div class="stat-value">
                    8 Orders
                </div>

                <span class="badge warning">
                    Action Needed
                </span>

            </div>



            <div class="stat-card">

                <div class="stat-top">

                    <span class="stat-title">
                        Average Rating
                    </span>

                    <span class="stat-icon">
                        ☆
                    </span>

                </div>

                <div class="stat-value">
                    4.9 / 5.0
                </div>

                <span class="badge">
                    Excellent
                </span>

            </div>

        </section>



        <!-- RECENT ORDERS -->

        <section class="orders-box">

            <div class="orders-title">

                <h2>
                    Recent Marketplace Orders
                </h2>

                <p>
                    Your latest orders from the AniHub marketplace.
                </p>

            </div>


            <table>

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>BUYER / GROUP</th>

                        <th>HARVEST CROP</th>

                        <th>QTY</th>

                        <th>PAYOUT</th>

                    </tr>

                </thead>


                <tbody>

                    <tr>

                        <td class="order-id">
                            #AH-89
                        </td>

                        <td>
                            GreenTable Group
                        </td>

                        <td>
                            Organic Heirloom Tomatoes
                        </td>

                        <td>
                            450 kg
                        </td>

                        <td class="payout">
                            $2,026
                        </td>

                    </tr>


                    <tr>

                        <td class="order-id">
                            #AH-88
                        </td>

                        <td>
                            Market Valley Farms
                        </td>

                        <td>
                            Sweet Honeycrisp Apples
                        </td>

                        <td>
                            120 kg
                        </td>

                        <td class="payout">
                            $384
                        </td>

                    </tr>


                    <tr>

                        <td class="order-id">
                            #AH-87
                        </td>

                        <td>
                            The Bakery Co.
                        </td>

                        <td>
                            Gold Premium Wheat Berries
                        </td>

                        <td>
                            1,200 kg
                        </td>

                        <td class="payout">
                            $2,160
                        </td>

                    </tr>

                </tbody>

            </table>

        </section>

    </main>

</body>

</html>