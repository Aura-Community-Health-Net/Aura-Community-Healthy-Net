<?php
$nic = isset($_SESSION["nic"]) ? $_SESSION['nic'] : false;

$is_consumer = isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "consumer";
if ($is_consumer) {
    $link = "/consumer-dashboard";
} elseif ($nic) {
    $provider_type = $_SESSION["user_type"];
    switch ($provider_type) {
        case "doctor":
            $link = "/doctor-dashboard";
            break;

        case "pharmacy":
            $link = "/pharmacy-dashboard";
            break;

        case "product-seller":
            $link = "/product-seller-dashboard";
            break;

        case "care-rider":
            $link = "/care-rider-dashboard";
            break;
    }
}
?>

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
        <a class="header-link" href="/">Home</a>
        <a class="header-link" href="/terms-conditions-and-user-agreements">About Us</a>
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
            echo "<a class='login-link' href='$link'> You are logged in as $nic </a>";
        }
        ?>
    </div>
</header>

<div class="contact-us-container">
    <h1>Get in touch !</h1>
    <h3>Contact Us</h3>
    <div class="contact-us-sections">
        <div class="contact-us-container__details">
            <i class="fa-solid fa-location-dot contact-us-icon"></i>
            <p>No 125A, Kirulapone Avenue, Colombo 5</p>
        </div>
        <div class="contact-us-container__details">
            <i class="fa-solid fa-phone contact-us-icon"></i><br>
            <a href="tel:+94 70 5878673">+94 70 5878673</a><br>
            <a href="tel:+94 70 5878674">+94 70 5878674</a>
        </div>
        <div class="contact-us-container__details">
            <i class="fa-solid fa-envelope contact-us-icon"></i>
            <a href="mailto:auracommunityhealthnet@gmail.com">auracommunityhealthnet@gmail.com</a>
            </p>
        </div>
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
        <a href="mailto:auracommunityhealthnet@gmail.com"
           class="footer-details">auracommunityhealthnet@gmail.com</a>
        <div class="footer-icon">
            <a href="https://www.facebook.com/" style="font-size: 2rem"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.instagram.com/" style="font-size: 2rem"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://twitter.com/" style="font-size: 2rem"><i class="fa-brands fa-twitter"></i></a>
        </div>
    </div>

    <div class="section-four">
        <h5 class="footer-title">About</h5>
        <a href="/about-us" class="footer-details">About us</a>
        <a href="/terms-conditions-and-user-agreements" class="footer-details">User Agreement</a>
        <a href="/terms-conditions-and-user-agreements" class="footer-details">Privacy Policy</a>
    </div>
</footer>