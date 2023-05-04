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