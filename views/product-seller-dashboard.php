<?php
/**
 *@var array $product_seller
 *@var string $active_link
 * @var array $product_lists
 * @var array $orders_count
 * @var array $orders_list
 * @var array $order_preview
 */

if (!$product_seller['is_verified']) {
    echo "<div class='empty-registrations'> <p>You're not verified yet. Please check later.</p></div>";
}

$profile_picture = $order_preview["profile_picture"];
$consumer_name = $order_preview["consumer_name"];
$mobile_number = $order_preview["mobile_number"];
$product_name = $order_preview["name"];
$quantity = $order_preview["quantity"];
$quantity_unit = $order_preview["quantity_unit"];
$product_image = $order_preview["image"];

?>

<div class="dashboard__top-container">
    <div class="dashboard__top-cards">
        <h3>New Orders</h3>

        <?php
        foreach ($orders_list as $order_list){
            $profile_picture = $order_list['profile_picture'];
            $consumer_name = $order_list['consumer_name'];
            $product_name = $order_list['name'];
            echo "
            <div class='dashboard__top-cards__detail'>
            <img class='order-consumer-img' src='$profile_picture' alt=''>
            <div>
                <h4>$consumer_name</h4>
                <h5>$product_name</h5>
            </div>
        </div>
            ";
        }
        ?>
    </div>

    <div class="dashboard__top-cards">
        <h3>Orders</h3>

        <?php
        echo "
        <div class='dashboard__top-cards__info'>
            <div class='dashboard__top-cards__detail'>
                <img class='order-consumer-img' src='$profile_picture' alt=''>
                <div>
                    <h4>$consumer_name</h4>
                    <h5>$mobile_number</h5>
                </div>
            </div>

            <div class='product-order-details'>
                <h5>$product_name</h5><br>
                <h5>$quantity $quantity_unit</h5>
            </div>
            <img class='order-product-img' src='$product_image' alt=''>
        </div>
        ";
        ?>

    </div>

    <?php
    foreach ($orders_count as $order){
        $order_count = $order["order_count"];
        echo "
        <div class='dashboard__top-cards'>
        <h3>Order Count</h3>
        <div class='order-count__details'>
            <h3>New Orders</h3>
            <p class='new-order-count'>15</p>
        </div>
        <div class='order-count__details'>
            <h3>All Orders</h3>
            <p class='all-order-count'>$order_count</p>
        </div>
    </div>
        ";
    }
    ?>

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
