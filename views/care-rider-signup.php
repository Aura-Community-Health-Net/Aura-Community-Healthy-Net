<form id="reg-form" class="provider-signup-form" action="/provider-register?provider_type=care-rider" method="post" enctype="multipart/form-data">
    <div class="title">
        <h2 class="title-text">Register as Care Rider</h2>
    </div>

    <div class="provider-signup-form__top">
        <div class="provider-signup-form__left">

            <div class="form-input">
                <label class="form-input__label" for="name"> Name <sup>*</sup></label>
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
                <label class="form-input__label" for="mobile_number">Mobile Number <sup>*</sup></label>
                <input class="form-input__input" id="mobile_number" type="text" name="mobile_number"
                    value="<?php echo $_POST['mobile_number'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["mobile_number"])) {
                    echo "<p class = 'errors'> {$errors["mobile_number"]}</p>";
                }
                ?>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="address">Address <sup>*</sup></label>
                <input class="form-input__input" id="address" type="text" name="address"
                    value="<?php echo $_POST['address'] ?? ''; ?>" required>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="type_of_vehicle">Type of Vehicle <sup>*</sup></label>
                <input class="form-input__input" id="type_of_vehicle" type="text" name="type_of_vehicle"
                    value="<?php echo $_POST['type_of_vehicle'] ?? ''; ?>" required>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="number_plate">Number Plate <sup>*</sup></label>
                <input class="form-input__input" id="number_plate" type="text" name="number_plate"
                    value="<?php echo $_POST['number_plate'] ?? ''; ?>" required>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="colour"> Colour <sup>*</sup></label>
                <input class="form-input__input" id="colour" type="text" name="colour"
                    value="<?php echo $_POST['colour'] ?? ''; ?>" required>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="driving_license_number">Driving License Number <sup>*</sup></label>
                <input class="form-input__input" id="driving_license_number" type="text" name="driving_license_number"
                       value="<?php echo $_POST['driving_license_number'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["driving_license_number"])) {
                    echo "<p class = 'errors'> {$errors["driving_license_number"]}</p>";
                }
                ?>
            </div>
        </div>

        <div class="provider-signup-form__right">
            <div class="form-input">
                <label class="form-input__label" for="bank_no">Bank Account Number <sup>*</sup></label>
                <input class="form-input__input" id="bank_no" type="text" name="bank_no"
                    value="<?php echo $_POST['bank_no'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["bank_no"])) {
                    echo "<p class = 'errors'> {$errors["bank_no"]}</p>";
                }
                ?>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="bank_name">Bank Name <sup>*</sup></label>
                <input class="form-input__input" id="bank_name" type="text" name="bank_name"
                    value="<?php echo $_POST['bank_name'] ?? ''; ?>" required>
            </div>

            <div class="form-input">
                <label class="form-input__label" for="branch_name">Branch Name <sup>*</sup></label>
                <input class="form-input__input" id="branch_name" type="text" name="branch_name"
                    value="<?php echo $_POST['branch_name'] ?? ''; ?>" required>
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
                <label class="form-input__label" for="profile_pic">Profile Picture <sup>*</sup></label>
                <input class="form-input__input" id="profile-pic" type="file" name="profile_pic"
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
                <label class="form-input__label" for="confirm_password">Confirm Password <sup>*</sup></label>
                <input class="form-input__input" id="confirm_password" type="password" name="confirm_password"
                    value="<?php echo $_POST['confirm_password'] ?? ''; ?>" required>
                <?php
                if (isset($errors) && isset($errors["confirm_password"])) {
                    echo "<p class = 'errors'> {$errors["confirm_password"]}</p>";
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


<script src="/assets/js/pages/signup-carerider.js"></script>

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