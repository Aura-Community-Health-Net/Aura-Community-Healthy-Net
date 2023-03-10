<form id="doctor-signup" class="provider-signup-form" action="/provider-register?provider_type=doctor" method="post"
    enctype="multipart/form-data">
    <div class="title">
        <h2 class="title-text">Register as Doctor</h2>
    </div>

    <div class="provider-signup-form__top">
        <div class="provider-signup-form__left">
            <div id="form-input">
                <label class="form-input__label" for="doc-name">Name <sup>*</sup></label>
                <input class="form-input__input" id="doc-name" type="text" name="doc-name"
                    value="<?php echo $_POST['doc-name'] ?? ''; ?>" required>
            </div>

            <div id="form-input">
                <label class="form-input__label" for="nic">NIC <sup>*</sup></label>
                <input class="form-input__input" id="nic" type="text" name="nic"
                    value="<?php echo $_POST['nic'] ?? ''; ?>" required>
            </div>

            <div id="form-input">
                <label class="form-input__label" for="email">Email Address <sup>*</sup></label>
                <input class="form-input__input" id="email" type="email" name="email"
                    value="<?php echo $_POST['email'] ?? ''; ?>" required>
            </div>

            <div id="form-input">
                <label class="form-input__label" for="mobile-number">Mobile Number <sup>*</sup></label>
                <input class="form-input__input" id="mobile-number" type="tel" name="mobile-number"
                    value="<?php echo $_POST['mobile-number'] ?? ''; ?>" required>
            </div>

            <div id="form-input">
                <label class="form-input__label" for="address">Address <sup>*</sup></label>
                <input class="form-input__input" id="address" type="text" name="address"
                    value="<?php echo $_POST['address'] ?? ''; ?>" required>
            </div>

            <div id="form-input">
                <label class="form-input__label" for="reg-num">SLMC Registration Number <sup>*</sup></label>
                <input class="form-input__input" id="reg-num" type="text" name="reg-num"
                    value="<?php echo $_POST['reg-num'] ?? ''; ?>" required>
            </div>

            <div id="form-input">
                <label class="form-input__label" for="field-study">Field Of Study <sup>*</sup></label>
                <input class="form-input__input" id="field-study" type="text" name="field-study"
                    value="<?php echo $_POST['field-study'] ?? ''; ?>" required>
            </div>

            <div id="form-input">
                <label class="form-input__label" for="mbbs-certificate">Certificate of MBBS <sup>*</sup></label>
                <input class="form-input__input" id="mbbs-certificate" type="file" name="certificate"
                    value="<?php echo $_POST['certificate'] ?? ''; ?>" style="display: none; visibility: hidden;"
                    required>

                <div class="form-upload-component">
                    <button class="upload-btn" id="mbbs-certificate-btn" type="button">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <div id="mbbs-certificate-filename"></div>
                </div>
            </div>
        </div>



        <div class="provider-signup-form__right">
            <div id="form-input">
                <label class="form-input__label" for="qualifications">Qualifications <sup>*</sup></label>
                <textarea class="form-input__textarea" id="qualifications" name="qualifications"
                    placeholder="Please put qualifications with separating commas" rows="5"
                    value="<?php echo $_POST['qualifications'] ?? ''; ?>" required></textarea>
            </div>

            <div id="form-input">
                <label class="form-input__label" for="account-num">Bank Account Number <sup>*</sup></label>
                <input class="form-input__input" id="account-num" type="text" name="account-num"
                    value="<?php echo $_POST['account-num'] ?? ''; ?>" required>
            </div>

            <div id="form-input">
                <label class="form-input__label" for="bank-name">Bank Name <sup>*</sup></label>
                <input class="form-input__input" id="bank-name" type="text" name="bank-name"
                    value="<?php echo $_POST['bank-name'] ?? ''; ?>" required>
            </div>

            <div id="form-input">
                <label class="form-input__label" for="branch-name">Bank Branch Name <sup>*</sup></label>
                <input class="form-input__input" id="branch-name" type="text" name="branch-name"
                    value="<?php echo $_POST['branch-name'] ?? ''; ?>" required>
            </div>

            <div id="form-input">
                <label class="form-input__label" for="profile-pic">Profile Picture <sup>*</sup></label>
                <input class="form-input__input" id="profile-pic" type="file" placeholder="Add a JPG File"
                    name="profile-pic" value="<?php echo $_POST['profile-pic'] ?? ''; ?>"
                    style="display: none; visibility: hidden;" required>

                <div class="form-upload-component">
                    <button class="upload-btn" id="profile-pic-btn" type="button">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    <div id="profile-pic-filename"></div>
                </div>
            </div>

            <div id="form-input">
                <label class="form-input__label" for="password">Password <sup>*</sup></label>
                <input class="form-input__input" id="password" type="password" name="password"
                    value="<?php echo $_POST['password'] ?? ''; ?>" required>
            </div>

            <div id="form-input">
                <label class="form-input__label" for="con-password">Confirm Password <sup>*</sup></label>
                <input class="form-input__input" id="con-password" type="password" name="con-password"
                    value="<?php echo $_POST['con-password'] ?? ''; ?>" required>
            </div>
        </div>
    </div>


    <div class="provider-signup-form__bottom">

        <div class="provider-signup-form__bottom__top">
            <div class="western">
                <label>Western</label>
                <input type="radio" name="western" id="western">
            </div>

            <div class="indigenous">
                <label>Indigenous</label>
                <input type="radio" name="indigenous" id="indigenous">
            </div>
            <div class="counselor">
                <label>Counselor</label>
                <input type="radio" name="counselor" id="counselor">
            </div>
        </div>


        <div class="provider-signup-form__bottom__bottom">
            <div class="policy">
                <input type="checkbox" name="ua" required>
                <p>I have read and agree the </p> <span><a href="#"> Terms and Conditions and Privacy
                        Policy</a></span>
            </div>
            <?php
            if (isset($errors) && isset($errors["ua"])) {
                echo "<p class = 'errors policy-error'> {$errors["ua"]}</p>";
            }
            ?>
        </div>


        <div id="form-input">
            <button id="reg-btn" class="btn">Register</button>
        </div>
    </div>
</form>


<div id="modal">
    <h3>Your account will be verified shortly, you are only visible to people after you are verified.</h3>
    <img class="modal-img" src="/assets/images/verification.jpg" alt="">
    <button class="reg-ok-btn" id="ok-btn">Ok</button>
</div>


<script src="/assets/js/pages/signup-doctor.js"></script>
</body>

</html>