<?php
/**
 * @var array $consumer;
 */

$consumer_image = $consumer['profile_picture'];
$consumer_name = $consumer['name'];
$consumer_email = $consumer['email_address'];
$consumer_nic = $consumer['consumer_nic'];
$consumer_mobile_number = $consumer['mobile_number'];
$consumer_address = $consumer["address"];

?>

<div class="product-seller-profile-pic__container">
    <?php
    echo "
    <div class='product-seller-profile-pic__header'>
        <img src='$consumer_image' alt=''>
        <h1>$consumer_name</h1>
    </div>

    <div class='product-seller-profile-pic__details'>
        <h3> <span>Email Address</span> $consumer_email</h3>
        <h3><span>NIC</span> $consumer_nic</h3>
        <h3><span>Mobile Number</span> $consumer_mobile_number</h3>
        <h3><span>Address</span> $consumer_address</h3>
    </div>
    "
    ?>

</div>

