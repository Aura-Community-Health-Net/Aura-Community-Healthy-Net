<form id="reg-form" class="provider-signup-form" action="/register" method="post"
    enctype="multipart/form-data">
    <div class="title">
        <h2 class="title-text">Register with Aura</h2>
    </div>

    <div class="provider-signup-form__top">
        <div class="provider-signup-form__left">

            <div class="form-input">
                <label class="form-input__label" for="name">Name <sup>*</sup></label>
                <input class="form-input__input" id="name" type="text" name="name"
                    value="<?php echo $_POST['name'] ?? ''; ?>" required>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="nic">NIC <sup>*</sup></label>
                <input class="form-input__input" id="nic" type="text" name="nic"
                    value="<?php echo $_POST['nic'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["nic"])) {
                    echo "<p class = 'errors'> {$errors["nic"]}</p>";
                }
                ?>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="email">Email Address <sup>*</sup></label>
                <input class="form-input__input" id="email" type="email" name="email"
                    value="<?php echo $_POST['email'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["email"])) {
                    echo "<p class = 'errors'> {$errors["email"]}</p>";
                }
                ?>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="mobileNumber">Mobile Number <sup>*</sup></label>
                <input class="form-input__input" id="mobileNumber" type="text" name="mobileNumber"
                    value="<?php echo $_POST['mobileNumber'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["mobileNumber"])) {
                    echo "<p class = 'errors'> {$errors["mobileNumber"]}</p>";
                }
                ?>
            </div>
        </div>
        <div class="provider-signup-form__right">
            <div class="form-input">
                <label class="form-input__label" for="address">Address <sup>*</sup></label>
                <input class="form-input__input" id="address" type="text" name="address"
                       value="<?php echo $_POST['address'] ?? ''; ?>" required>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="profilePic">Profile Picture <sup>*</sup></label>

                <input class="form-input__input" id="profile-pic" type="file" name="image"
                    style="display: none; visibility: hidden" accept="image/*" required>

                <div class="form-upload-component">
                    <button class="upload-btn" type="button" id="profile-pic-btn">
                        <i class="fa-regular fa-plus"></i>
                    </button>
                    <div id="profile-pic-filename"></div>
                </div>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="password">Password <sup>*</sup></label>
                <input class="form-input__input" id="password" type="password" name="password"
                    value="<?php echo $_POST['password'] ?? ''; ?>" required>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="confirmPassword">Confirm Password <sup>*</sup></label>
                <input class="form-input__input" id="confirmPassword" type="password" name="confirmPassword"
                    value="<?php echo $_POST['confirmPassword'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["confirmPassword"])) {
                    echo "<p class = 'errors'> {$errors["confirmPassword"]}</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="provider-signup-form__bottom">
        <div class="policy">
            <input type="checkbox" name="ua" required>
            <p>I have read and agree the </p> <span><a href="#"> Terms and Conditions and Privacy Policy</a></span>
        </div>
        <?php
        if (isset($errors) && isset($errors["ua"])) {
            echo "<p class = 'errors policy-error'> {$errors["ua"]}</p>";
        }
        ?>

        <div class="form-input">
            <button id="reg-btn" class="btn">Register</button>
        </div>
    </div>
</form>


<script src="/assets/js/pages/signup-product-seller.js"></script>