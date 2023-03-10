<?php
/**
 * @var string $title
 * @var array $admin
 * @var string $active_link
 */
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/6fcf003f29.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Elsie&family=Raleway:wght@800&family=Roboto&display=swap"
        rel="stylesheet">

    <title>
        <?php echo $title ?>
    </title>
</head>

<body class="overflow-hidden">
    <header class="dashboard-header">
        <div class="brand">

            <div class="dashboard-header__logo">
                <img class="logo" src="/assets/images/logo.jpg" alt="logo">
            </div>

            <div class="dashboard-header__title">
                <h2>Aura</h2>
                <h5>Community Health Net</h5>
            </div>

        </div>
        <div class="dashboard-header__profile">

            <div class="header-link__container">
                <a class="header-link" href="/">Home</a>
                <a class="header-link" href="/contactcdcd-us">Contact Us</a>
                <a class="header-link" href="/about-us">About Us</a>
            </div>
            <div class="admin-header">
                <p>
                    <?php echo $admin["name"]; ?>
                    <img src="/assets/images/admin-profile-pic.jpg" alt="">
                </p>
            </div>

        </div>
    </header>

    <div class="title">
        <h2 class="title-text">
            <?php echo $title ?>
        </h2>
    </div>

    <div class="dashboard-container">
        <nav class="dashboard-container__side-nav">
            <ul>
                <li>
                    <a href="/admin-dashboard">
                        <button class="navbtn <?php echo $active_link === 'dashboard' ? 'active' : '' ?>">
                            <span class="nav-icon"><i class="fa-solid fa-gauge"></i></span>
                            <span class="nav-title">Dashboard</span>
                        </button>
                    </a>
                </li>

                <li>
                    <a href="/admin-dashboard/new-registrations"><button
                            class="navbtn <?php echo $active_link === 'new-registrations' || $active_link === 'products' ? 'active' : '' ?>">
                            <span class="nav-icon"><i class="fa-solid fa-circle-plus"></i></span>
                            <span class="nav-title">Registrations</span>
                        </button></a>
                </li>

                <li>
                    <a href="/admin-dashboard/due-payments">
                        <button class="navbtn" <?php echo $active_link === 'payments' ? 'active' : '' ?>">
                            <span class="nav-icon"><i class="fa-regular fa-rectangle-list"></i></span>
                            <span class="nav-title">Payments</span>
                        </button>
                    </a>

                </li>

                <li>
                    <a href="/admin-dashboard/feedback">
                        <button class="navbtn" <?php echo $active_link === 'feedback' ? 'active' : '' ?>">
                            <span class="nav-icon"><i class="fa-solid fa-chart-line"></i></span>
                            <span class="nav-title">Feedback</span>
                        </button>
                    </a>
                </li>

                <li class="logout">
                    <a href="/administrator-login">
                        <button class="navbtn" <?php echo $active_link === 'profile' ? 'active' : '' ?>">
                        <span class="nav-icon">
                            <i class="fa-solid fa-right-from-bracket"></i></span>
                        <span class="nav-title">Logout</span>
                        </button>
                    </a>

                </li>
            </ul>
        </nav>

        <main class="dashboard-content">
            {{content}}
        </main>
    </div>

    <div class="toggle">
        <i class="fa-solid fa-bars"></i>
    </div>

    <script src="/assets/js/components/sidebar.js"></script>

</body>

</html>