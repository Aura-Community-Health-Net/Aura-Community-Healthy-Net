<form id="reg-form" class="provider-signup-form" action="/provider-register?provider_type=product-seller" method="post"
    enctype="multipart/form-data">
    <div class="title">
        <h2 class="title-text">Register as Healthy Food Product Seller</h2>
    </div>

    <div class="provider-signup-form__top">
        <div class="provider-signup-form__left">
            <div class="form-input">
                <label class="form-input__label" for="businessName">Business Name <sup>*</sup></label>
                <input class="form-input__input" id="businessName" type="text" name="businessName"
                    value="<?php echo $_POST['businessName'] ?? ''; ?>" required>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="ownerName">Owner Name <sup>*</sup></label>
                <input class="form-input__input" id="ownerName" type="text" name="ownerName"
                    value="<?php echo $_POST['ownerName'] ?? ''; ?>" required>
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

            <div class="form-input">
                <label class="form-input__label" for="address">Address <sup>*</sup></label>
                <input class="form-input__input" id="address" type="text" name="address"
                    value="<?php echo $_POST['address'] ?? ''; ?>" required>
            </div>



            <div class="form-input">
                <label class="form-input__label" for="regNumber">Business Registration Number <sup>*</sup></label>
                <input class="form-input__input" id="regNumber" type="text" name="regNumber"
                    value="<?php echo $_POST['regNumber'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["regNumber"])) {
                    echo "<p class = 'errors'> {$errors["regNumber"]}</p>";
                }
                ?>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="bankNo">Bank Account Number <sup>*</sup></label>
                <input class="form-input__input" id="bankNo" type="number" name="bankNo"
                       value="<?php echo $_POST['bankNo'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["bankNo"])) {
                    echo "<p class = 'errors'> {$errors["bankNo"]}</p>";
                }
                ?>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="bankName">Bank Name <sup>*</sup></label>
                <input class="form-input__input" id="bankName" type="text" name="bankName"
                       value="<?php echo $_POST['bankName'] ?? ''; ?>" required>
            </div>

        </div>
        <div class="provider-signup-form__right">

            <div class="form-input">
                <label class="form-input__label" for="branchName">Branch Name <sup>*</sup></label>
                <input class="form-input__input" id="branchName" type="text" name="branchName"
                    value="<?php echo $_POST['branchName'] ?? ''; ?>" required>
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
                <label class="form-input__label" for="profilePic">Profile Picture <sup>*</sup></label>

                <input class="form-input__input" id="profile-pic" type="file" name="image"
                    style="display: none; visibility: hidden" accept="image/*" required>

                <div class="form-upload-component">
                    <button class="upload-btn" type="button" id="profile-pic-btn">
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


<script src="/assets/js/pages/signup-product-seller.js"></script>
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