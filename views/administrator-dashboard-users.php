<?php
/**
 * @var array $providers
 * @var array $consumers
 * */
//print_r($providers[0]['name']);die();
?>

<div class="admin-users-container">
    <h3>Registered Service Providers</h3>
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
                <button id='update-provider-$nic' data-nic='$nic' data-name='$provider_name' data-email='$email_address' data-mobile='$mobile_number' data-address='$address' data-account='$bank_acc_no' data-bank='$bank_name' data-branch='$bank_branch_name' class='action-btn action-btn--edit provider-update update-provider'><i class='fa-solid fa-pen update-user'></i></button> 
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
                <button id='update-user-$nic' data-usernic='$nic' data-username='$consumer_name' data-useremail='$email_address'  data-mobilenumber='$mobile_number', data-address='$address' class='action-btn action-btn--edit user-update update-user'><i class='fa-solid fa-pen'></i></button> 
                
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
