<?php
/**
 * @var string $title
 * @var array $product_seller
 * @var array $products
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
        Registration Overview
    </title>
</head>

<body>
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

    <div class="header-link__container">
        <a class="header-link" href="#our-services">Our Services</a>
        <a class="header-link" href="/contact-us">Contact Us</a>
        <a class="header-link" href="/about-us">About Us</a>
        <?php
        $nic = isset($_SESSION["nic"]) ? $_SESSION['nic'] : false;

        if (!$nic){
            echo "<a class='login-link' href='/login'>Log in</a>";
        }
        ?>

        <?php
        $nic = isset($_SESSION["nic"]) ? $_SESSION['nic'] : false;

        if (!$nic){
            echo "<a class='login-link' href='/provider-login'>Log in as Provider</a>";
        } else {
            echo "<a class='login-link'> You are logged in as $nic </a>";
        }
        ?>
    </div>
</header>

<div class="title">
    <h2 class="title-text">
        Registration
    </h2>
</div>


<div class="registration-overview__container">
    <img src="/assets/images/doctor-reg.png" alt="">
    <img src="/assets/images/pharmacy-reg.webp" alt="">
    <img src="/assets/images/products-reg.png" alt="">
    <img src="/assets/images/care-rider-reg.webp" alt="">
    <img src="/assets/images/consumer-reg.webp" alt="">
</div>

<div class="registration-overview__buttons">
    <div>
        <button class="btn"><a href="/provider-register?provider_type=doctor">Doctor</a></button>

    </div>
    <div>
        <button class="btn"><a href="/provider-register?provider_type=pharmacy">Pharmacy</a></button>

    </div>
    <div>
        <button class="btn"><a href="/provider-register?provider_type=product-seller">Product Seller</a></button>

    </div>
    <div>
        <button class="btn"><a href="/provider-register?provider_type=care-rider">Care Rider</a></button>
    </div>
    <div>
        <button class="btn"><a href="/register">Customer</a></button>

    </div>

</div>

<footer class="footer-section">
    <div class="section-one">
        <img src="/assets/images/logo.jpg" alt="">
        <div style="display: flex;flex-direction: column;justify-content: center;align-items: flex-start">
            <h5>Aura Community Health Net</h5>
            <h5 class="footer-details">©2022 Aura. All rights reserved</h5>
        </div>
    </div>

    <div class="section-two">
        <h5 class="footer-title">Address</h5>
        <h5 class="footer-details">No 125A, Kirulapone Avenue, Colombo 5</h5>
    </div>

    <div class="section-three">
        <h5 class="footer-title">Contact</h5>
        <a href="tel:+94 70 5878673" class="footer-details">+94 70 5878673</a>
        <a href="tel:+94 70 5878674" class="footer-details">+94 70 5878674</a>
        <a href="mailto:auracommunityhealthnet@gmail.com" class="footer-details">auracommunityhealthnet@gmail.com</a>
        <div class="footer-icon">
            <a href="https://www.facebook.com/" style="font-size: 2rem"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.instagram.com/" style="font-size: 2rem"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://twitter.com/" style="font-size: 2rem"><i class="fa-brands fa-twitter"></i></a>
        </div>
    </div>

    <div class="section-four">
        <h5 class="footer-title">About</h5>
        <a href="/about-us" class="footer-details">About us</a>
        <a href="/user-agreement" class="footer-details">User Agreement</a>
        <a href="/privacy-policy" class="footer-details">Privacy Policy</a>
    </div>
</footer>
</body>