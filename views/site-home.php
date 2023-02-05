<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/assets/css/main.css">
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

            <?php
            $nic = $_SESSION["nic"];
            if (!$nic){
                echo "<a class='login-link' href='/login'>Log in</a>";
            } else {
                echo "<a class='login-link'> You are logged in as $nic </a>";
            }
            ?>
        </header>

        <div class="intro">
            <h6>Everyday people. Extraordinary care.</h6>
            <h3>Welcome to</h3>
            <h3>Aura Community Health Net</h3>
        </div>

        <?php

        if (!$nic){
            echo "<button>Register Now</button>";
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

        <h2>Our Services</h2>

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
                <img src="/assets/images/care_rider-lan.png" alt="">
                <h3>Care Rider</h3>
                <div class="description">
                    <p>In case of emergency you will be able to make a request to the Care Riders according to your
                        preference to
                        carry patients to the hospitals. </p>
                </div>
            </div>
        </div>

        <footer>
            <a href="">Privacy Policy</a>
            <a href="">About Us</a>
            <a href="">Contact Us</a>
        </footer>
    </section>



</body>

</html>