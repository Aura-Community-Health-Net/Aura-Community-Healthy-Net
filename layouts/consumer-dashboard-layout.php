<?php
/**
 * @var string $title
 * @var array $consumer
 * @var string $active_link
 */
//print_r($consumer);
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
    <link rel="icon" href="/assets/images/logo-lan.png">
    <script src="https://js.stripe.com/v3/"></script>
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
            <a class="header-link" href="/contact-us">Contact Us</a>
            <a class="header-link" href="/about-us">About Us</a>
            <a class="header-link" href="/cart"><i class='fa-solid fa-cart-plus'></i></a>
        </div>

        <p>
            <?php echo $consumer["name"]; ?>
        </p>
        <img src="<?php echo $consumer['profile_picture'] ?>" alt="">
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
                <a href="/consumer-dashboard">
                    <button class="navbtn <?php echo $active_link === 'dashboard' ? 'active' : '' ?>">
                        <span class="nav-icon"><i class="fa-solid fa-gauge"></i></span>
                        <span class="nav-title">Dashboard</span>
                    </button>
                </a>
            </li>

            <div>
                <li id="services-link">
                    <button
                            class="navbtn <?php echo $active_link === 'services' || $active_link === 'services' ? 'active' : '' ?>">
                            <span class="nav-icon"><i class="fa-solid fa-circle-plus"></i></span>
                            <span class="nav-title">Services</span>
                            <span class="nav-icon nav-icon--toggle"><i class="fa-solid fa-angle-right sidebar-dropdown"></i></span>
                        </button>

            </li>
                <div class="sidebar__services-list" id="services-list">
                    <a href="/consumer-dashboard/services/doctor" class="navbtn sub__navbtn navbtn--link">
                        <span class="nav-icon"><i class="fa-solid fa-stethoscope"></i></span>
                        <span class="navtitle">Doctor</span>
                    </a>

                    <a href="/consumer-dashboard/services/pharmacy" class="navbtn sub__navbtn navbtn--link">
                        <span class="nav-icon"><i class="fa-solid fa-capsules"></i></span>
                        <span class="navtitle">Pharmacy</span>
                    </a>

                    <a href="/consumer-dashboard/products" class="navbtn sub__navbtn navbtn--link">
                        <span class="nav-icon"><i class="fa-solid fa-leaf"></i></span>
                        <span class="navtitle">Food Products</span>
                    </a>

                    <a href="/consumer-dashboard/services/care-rider" class="navbtn sub__navbtn navbtn--link">
                        <span class="nav-icon"><i class="fa-solid fa-car"></i></span>
                        <span class="navtitle">Care Rider</span>
                    </a>

                </div>

            </div>



            <li>
                <a href="/consumer-dashboard/analytics">
                    <button class="navbtn" <?php echo $active_link === 'analytics' ? 'active' : '' ?>">
                    <span class="nav-icon"><i class="fa-solid fa-chart-line"></i></span>
                    <span class="nav-title">Analytics</span>
                    </button>
                </a>

            </li>

            <li>
                <a href="/consumer-dashboard/feedback">
                    <button class="navbtn" <?php echo $active_link === 'feedback' ? 'active' : '' ?>">
                    <span class="nav-icon"><i class="fa-solid fa-clipboard-list"></i></i></span>
                    <span class="nav-title">Feedback</span>
                    </button>
                </a>

            </li>

            <li>
                <a href="/consumer-dashboard/profile">
                    <button class="navbtn" <?php echo $active_link === 'profile' ? 'active' : '' ?>">
                    <span class="nav-icon"><i class="fa-solid fa-user"></i></span>
                    <span class="nav-title">Profile</span>
                    </button>
                </a>

            </li>

            <li class="logout">
                <form action="/logout" method="post">
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
<script src="https://js.stripe.com/v3/"></script>
</body>

</html>
