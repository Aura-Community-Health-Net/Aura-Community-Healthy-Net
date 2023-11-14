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
        <a class="header-link" href="/contact-us">Contact Us</a>

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

<div class="about-us-container">
    <h2>About Us</h2>
    <h3>Welcome to Aura Community Health Net!</h3>
    <p>
         Our mission is to provide convenient and affordable healthcare solutions to our community members.

        Our platform connects users with a variety of service providers, including doctors, pharmacies, product sellers, and care riders. We believe that by bringing these services together in one place, we can create a more accessible and efficient healthcare system for everyone.

        Our team is passionate about using technology to improve healthcare. We believe that by leveraging the power of the internet, we can bridge the gap between patients and providers and make healthcare more accessible for everyone.

        At Aura Community Health Net, we value our users' trust and privacy. We take the security of our platform and the information it contains very seriously. Our team works tirelessly to ensure that our platform is secure and that our users' data is protected at all times.

        We are committed to creating a platform that is easy to use and accessible to everyone. Whether you're looking for a doctor, a pharmacy, or a care rider, our platform is designed to make it easy to find the right service provider for your needs.

        Thank you for choosing Aura Community Health Net. We look forward to serving you and your community for years to come.
    </p>
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