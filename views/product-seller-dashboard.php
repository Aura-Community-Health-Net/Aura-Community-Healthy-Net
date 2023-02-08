<?php
/**
 *@var array $product_seller
 *@var string $active_link
 */

if (!$product_seller['is_verified']) {
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
                <h5>Nil Veralu</h5>
            </div>
        </div>

        <div class="dashboard__top-cards__detail">
            <img class="order-consumer-img" src="/assets/images/profilepic2.jpg" alt="">
            <div>
                <h4>Semini Peduruarachchi</h4>
                <h5>Cashews</h5>
            </div>
        </div>

        <div class="dashboard__top-cards__detail">
            <img class="order-consumer-img" src="/assets/images/profilepic3.jpg" alt="">
            <div>
                <h4>Anoj Karunarathna</h4>
                <h5>Vegetable Porridge</h5>
            </div>
        </div>

        <div class="dashboard__top-cards__detail">
            <img class="order-consumer-img" src="/assets/images/profilepic4.jpg" alt="">
            <div>
                <h4>Kamal Disasekara</h4>
                <h5>Pachchaperumaal</h5>
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
                <h5>Nil Veralu</h5><br>
                <h5>500 g</h5>
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

<div class="dashboard__bottom-cards">
    <h3>New Orders</h3>
    <div class="dashboard__bottom-cards__detail">
        <img src="/assets/images/nil-veralu.jfif" alt="">
            <h4>Nil Veralu</h4>
            <h4>Medicinal Fruits & Vegetables</h4>
            <h4>100 g</h4>
            <h4>Rs. 150</h4>
    </div>

    <div class="dashboard__bottom-cards__detail">
        <img src="/assets/images/vali%20anoda.jfif" alt="">
        <h4>Vali Anoda</h4>
        <h4>Medicinal Fruits & Vegetables</h4>
        <h4>1 kg</h4>
        <h4>Rs. 550</h4>
    </div>

    <div class="dashboard__bottom-cards__detail">
        <img src="/assets/images/belimal.webp" alt="">
        <h4>Beli Mal</h4>
        <h4>Seeds</h4>
        <h4>100 g</h4>
        <h4>Rs. 350</h4>
    </div>

    <div class="dashboard__bottom-cards__detail">
        <img src="/assets/images/porridge.jfif" alt="">
        <h4>Vegetable Porridge</h4>
        <h4>Cooked Foods</h4>
        <h4>1 l</h4>
        <h4>Rs. 550</h4>
    </div>

    <h3>Analytics</h3>
</div>
