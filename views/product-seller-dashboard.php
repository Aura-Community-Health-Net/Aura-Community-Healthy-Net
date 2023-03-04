<?php
/**
 *@var array $product_seller
 *@var string $active_link
 * @var array $product_lists
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

<div class="dashboard__bottom-container">
    <div class="dashboard__bottom-cards">
        <h3>Products List</h3>

            <?php
            foreach ($product_lists as $product_list){
                $product_image = $product_list['image'];
                $product_name = $product_list['name'];
                $category_name = $product_list['category_name'];
                $product_quantity = $product_list['quantity'];
                $product_quantity_unit = $product_list['quantity_unit'];
                $product_price = $product_list['price']/100;

                echo "
                <div class='dashboard__bottom-cards__detail'>
                <img class='dashboard__bottom-product-img' src='$product_image' alt=''>
            <h4>$product_name</h4>
            <h4>$category_name</h4>
            <h4>$product_quantity $product_quantity_unit</h4>
            <h4>Rs. $product_price</h4>
            </div>
           
                ";
            }
            ?>
        <a href='/product-seller-dashboard/categories'>
            <button class="all-products-btn">All Products</button>
        </a>

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
