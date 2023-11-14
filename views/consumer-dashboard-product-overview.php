<?php
/**
 * @var array $product_details
 * @var array $other_products
 * @var array $feedback_for_sellers
 */


$provider_nic = $product_details['provider_nic'];
$provider_image = $product_details['profile_picture'];
$provider_name = $product_details['provider_name'];
$business_name = $product_details['business_name'];
$business_reg_no = $product_details['business_reg_no'];
$address = $product_details['address'];
$product_image = $product_details['image'];
$product_name = $product_details['name'];
$product_quantity = $product_details['quantity'];
$product_quantity_unit = $product_details['quantity_unit'];
$product_price = $product_details['price'] / 100;
$product_id = $product_details['product_id'];
$category_id = $product_details['category_id'];
$product_stock = $product_details['stock'];
$is_available = $product_stock > 0 || $category_id === 5 ? "" : "<p class='stock-notice'>No stock</p>";
$is_button_active = $product_stock > 0 || $category_id === 5 ? "" : "disabled";
$href = $product_stock > 0 || $category_id === 5 ? "/product-checkout?product_id=$product_id" : "#";
?>


<div class="item-top__container">
    <div class="item-top-left__container">
        <?php
        echo "
        <img src='$provider_image' alt=''>
        <div class='provider__overview-detail'>
            
            <h2>$provider_name</h2>
            <h3>$business_name</h3>
            <p>Business Reg No : $business_reg_no</p>
            <p>$address</p>
        </div>";
        ?>
    </div>

    <div class="item-top-middle__container">
        <?php
        echo "
        <img src='$product_image' alt=''>
        $is_available
        <div class='overview-items__detail'>
            <h2>$product_name</h2>
            <h3>$product_quantity $product_quantity_unit</h3>
            <h1>Rs. $product_price</h1>
            <div class='overview-items__card'>
                <button class='btn' $is_button_active><a class='continue-to-pay-btn'  href='$href'>Continue to pay</a></button>
                    <button id='add-to-cart-btn' class='add-to-cart-btn' data-id='$product_id'><i class='fa-solid fa-cart-plus'></i></button>
               
                
            </div>
        </div>"
        ?>
    </div>

    <div class="item-top-right__container">
        <?php
        if ($other_products) {
            foreach ($other_products as $other_product) {
                $rest_product_image = $other_product['image'];
                $rest_product_name = $other_product['name'];
                $rest_product_quantity = $other_product['quantity'];
                $rest_product_quantity_unit = $other_product['quantity_unit'];
                $rest_product_price = $other_product['price'] / 100;
                $other_product_id = $other_product['product_id'];
                echo "<div class='overview-items'>
                <img src='$rest_product_image' alt=''>
                <div>
                    <a class='overview-items__name'  href='/products/view?id=$other_product_id'>$rest_product_name </a>
                    <p>$rest_product_quantity $rest_product_quantity_unit</p>
                    <p class='overview-items__price'>Rs. $rest_product_price</p>
                    <button id='add-to-cart-btn' class='add-to-cart-btn' data-id='$other_product_id'><i class='fa-solid fa-cart-plus'></i></button>
                </div>

                </div>";
            }
        } else {
            echo "
            <h2 class='empty-product-orders'>No Products yet</h2>
            ";
        }
        ?>
    </div>
</div>

<div class="item-bottom-container">
    <div class="item-bottom-left-container">

        <?php
        if (empty($feedback_for_sellers)) {
            echo "<h2 class='empty-product-orders'>No feedback yet</h2>";
        } else {
            foreach ($feedback_for_sellers as $feedback_for_seller) {
                $feedback_profile_pic = $feedback_for_seller['profile_picture'];
                $feedback_consumer_name = $feedback_for_seller['name'];
                $feedback_date = $feedback_for_seller['date_time'];
                $feedback_text = $feedback_for_seller['text'];

                echo "
                <div class='consumer-feedback'>
                <div class='consumer-feedback__header'>

                <div class='consumer-feedback__header-profile'>
                    <img class='product-seller-orders-profile-pic' src='$feedback_profile_pic' alt=''>
                    <h3>$feedback_consumer_name</h3>
                </div>
                <h4>$feedback_date</h4>
            </div>
            <p class='consumer-feedback__body'>
                $feedback_text
            </p>
                </div>";

            }
        }
        ?>
    </div>

    <div class="item-bottom-right-container">
        <h3>Give your feedback</h3>
        <form action="<?php echo "/consumer-dashboard/products-overview/feedback?provider_nic=$provider_nic&product_id=$product_id"; ?>"
              method="post">
            <textarea class="feedback-textarea" name="product-feedback" id="" cols="28" rows="17"></textarea>
            <button class="btn">Submit</button>
        </form>
    </div>
</div>

<script src="/assets/js/pages/product-overview.js" type="module"></script>