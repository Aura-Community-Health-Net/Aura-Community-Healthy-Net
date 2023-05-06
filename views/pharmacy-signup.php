<form id="reg-form" class="provider-signup-form" action="/provider-register?provider_type=pharmacy" method="post"
    enctype="multipart/form-data">
    <div class="title">
        <h2 class="title-text">Register as a Pharmacy</h2>
    </div>
    <div class="provider-signup-form__top">
        <div class="provider-signup-form__left">
            <div class="form-input">
                <label class="form-input__label" for="pharmacyname">Pharmacy Name <sup>*</sup></label>
                <input class="form-input__input" id="pharmacyname" type="text" name="pharmacyname"
                    value="<?php echo $_POST['pharmacyname'] ?? ''; ?>" required>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="ownername">Owner Name <sup>*</sup></label>
                <input class="form-input__input" id="ownername" type="text" name="ownername"
                    value="<?php echo $_POST['ownername'] ?? ''; ?>" required>
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
                <label class="form-input__label" for="emailaddress">Email Address <sup>*</sup></label>
                <input class="form-input__input" id="emailaddress" type="email" name="emailaddress"
                    value="<?php echo $_POST['emailaddress'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["emailaddress"])) {
                    echo "<p class = 'errors'> {$errors["emailaddress"]}</p>";
                }
                ?>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="mobile">Mobile Number <sup>*</sup></label>
                <input class="form-input__input" id="mobile" type="text" name="mobile"
                    value="<?php echo $_POST['mobile'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["mobile"])) {
                    echo "<p class = 'errors'> {$errors["mobile"]}</p>";
                }
                ?>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="address">Address <sup>*</sup></label>
                <input class="form-input__input" id="address" type="text" name="address"
                    value="<?php echo $_POST['address'] ?? ''; ?>" required>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="pharmacyregno">Pharmacist Registration Number <sup>*</sup></label>
                <input class="form-input__input" id="pharmacyregno" type="text" name="pharmacyregno"
                    value="<?php echo $_POST['regNumber'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["pharmacyregno"])) {
                    echo "<p class = 'errors'> {$errors["pharmacyregno"]}</p>";
                }
                ?>
            </div>
        </div>

        <div class="provider-signup-form__right">

            <div class="form-input">
                <label class="form-input__label" for="nmra">NMRA Certificate <sup>*</sup></label>

                <input class="form-input__input" id="nmra-certificate" type="file" name="nmra"
                    style="display: none; visibility: hidden" accept="application/pdf" required>



                <div class="form-upload-component">
                    <button class="upload-btn" id="nmra-certificate-btn" type="button">
                        <i class="fa-regular fa-plus"></i>
                    </button>
                    <div id="nmra-certificate-filename"></div>
                </div>
            </div>
            <div class="form-input">
                <label class="form-input__label" for="bankaccno">Bank Account Number <sup>*</sup></label>
                <input class="form-input__input" id="bankaccno" type="number" name="bankaccno"
                    value="<?php echo $_POST['bankaccno'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["bankaccno"])) {
                    echo "<p class = 'errors'> {$errors["bankaccno"]}</p>";
                }
                ?>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="bankname">Bank Name <sup>*</sup></label>
                <input class="form-input__input" id="bankname" type="text" name="bankname"
                    value="<?php echo $_POST['bankname'] ?? ''; ?>" required>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="bankbranch">Branch Name <sup>*</sup></label>
                <input class="form-input__input" id="bankbranch" type="text" name="bankbranch"
                    value="<?php echo $_POST['bankbranch'] ?? ''; ?>" required>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="pic">Profile Picture <sup>*</sup></label>

                <input class="form-input__input" id="profile-pic" type="file" name="pic"
                    style="display: none; visibility: hidden" accept="image/*" required>

                <div class="form-upload-component">
                    <button class="upload-btn" id="profile-pic-btn" type="button">
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
                <label class="form-input__label" for="confirmpassword">Confirm Password <sup>*</sup></label>
                <input class="form-input__input" id="confirmpassword" type="password" name="confirmpassword"
                    value="<?php echo $_POST['confirmpassword'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["confirmpassword"])) {
                    echo "<p class = 'errors'> {$errors["confirmpassword"]}</p>";
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


<script src="/assets/js/pages/signup-pharmacy.js"></script>













