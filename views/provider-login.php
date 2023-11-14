<div class="login-form">
    <div class="login-form__left">
        <div class="login-slide-container">
            <div class="login-slide login-slide--active">
                <img src="/assets/images/doctor-login.webp" alt="" class="login-slide__img">
            </div>
            <div class="login-slide">
                <img src="/assets/images/pharmacy-login.webp" alt="" class="login-slide__img">
            </div>
            <div class="login-slide">
                <img src="/assets/images/products-login.webp" alt="" class="login-slide__img">
            </div>
            <div class="login-slide">
                <img src="/assets/images/care_rider-login.webp" alt="" class="login-slide__img">
            </div>
        </div>
    </div>
    <div class="login-form__right">
        <form class="provider-login-form" action="/provider-login" method="post">
            <img class="login-logo" src="assets/images/logo.jpg" alt="logo">
            <div class="login-form__header">
                <h1>Hello Again!</h1>
            </div>
            <div class="form-input">
                <label class="form-input__label" for="email">Email Address</label>
                <input class="form-input__input" id="email" type="email" name="email" required>
                <?php
                if (isset($errors) && isset($errors["email"])) {
                    echo "<p class = 'errors'> {$errors["email"]}</p>";
                }
                ?>
            </div>
            <br>
            <div class="form-input">
                <label class="form-input__label" for="password">Password</label>
                <input class="form-input__input" id="password" type="password" name="password" required>
                <?php
                if (isset($errors) && isset($errors["password"])) {
                    echo "<p class = 'errors'> {$errors["password"]}</p>";
                }
                ?>
            </div>
            <br>
            <div class="provider-login-form__bottom">
                <div class="remember-me">
                    <input type="checkbox" id="remember-me" name="rememberMe">
                    <label class="remember-me" for="remember-me">Remember me</label>
                </div>

                <div class="login-to-register">
                    <p>Don't have an account?</p>
                    <a class="reg-section" href="/registration-overview">Register</a>
                </div>
            </div>
            <button class="btn btn--block login-btn">Login</button>
        </form>
    </div>
</div>
<script src="/assets/js/pages/provider-login.js"></script>
<!--</body>-->
<!--</html>-->