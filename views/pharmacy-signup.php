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

            <div class="form-input">
                <label class="form-input__label" for="nmra">NMRA Certificate <sup>*</sup></label>

                <input class="form-input__input" id="nmra-certificate" type="file" name="nmra"
                       style="display: none; visibility: hidden" accept="application/pdf" required>

                <div class="form-upload-component">
                    <button class="upload-btn" id="nmra-certificate-btn" type="button">
                        <i class="fa fa-plus"></i>
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
        </div>

        <div class="provider-signup-form__right">



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
                <label class="form-input__label" for="location">Location <sup>*</sup></label>
                <div class="form-input__map" id="location">
                    <div id="map" style="height: 280px"></div>
                </div>
                <input type="text" name="location_lat" id="location_lat" style="display: none">
                <input type="text" name="location_lng" id="location_lng" style="display: none">
            </div>

            <div class="form-input">
                <label class="form-input__label" for="pic">Profile Picture <sup>*</sup></label>

                <input class="form-input__input" id="profile-pic" type="file" name="pic"
                    style="display: none; visibility: hidden" accept="image/*" required>

                <div class="form-upload-component">
                    <button class="upload-btn" id="profile-pic-btn" type="button">
                        <i class="fa fa-plus"></i>
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
            <p>I have read and agree the </p> <span><a href="/terms-conditions-and-user-agreements"> Terms and Conditions and Privacy Policy</a></span>
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

<script>(g => {
        var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__",
            m = document, b = window;
        b = b[c] || (b[c] = {});
        var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams,
            u = () => h || (h = new Promise(async (f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + "");
                for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                d[q] = f;
                a.onerror = () => h = n(Error(p + " could not load."));
                a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                m.head.append(a)
            }));
        d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
    })
    ({key: "AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg", v: "weekly"});</script>

<script src="/assets/js/pages/signup-location.js"></script>













