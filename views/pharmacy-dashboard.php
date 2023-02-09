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
            <img class="order-product-img" src="/assets/images/nil-veralu.jfif" alt="">
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
            <img class="dashboard__bottom-product-img" src="/assets/images/nil-veralu.jfif" alt="">
            <h4>fyefefyef</h4>
            <h4>Omeprazole Tablets</h4>
            <h4>20mg</h4>
            <h4>Rs. 150</h4>
        </div>

        <div class="dashboard__bottom-cards__detail">
            <img class="dashboard__bottom-product-img" src="/assets/images/vali%20anoda.jfif" alt="">
            <h4>bfvwevfuef</h4>
            <h4>Alerid</h4>
            <h4>100mg</h4>
            <h4>Rs. 350</h4>
        </div>

        <div class="dashboard__bottom-cards__detail">
            <img class="dashboard__bottom-product-img" src="/assets/images/belimal.webp" alt="">
            <h4>vfhefief</h4>
            <h4>Paracetamol</h4>
            <h4>10 mg</h4>
            <h4>Rs.50</h4>
        </div>

        <div class="dashboard__bottom-cards__detail">
            <img class="dashboard__bottom-product-img" src="/assets/images/porridge.jfif" alt="">
            <h4>Vegetable Porridge</h4>
            <h4>Cooked Foods</h4>
            <h4>1 l</h4>
            <h4>Rs. 550</h4>
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
