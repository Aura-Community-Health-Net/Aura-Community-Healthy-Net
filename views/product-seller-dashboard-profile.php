<?php
/**
 * @var array $profile_details;
 */

$provider_image = $profile_details['profile_picture'];
$provider_name = $profile_details['name'];
$business_name = $profile_details['business_name'];
$provider_email = $profile_details['email_address'];
$provider_nic = $profile_details['provider_nic'];
$provider_mobile_number = $profile_details['mobile_number'];
$provider_address = $profile_details["address"];

?>

<div class="product-seller-profile-pic__container">
    <?php
    echo "
    <div class='product-seller-profile-pic__header'>
        <img src='$provider_image' alt=''>
        <div>
            <h1>$provider_name</h1>
            <h2>$business_name</h2>
        </div>
    </div>

    <div class='product-seller-profile-pic__details'>
        <h3> <span>Email Address</span>  $provider_email</h3>
        <h3><span>NIC</span>   $provider_nic</h3>
        <h3><span>Mobile Number</span>  $provider_mobile_number</h3>
        <h3><span>Address</span>  $provider_address</h3>
    </div>
    "
    ?>

</div>

