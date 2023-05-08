<?php
/**
 * @var array $pharmacies
 * @var array $product_sellers
 * @var array $doctors
 * @var array $care_riders
 * @var array $consumers
 * @var array $due_payments
 * */
?>

<div class="dashboard__top-container">
    <div class="dashboard__top-cards">
        <h3>Overview Service Providers</h3>
        <img class="admin-analytics" src="/assets/images/admin-analytics.png" alt="">
    </div>

    <div class="dashboard__top-cards">
        <img src="/assets/images/calander.jfif" alt="">
    </div>
</div>

<div class="dashboard__bottom-container">
    <div class="dashboard__bottom-cards">
        <h3>Payment Details</h3>

        <?php
        foreach ($due_payments as $due_payment){
            $profile_picture = $due_payment["profile_picture"];
            $provider_name = $due_payment["name"];
            $amount = $due_payment["amount"];
            $bank_acc_number = $due_payment["bank_account_number"];

            echo "
             <div class='admin-dashboard__due-payments'>
                <img src='$profile_picture' class = 'due-payment__provider-img admin__due-payments' alt=''>
                <p>$provider_name</p>
                <p>$amount</p>
                <p>$bank_acc_number</p>
            </div>
            ";
        }
        ?>


    </div>
    
    <div class="dashboard__bottom-cards">
        <h3>New Registrations</h3>

         <div class='services-count__details'>
             <?php foreach ($doctors as $doctor) {
                 $doctors_count = $doctor["provider_count"];
                 echo "
            <h3>Doctor</h3>
            <p class='services-count'>$doctors_count</p>
           "; }?>
        </div>
        <div class='services-count__details'>
            <?php foreach ($pharmacies as $pharmacy){
                $pharmacy_count = $pharmacy["provider_count"];
            echo "
            <h3>Pharmacy</h3>
            <p class='services-count'>$pharmacy_count</p>
    ";}?>
        </div>
        <div class='services-count__details'>
            <?php foreach ($product_sellers as $product_seller){
                $seller_count = $product_seller["provider_count"];
                echo"
            
            <h3>Product Seller</h3>
            <p class='services-count'>$seller_count</p>
           "; }?>
        </div>
        <div class='services-count__details'>
            <?php foreach ($care_riders as $care_rider){
                $riders_count = $care_rider["provider_count"];
                echo"
            
            <h3>Care Rider</h3>
            <p class='services-count'>$riders_count</p>
            ";}?>
        </div>

    </div>
</div>





