<?php
/**
 * @var string $title
 * @var array $care_rider
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
                <img src="/assets/images/logo.jpg" alt="logo">
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
            <p>
                <?php echo $care_rider["name"]; ?>
            </p>
            <img src="<?php echo $care_rider['profile_picture'] ?>" alt="">
        </div>
    </header>

    <div class="title">
        <h2 class="title-text">
            <?php echo $title ?>
        </h2>
    </div>

    <div class="dashboard-container">
        <nav class="dashboard-container__side-nav active">
            <ul>
                <li>
                    <a href="/care-rider-dashboard">
                        <button class="navbtn <?php echo $active_link === 'dashboard' ? 'active' : '' ?>">
                            <span class="nav-icon"><i class="fa-solid fa-gauge"></i></span>
                            <span class="nav-title">Dashboard</span>
                        </button>
                    </a>
                </li>

                <li>
                    <a href="/care-rider-dashboard/timeslots"><button
                            class="navbtn <?php echo $active_link === 'timeslots' ? 'active' : '' ?>">
                            <span class="nav-icon"><i class="fa-solid fa-circle-plus"></i></span>
                            <span class="nav-title">Time-Slots</span>
                        </button></a>
                </li>

                <li>
                    <a href="/care-rider-dashboard/new-requests">
                        <button class="navbtn" <?php echo $active_link === 'new-requests' ? 'active' : '' ?>">
                            <span class="nav-icon"><i class="fa-regular fa-rectangle-list"></i></span>
                            <span class="nav-title">New Requests</span>
                        </button>
                    </a>

                </li>

                <li>
                    <a href="/care-rider-dashboard/analytics">
                        <button class="navbtn" <?php echo $active_link === 'analytics' ? 'active' : '' ?>">
                            <span class="nav-icon"><i class="fa-solid fa-chart-line"></i></span>
                            <span class="nav-title">Analytics</span>
                        </button>
                    </a>

                </li>

                <li>
                    <a href="/care-rider-dashboard/feedback">
                        <button class="navbtn" <?php echo $active_link === 'fedback' ? 'active' : '' ?>">
                            <span class="nav-icon"><i class="fa-solid fa-clipboard-list"></i></i></span>
                            <span class="nav-title">Feedback</span>
                        </button>
                    </a>

                </li>

                <li>
                    <a href="/care-rider-dashboard/profile">
                        <button class="navbtn" <?php echo $active_link === 'profile' ? 'active' : '' ?>">
                            <span class="nav-icon"><i class="fa-solid fa-user"></i></span>
                            <span class="nav-title">Profile</span>
                        </button>
                    </a>

                </li>
                <li class="logout">
                    <form action="/provider-logout" method="post">
                        <button class="navbtn" <?php echo $active_link === 'profile' ? 'active' : '' ?>">
                        <span class="nav-icon">
                            <i class="fa-solid fa-right-from-bracket"></i></span>
                        <span class="nav-title">Logout</span>
                        </button>
                    </form>

                </li>
            </ul>
        </nav>

        <main class="dashboard-content">
            {{content}}
        </main>
    </div>

    <div class="toggle active">
        <i class="fa-solid fa-bars"></i>
    </div>

    <script src="/assets/js/components/sidebar.js"></script>

</body>

</html>