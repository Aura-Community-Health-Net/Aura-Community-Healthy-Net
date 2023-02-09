<?php
/**
 *@var array $pharmacy
 *@var string $active_link
 */

if (!$pharmacy['is_verified']) {
    echo "<div class='empty-registrations'> <p>You're not verified yet. Please check later.</p></div>";
}

?>

<div class="dashboard__top-container">
    <div class="dashboard__top-cards">
        <h3>New Orders</h3>
        <div class="dashboard__top-cards__detail">
            <img class="order-consumer-img" src="/assets/images/profilepic1.jpg" alt="">
            <div>
                <h4>Kamal Deshapriya</h4>
                <h5>Azithromycin</h5>
            </div>
        </div>

        <div class="dashboard__top-cards__detail">
            <img class="order-consumer-img" src="/assets/images/profilepic2.jpg" alt="">
            <div>
                <h4>Semini Peduruarachchi</h4>
                <h5>Meloxicam</h5>
            </div>
        </div>

        <div class="dashboard__top-cards__detail">
            <img class="order-consumer-img" src="/assets/images/profilepic3.jpg" alt="">
            <div>
                <h4>Anoj Karunarathna</h4>
                <h5>Zubsolv</h5>
            </div>
        </div>

        <div class="dashboard__top-cards__detail">
            <img class="order-consumer-img" src="/assets/images/profilepic4.jpg" alt="">
            <div>
                <h4>Kamal Disasekara</h4>
                <h5>Cephalexin</h5>
            </div>
        </div>
    </div>

    <div class="dashboard__top-cards">
        <h3>Orders</h3>
        <div class="dashboard__top-cards__info">
            <div class="dashboard__top-cards__detail">
                <img class="order-consumer-img" src="/assets/images/profilepic1.jpg" alt="">
                <div>
                    <h4>Kamal Deshapriya</h4>
                    <h5>0726778767</h5>
                </div>
            </div>

            <div class="product-order-details">
                <h5>Amoxilin Tablets</h5><br>
                <h5>375 mg</h5>
            </div>
            <img class="order-product-img" src="/assets/images/drugs(1).jpg" alt="">
        </div>



    </div>

    <div class="dashboard__top-cards">
        <h3>Order Count</h3>
        <div class="order-count__details">
            <h3>New Orders</h3>
            <p class="new-order-count">15</p>
        </div>
        <div class="order-count__details">
            <h3>All Orders</h3>
            <p class="all-order-count">59</p>
        </div>
    </div>
</div>

<div class="dashboard__bottom-container">
    <div class="dashboard__bottom-cards">
        <h3>New Orders</h3>
        <div class="dashboard__bottom-cards__detail">
            <img class="dashboard__bottom-product-img" src="/assets/images/baclof-10mg-tablet-10.jpg" alt="">
            <h4></h4>
            <h4>Omeprazole Tablets</h4>
            <h4>20mg</h4>
            <h4>Rs. 650</h4>
        </div>

        <div class="dashboard__bottom-cards__detail">
            <img class="dashboard__bottom-product-img" src="/assets/images/alerid-10-mg-10-comprimate-terapia-1956.png" alt="">
            <h4></h4>
            <h4>Alerid</h4>
            <h4>100mg</h4>
            <h4>Rs. 350</h4>
        </div>

        <div class="dashboard__bottom-cards__detail">
            <img class="dashboard__bottom-product-img" src="/assets/images/GASTREZZ-BOTTLE-1-1.png" alt="">
            <h4></h4>
            <h4>Paracetamol</h4>
            <h4>10 mg</h4>
            <h4>Rs.50</h4>
        </div>

        <div class="dashboard__bottom-cards__detail">
            <img class="dashboard__bottom-product-img" src="/assets/images/losartan.png" alt="">
            <h4></h4>
            <h4>Benaclof</h4>
            <h4>50 mg</h4>
            <h4>Rs.400</h4>
        </div>
    </div>
    <div class="dashboard__bottom-cards">
        <h3>Analytics</h3>
        <img class="dashboard-analytics-img" src="/assets/images/dashboard-analytics.jpg" alt="">
        <div class="dashboard-analytics-description">
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                Ipsum has been the </p>
        </div>
    </div>
</div>
