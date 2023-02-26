<?php
/**
 * @var array $product_details
 * @var array $other_products
 */

$provider_image = $product_details['profile_picture'];
$provider_name = $product_details['provider_name'];
$business_name = $product_details['business_name'];
$business_reg_no = $product_details['business_reg_no'];
$address = $product_details['address'];
$product_image = $product_details['image'];
$product_name = $product_details['name'];
$product_quantity = $product_details['quantity'];
$product_quantity_unit = $product_details['quantity_unit'];
$product_price = $product_details['price']/100;

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
        <div class='overview-items__detail'>
            <h2>$product_name</h2>
            <p>$product_quantity $product_quantity_unit</p>
            <h1>Rs. $product_price</h1>
            <div class='overview-items__card'>
                <button class='btn'><a class='continue-to-pay-btn'  href='/product-checkout'>Continue to pay</a></button>
                <button class='add-to-cart-btn'><i class='fa-solid fa-cart-plus'></i></button>
            </div>
        </div>"
        ?>
    </div>

    <div class="item-top-right__container">
        <?php
        foreach ($other_products as $other_product){
            $rest_product_image = $other_product['image'];
            $rest_product_name = $other_product['name'];
            $rest_product_quantity = $other_product['quantity'];
            $rest_product_quantity_unit = $other_product['quantity_unit'];
            $rest_product_price = $other_product['price']/100;
            echo "<div class='overview-items'>
                <img src='$rest_product_image' alt=''>
                <div>
                    <p class='overview-items__name'>$rest_product_name </p>
                    <p>$rest_product_quantity $rest_product_quantity_unit</p>
                    <p class='overview-items__price'>Rs. $rest_product_price</p>
                    <button class='add-to-cart-btn'><i class='fa-solid fa-cart-plus'></i></button>
                </div>

                </div>";
        }
        ?>

    </div>

</div>

<div class="item-bottom-container">
    <div class="item-bottom-left-container">
        <div class="consumer-feedback">
            <div class="consumer-feedback__header">

                <div class="consumer-feedback__header-profile">
                    <img class="product-seller-orders-profile-pic" src="/assets/images/profilepic4.jpg" alt="">
                    <h3>Sanath Gunapala</h3>
                </div>
                <h4>12th of January 2023</h4>
            </div>
            <p class="consumer-dashboard__body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's
                standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                to
                make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                containing
                Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
                versions
                of Lorem Ipsum
            </p>
        </div>
        <div class="consumer-feedback">
            <div class="consumer-feedback__header">

                <div class="consumer-feedback__header-profile">
                    <img class="product-seller-orders-profile-pic" src="/assets/images/profilepic4.jpg" alt="">
                    <h3>Sanath Gunapala</h3>
                </div>
                <h4>12th of January 2023</h4>
            </div>
            <p class="consumer-dashboard__body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's
                standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                to
                make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                containing
                Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
                versions
                of Lorem Ipsum
            </p>
        </div>
        <div class="consumer-feedback">
            <div class="consumer-feedback__header">

                <div class="consumer-feedback__header-profile">
                    <img class="product-seller-orders-profile-pic" src="/assets/images/profilepic4.jpg" alt="">
                    <h3>Sanath Gunapala</h3>
                </div>
                <h4>12th of January 2023</h4>
            </div>
            <p class="consumer-dashboard__body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's
                standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                to
                make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                containing
                Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
                versions
                of Lorem Ipsum
            </p>
        </div>
    </div>

    <div class="item-bottom-right-container">
        <h3>Give your feedback</h3>
        <form action="">
            <textarea name="" id="" cols="28" rows="17"></textarea>
        </form>
    </div>
</div>