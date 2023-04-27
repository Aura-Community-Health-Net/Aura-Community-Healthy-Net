<?php
/**
 * @var array $new_registrations ;
 */
$provider_type = $_GET["provider_type"] ?? "doctor";
?>


<form action="/admin-dashboard/new-registrations">
    <?php
    $doctor_selected = $provider_type == "doctor";
    $pharmacy_selected = $provider_type == "pharmacy";
    $product_seller_selected = $provider_type == "product-seller";
    $care_rider_selected = $provider_type == "care_rider";
    ?>

    <select name="provider_type" id="provider_type">
        <?php
        if ($doctor_selected) {
            echo "<option value='doctor' selected>Doctor</option>";
        } else {
            echo "<option value='doctor'>Doctor</option>";
        }

        if ($pharmacy_selected) {
            echo "<option value='pharmacy' selected>Pharmacy</option>";
        } else {
            echo "<option value='pharmacy'>Pharmacy</option>";
        }

        if ($product_seller_selected) {
            echo "<option value='product-seller' selected>Product-Seller</option>";
        } else {
            echo "<option value='product-seller'>Product-Seller</option>";
        }

        if ($care_rider_selected) {
            echo "<option value='care-rider' selected>Care-Rider</option>";
        } else {
            echo "<option value='care-rider'>Care Rider</option>";
        }
        ?>
    </select>

    <input type="submit">
</form>
<?php
if (empty($new_registrations)) {
    echo "<div class='empty-registrations'> <p>No new registrations for this user type. Check later.</p></div>";
}
?>
<div class="reg-details" style="display: <?php echo empty($new_registrations) ? 'none' : 'grid' ?>">
    <?php

    foreach ($new_registrations as $registration) {
        echo "<div class='registration-card'>";

        if ($provider_type == "doctor") {
//            echo '<pre>';
//            var_dump($registration);
//            echo '</pre>';

            $personal = $registration["personal"];
            $qualifications = $registration["qualifications"];
            $qualifications_el = "<ul>";
            foreach ($qualifications as $qualification){
                $qualifications_el = $qualifications_el."<li>$qualification</li>";
            }
            $qualifications_el = $qualifications_el."</ul>";

            echo "<ul>";
            echo "<li class='detail-name'> <img src='{$personal['profile_picture']}'> <div>{$personal['name']} <span>Doctor</span> </div>  </li>";
            echo "<br>";
            echo "<li class='data-title'> <div>NIC </div> <div>{$personal['provider_nic']}</div></li>";
            echo "<li class='data-title'> <div>Email Address</div> <div>{$personal['email_address']}</div></li>";
            echo "<li class='data-title'> <div>Mobile Number</div> <div>{$personal['mobile_number']}</div></li>";
            echo "<li class='data-title'> <div>Address</div> <div>{$personal['address']}</div></li>";
            echo "<li class='data-title'> <div>SLMC Reg No</div> <div>{$personal['slmc_reg_no']}</div></li>";
            echo "<li class='data-title'> <div>Field of study</div> <div>{$personal['field_of_study']}</div></li>";
            // echo "<li class='data-title'> <div>Certificate of MBBS</div> <div>{$personal['certificate_of_mbbs']}</div></li>";
            echo "<li class='data-title'> <div>Qualifications</div> <div>{$qualifications_el}</div></li>";
            echo "<li class='data-title'> <div>Bank Account Number</div> <div>{$personal['bank_account_number']}</div></li>";
            echo "<li class='data-title'> <div>Bank Name</div> <div>{$personal['bank_name']}</div></li>";
            echo "<li class='data-title'> <div>Bank Branch Number</div> <div>{$personal['bank_branch_name']}</div></li>";
            echo "</ul>";

            echo "<form class='verify' action='/service-providers/verify?nic={$personal["provider_nic"]}&provider_type=$provider_type' method='post'>
                    <div class='verification-button-section'>
                        <button class='verify-btn'>Verify</button>
                        <button class='verify-btn'>Deny</button>
                    </div>
                  </form>";
            echo "</div>";
            continue;

        } elseif ($provider_type == "pharmacy") {
            echo "<ul>";
            echo "<li class='detail-name'> <img src='{$registration['profile_picture']}'> <div>{$registration['name']} <span>Pharmacy</span> </div>  </li>";

            echo "<br>";
            echo "<li class='data-title'> <div>Pharmacy Name</div> <div>{$registration['pharmacy_name']}</div></li>";
            echo "<li class='data-title'> <div>NIC</div> <div>{$registration['provider_nic']}</div></li>";
            echo "<li class='data-title'> <div>Email Address</div> <div>{$registration['email_address']}</div></li>";
            echo "<li class='data-title'> <div>Mobile Number</div> <div>{$registration['mobile_number']}</div></li>";
            echo "<li class='data-title'> <div>Pharmacy Registration Number</div> <div>{$registration['pharmacist_reg_no']}</div></li>";
            echo "<li class='data-title'> <div>Address</div> <div>{$registration['address']}</div></li>";
            // echo "<li class='data-title'> <div>NMRA Certificate</div><div>{$registration['nmra_certificate']}</div></li>";
            echo "<li class='data-title'> <div>Bank Account Number</div> <div>{$registration['bank_account_number']}</div></li>";
            echo "<li class='data-title'> <div>Bank Name</div> <div>{$registration['bank_name']}</div></li>";
            echo "<li class='data-title'> <div>Bank Branch Number</div> <div>{$registration['bank_branch_name']}</div></li>";
            echo "</ul>";

        } elseif ($provider_type == "product-seller") {
            echo "<ul>";
            echo "<li class='detail-name'> <img src='{$registration['profile_picture']}'> <div>{$registration['name']} <span>Product Seller</span> </div>  </li>";

            echo "<br>";
            echo "<li class='data-title'> <div> Business Name </div> <div>{$registration['business_name']}</div></li>";
            echo "<li class='data-title'> <div>NIC</div> <div>{$registration['provider_nic']}</div> </li>";
            echo "<li class='data-title'> <div>Email Address</div> <div>{$registration['email_address']} </div></li>";
            echo "<li class='data-title'> <div>Mobile Number </div> <div>{$registration['mobile_number']}</div></li>";
            echo "<li class='data-title'> <div>Address </div> <div>{$registration['address']}</div></li>";
            echo "<li class='data-title'> <div>Bank Account Number </div> <div>{$registration['bank_account_number']}</div></li>";
            echo "<li class='data-title'> <div>Bank Name</div> <div>{$registration['bank_name']}</div></li>";
            echo "<li class='data-title'> <div>Bank Branch Number</div> <div>{$registration['bank_branch_name']}</div></li>";
            echo "</ul>";

        } elseif ($provider_type == "care-rider") {
            echo "<ul>";
            echo "<li class='detail-name'> <img src='{$registration['profile_picture']}'> <div>{$registration['name']} <span>Care Rider</span> </div>  </li>";
            echo "<br>";
            echo "<li class='data-title'> <div>NIC </div> <div>{$registration['provider_nic']}</div></li>";
            echo "<li class='data-title'> <div>Email Address</div> <div>{$registration['email_address']}</div></li>";
            echo "<li class='data-title'> <div>Mobile Number </div> <div>{$registration['mobile_number']}</div></li>";
            echo "<li class='data-title'> <div>Address</div> <div>{$registration['address']}</div></li>";
            echo "<li class='data-title'> <div>Type of Vehicle </div> <div>{$registration['type']} </div></li>";
            echo "<li class='data-title'> <div>Number Plate</div> <div>{$registration['number_plate']}</div></li>";
            echo "<li class='data-title'> <div>Color</div> <div>{$registration['color']}</div></li>";
            echo "<li class='data-title'> <div> Driving Licence Number </div> <div>{$registration['driving_licence_number']}</div></li>";
            echo "<li class='data-title'> <div> Bank Account Number </div> <div>{$registration['bank_account_number']}</div></li>";
            echo "<li class='data-title'> <div> Bank Name </div> <div>{$registration['bank_name']}</div></li>";
            echo "<li class='data-title'> <div>Bank Branch Number</div> <div>{$registration['bank_branch_name']}</div></li>";
            echo "</ul>";
        }

        echo "<form class='verify' action='/service-providers/verify?nic={$registration['provider_nic']}&provider_type=$provider_type' method='post'>
                    <div class='verification-button-section'>
                        <button class='verify-btn'>Verify</button>
                        <button class='verify-btn'>Deny</button>
                    </div>
                  </form>";
        echo "</div>";

    }
    ?>
</div>