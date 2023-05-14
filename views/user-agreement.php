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

<div class="user-agreement-container">
    <h2>Terms, Conditions and User Agreements</h2>
    <h3>Welcome to Aura Community Health Net!</h3>
    <h3>By using our website, you agree to comply with the following terms and conditions</h3>
    <p>
        <h4 class="user-agreement-topic">Registration and Verification for Service Providers</h4>

        a. To use our website, you need to register with us by providing your valid details in the Registration Page according to your service category.<br>
        b. We will verify your registration details by checking your details and documentation that you give in the registration.<br>
        c. We reserve the right to approve or reject your registration at our discretion.<br>

        <h4 class="user-agreement-topic">Service Providers</h4>

        a. Our website offers services provided by Doctors, Pharmacies, Product Sellers, and Care Riders.<br>
        b. We do not endorse or guarantee the quality or reliability of these services.<br>
        c. You are responsible for verifying the credentials and qualifications of the service providers before using their services.<br>

        <h4 class="user-agreement-topic">Booking and Payment</h4>

        a. To book a service, you need to select a service provider, choose a time slot, and provide your location details.<br>
        b. You need to pay for the services via our website using the available payment methods.<br>
        c. We may charge a processing fee for each transaction.<br>

        <h4 class="user-agreement-topic">Feedback and Complaints</h4>

        a. We encourage you to provide feedback and ratings for the service providers.<br>
        b. If you have a complaint or dispute with a service provider, please contact us immediately.<br>
        c. We will investigate the complaint and take appropriate action.<br>

        <h4 class="user-agreement-topic">Privacy and Security</h4>

        a. We take your privacy and security seriously and use industry-standard measures to protect your personal information.<br>
        b. We may collect and use your personal information for the purpose of providing our services.<br>
        c. We may share your personal information with the service providers for the purpose of delivering the services.<br>

        <h4 class="user-agreement-topic">Liability and Indemnity</h4>

        a. We are not liable for any damages or losses arising from the use of our website or services.<br>
        b. You agree to indemnify and hold us harmless from any claims, damages, or losses arising from your use of our website or services.<br>

        <h4 class="user-agreement-topic">Governing Law and Jurisdiction</h4>

        a. This agreement is governed by the laws of Sri Lanka. <br>
        b. Any disputes arising from this agreement will be resolved by the courts of Sri Lanka.<br>

        <h3>In addition to the user agreement, we have the following policies that apply to our website</h3>

        <h4 class="user-agreement-topic">Verification Policy</h4>

        a. We verify the registration details of the service providers to ensure their authenticity and compliance with our policies.<br>
        b. We may ask for additional information or documentation to complete the verification process.<br>
        c. We reserve the right to reject or suspend the registration of any service provider who fails to comply with our policies.<br>

        <h4 class="user-agreement-topic">Refund Policy</h4>

        a. We offer refunds for the services if they are not delivered as promised or if there is a dispute between the customer and the service provider.<br>
        b. You need to contact us within [insert your refund period] days of the service delivery to request a refund.<br>
        c. We may require proof of the service delivery and other information to process the refund.<br>

        <h4 class="user-agreement-topic">Privacy Policy</h4>

        a. We collect and use your personal information only for the purpose of providing our services.<br>
        b. We may share your personal information with the service providers for the purpose of delivering the services.<br>
        c. We may use cookies and other tracking technologies to improve our website and services.<br>

        <h4 class="user-agreement-topic">Security Policy</h4>

        a. We use industry-standard measures to protect your personal information from unauthorized access, disclosure, or use.<br>
        b. We regularly monitor our systems and network for security threats and vulnerabilities.<br>
        c. We may suspend or terminate your account if we suspect any unauthorized access or use of your account.<br>

        <h4 class="user-agreement-topic">Feedback Policy</h4>

        a. We encourage you to
    </p>
</div>