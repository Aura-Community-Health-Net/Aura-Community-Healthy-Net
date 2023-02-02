<?php
/**
 * @var string $title
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
        <?php echo $title; ?>
    </title>
</head>

<body>
    <header class="provider-signup-header">
        <div class="provider-signup-header__brand">
        <div class="provider-signup-header__logo">
            <img src="assets/images/logo.jpg" alt="logo">
        </div>
        <div class="provider-signup-header__title">
            <h2>Aura</h2>
            <h3>Community Health Net</h5>
        </div>
        </div>
        <nav>
            <ul>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    {{content}}
</body>

</html>