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
</header>

<div class="title">
    <h2 class="title-text">
        Registration
    </h2>
</div>


<div class="registration-overview__container">
    <img src="/assets/images/doctor-reg.png" alt="">
    <img src="/assets/images/pharmacy-reg.png" alt="">
    <img src="/assets/images/products-reg.png" alt="">
    <img src="/assets/images/care-rider-reg.png" alt="">
    <img src="/assets/images/consumer-reg.png" alt="">
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

</body>