<?php
/**
 * @var array $pharmacies
 * @var array $product_sellers
 * @var array $doctors
 * @var array $care_riders
 * @var array $consumers
 * @var array $due_payments
 * @var array $reg_doctors
 * @var array $reg_pharmacies
 * @var array $reg_sellers
 * @var array $reg_riders
 * @var array $all_consumers
 * */

?>

<div class="dashboard__top-container">
    <div class="dashboard__top-cards admin-top-cards">
        <h3>Registered Doctors</h3>
        <?php
        foreach ($reg_doctors as $reg_doctor){
            $profile_picture = $reg_doctor["profile_picture"];
            $doctor_name = $reg_doctor["name"];

            echo "
                <div class='reg-service-providers'>
                    <img src='$profile_picture' alt=''>
                    <p>$doctor_name</p>
                </div>
            ";

        }
        ?>

    </div>

    <div class="dashboard__top-cards admin-top-cards">
        <h3>Registered Pharmacies</h3>
        <?php
        foreach ($reg_pharmacies as $reg_pharmacies){
            $profile_picture = $reg_pharmacies["profile_picture"];
            $pharmacies_name = $reg_pharmacies["name"];

            echo "
                <div class='reg-service-providers'>
                    <img src='$profile_picture' alt=''>
                    <p>$pharmacies_name</p>
                </div>
            ";
        }
        ?>
    </div>

    <div class="dashboard__top-cards admin-top-cards">
        <h3>Registered Product Sellers</h3>
        <?php
        foreach ($reg_sellers as $reg_seller){
            $profile_picture = $reg_seller["profile_picture"];
            $seller_name = $reg_seller["name"];

            echo "
                <div class='reg-service-providers'>
                    <img src='$profile_picture' alt=''>
                    <p>$seller_name</p>
                </div>
            ";

        }
        ?>
    </div>

    <div class="dashboard__top-cards admin-top-cards">
        <h3>Registered Care Riders</h3>
        <?php
        foreach ($reg_riders as $reg_rider){
            $profile_picture = $reg_rider["profile_picture"];
            $rider_name = $reg_rider["name"];

            echo "
                <div class='reg-service-providers'>
                    <img src='$profile_picture' alt=''>
                    <p>$rider_name</p>
                </div>
            ";

        }
        ?>
    </div>
</div>

<div class="dashboard__bottom-container">

    <div class="dashboard__bottom-cards">
        <h3>Customers</h3>
        <?php
        foreach ($all_consumers as $consumer){
            $profile_picture = $consumer["profile_picture"];
            $consumer_name = $consumer["name"];
            
            echo "
            <div class='reg-service-providers'>
                <img src='$profile_picture' alt=''>
                <p>$consumer_name</p>
            </div>
            ";
        }
        ?>


    </div>


    <div class="dashboard__bottom-cards">
        <h3>Due Payment Details</h3>

        <?php
        foreach ($due_payments as $due_payment){
            $profile_picture = $due_payment["profile_picture"];
            $provider_nic = $due_payment["provider_nic"];
            $provider_name = $due_payment["name"];
            $amount = number_format($due_payment["amount"], 2, '.', ',');
            $provider_type = $due_payment["provider_type"];

            echo "
             <div class='admin-dashboard__due-payments'>
                <img src='$profile_picture' class = 'due-payment__provider-img admin__due-payments__details' alt=''>
                <p class='admin__due-payments__details admin-payment-name'>$provider_name</p>
                <p class='admin__due-payments__details admin-payment-price'>$provider_nic</p>                
                <p class='admin__due-payments__details admin-payment-price'>Rs. $amount</p>
                <p class='admin__due-payments__details admin-payment-purpose'>$provider_type</p>
            </div>
            ";
        }
        ?>

        <a href='/admin-dashboard/due-payments'>
            <button class="all-products-btn">All Due Payments</button>
        </a>

    </div>

    <div class="dashboard__bottom-cards">
        <h3>Registrations</h3>

         <div class='admin-services-count__details'>
             <?php foreach ($doctors as $doctor) {
                 $doctors_count = $doctor["provider_count"];
                 echo "
            <h3>Doctor</h3>
            <p class='services-count'>$doctors_count</p>
           "; }?>
        </div>
        <div class='admin-services-count__details'>
            <?php foreach ($pharmacies as $pharmacy){
                $pharmacy_count = $pharmacy["provider_count"];
            echo "
            <h3>Pharmacy</h3>
            <p class='services-count'>$pharmacy_count</p>
    ";}?>
        </div>

        <div class='admin-services-count__details'>
            <?php foreach ($product_sellers as $product_seller){
                $seller_count = $product_seller["provider_count"];
                echo"
            
            <h3>Product Seller</h3>
            <p class='services-count'>$seller_count</p>
           "; }?>
        </div>
        <div class='admin-services-count__details'>
            <?php foreach ($care_riders as $care_rider){
                $riders_count = $care_rider["provider_count"];
                echo"
            
            <h3>Care Rider</h3>
            <p class='services-count'>$riders_count</p>
            ";}?>
        </div>

    </div>
</div>





