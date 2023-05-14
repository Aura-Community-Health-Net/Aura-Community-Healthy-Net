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
            echo "<a class='login-link' href='#'> You are logged in as $nic </a>";
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