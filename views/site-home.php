<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/main.css">
    <script src="https://kit.fontawesome.com/6fcf003f29.js" crossorigin="anonymous"></script>
    <title>Aura</title>
</head>

<body>
    <div class="background-img">
        <header class="landing-header">
            <div class="landing-header-brand">
                <div class="landing-header-logo">
                    <img class="logo" src="assets/images/logo-lan.png" alt="logo">
                </div>

                <div class="landing-header-title">
                    <h2>Aura</h2>
                    <h5>Community Health Net</h5>
                </div>
            </div>

            <div class="header-link__container">
                <a class="header-link" href="#our-services">Our Services</a>
                <a class="header-link" href="/contactcdcd-us">Contact Us</a>
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

        <div class="intro">
            <h6>Everyday people. Extraordinary care.</h6>
            <h3>Welcome to</h3>
            <h3>Aura Community Health Net</h3>
        </div>

        <?php

        if (!$nic){
            echo "<button class='registration-home-btn'><a href='/registration-overview'>Register Now</a></button>";
        }
        ?>

    </div>

    <section class="testimony">
        <h2>Who we are</h2>
        <p>Aura - Community Health Net offers a range of healthcare services for newborn through geriatric community,
            regardless of your ability to pay.
            We are all part of this community. And we all deserve quality healthcare. No matter our age, race, or
            income.
            That is why Aura - Community Health Net is here. Our goal is to provide everyday people with extraordinary
            care and our mission is to
            improve the quality of life in our region, by providing professional healthcare services with compassion,
            respect and dignity to all. You can get services
            under 4 categories such as Doctors, Pharmacy, Product Sellers and Care Riders by making payments via the
            site very easily.</p>

        <hr>

        <h2 id="our-services">Our Services</h2>

        <div class="services">
            <div class="services-cat">
                <img src="/assets/images/doctor-lan.png" alt="">
                <h3>Doctor</h3>
                <div class="description">
                    <p>You will be able to get treatments from specialized Doctors under certain categories such as
                        Western Doctors,
                        Indigenous Doctors and Counselors we provided our services. You can reserve a time slot for a
                        relevant doctor
                        and doctor will visit your place for the treatments.
                    </p>
                </div>
            </div>

            <div class="services-cat">
                <img src="/assets/images/pharmacy-lan.png" alt="">
                <h3>Pharmacy</h3>
                <div class="description">
                    <p>You will be able to order the medicines from the available Pharmacies according your preference
                        or location.
                        After making an advance payment of 30% from total price, you will get a chance to order and
                        reserve medicines from
                        a certain pharmacy.
                    </p>
                </div>
            </div>

            <div class="services-cat">
                <img src="/assets/images/products-lan.png" alt="">
                <h3>Healthy Food Products</h3>
                <div class="description">
                    <p>You will be able to order the Healthy food products from the Product Sellers according to your
                        preference under
                        6 categories such as Medicinal Fruits and Vegetables, Seeds, Leaves, Dried Herbs and Cooked
                        Foods.

                    </p>
                </div>
            </div>

            <div class="services-cat">
                <img src="/assets/images/care_rider-lan.webp" alt="">
                <h3>Care Rider</h3>
                <div class="description">
                    <p>In case of emergency you will be able to make a request to the Care Riders according to your
                        preference to
                        carry patients to the hospitals. </p>
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
    </section>



</body>

</html>