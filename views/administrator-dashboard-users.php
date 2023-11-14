<?php
/**
 * @var array $providers
 * @var array $consumers
 * */
$provider_type = $_GET["provider_type"] ?? "doctor";
?>

<div class="admin-users-container">

        <div class="admin-user-header">
            <h3>Registered Service Providers
                <form action="/admin-dashboard/users">
                    <?php
                    $doctor_selected = $provider_type  == "doctor" ? "selected" : "";
                    $pharmacy_selected = $provider_type  == "pharmacy" ? "selected" : "";
                    $product_seller_selected = $provider_type  == "product-seller" ? "selected" : "";
                    $care_rider_selected = $provider_type  == "care-rider" ? "selected" : "";
                    ?>
                    <select name="provider_type" id="provider_type" class="admin-user-dropdown">
                        <?php
                            echo "<option value='doctor' $doctor_selected>Doctor</option>";
                            echo "<option value='pharmacy' $pharmacy_selected>Pharmacy</option>";
                            echo "<option value='product-seller' $product_seller_selected>Product-Seller</option>";
                            echo "<option value='care-rider' $care_rider_selected>Care Rider</option>";
                        ?>
                    </select>

                    <button type="submit" class="form-user-submit">Submit</button>
                </form>
        </div>

    <div class="admin-users__top-container">
        <?php
        
        foreach ($providers as $provider) {
            $profile_picture = $provider["profile_picture"];
            $provider_type = $provider["provider_type"];
            $provider_name = $provider["name"];
            $nic = $provider["provider_nic"];
            $email_address = $provider["email_address"];
            $mobile_number = $provider["mobile_number"];
            $address = $provider["address"];
            $bank_acc_no = $provider["bank_account_number"];
            $bank_name = $provider["bank_name"];
            $bank_branch_name = $provider["bank_branch_name"];
            echo "
              <div class='admin-users__sub-container'>  
              <div class='admin-users__profile'>
                <img class='users-image' src='$profile_picture' alt=''>
                <div>
                    <p><b>$provider_name</b></p>
                    <p>$provider_type</p>
                </div>
              </div>
                <p>$nic</p>
                <p>$email_address</p>
                <p>$mobile_number</p>
                <p>$address</p>
                <p>$bank_acc_no</p>
                <p>$bank_name, $bank_branch_name</p>
            </div>
           
            ";
        }
        ?>
    </div>
</div>

<div class="admin-users-container">
    <h3>Customers</h3>
    <div class="admin-users__top-container">
        <?php
        foreach ($consumers as $consumer) {
            $profile_picture = $consumer["profile_picture"];
            $consumer_name = $consumer["name"];
            $nic = $consumer["consumer_nic"];
            $email_address = $consumer["email_address"];
            $mobile_number = $consumer["mobile_number"];
            $address = $consumer["address"];
            echo "

              <tr data-usernic='$nic' data-useremail='$email_address' data-mobilenumber='$mobile_number' data-address='$address'></tr>
              <div class='admin-users__sub-container'>  
              <div class='admin-users__profile'>
                <img class='users-image' src='{$profile_picture}' alt=''>
                <div>
                    <p><b>{$consumer_name}</b></p>
                </div>
              </div>
                <p>{$nic}</p>
                <p>{$email_address}</p>
                <p>{$mobile_number}</p>
                <p>{$address}</p>
                
            </div>
           
            ";
        }
        ?>
    </div>
</div>

<div class="overlay" id="update-user-overlay">
    <div class="modal" id="update-user-modal">

    </div>
</div>

<div class="overlay" id="update-provider-overlay">
    <div class="modal" id="update-provider-modal">

    </div>
</div>

<script src="/assets/js/pages/administrator-users.js"></script>
