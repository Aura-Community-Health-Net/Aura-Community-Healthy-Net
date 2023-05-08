<?php
/**
 * @var array $products_in_cart
 */
?>

<div class="add-cart-items">
    <?php
    if(empty($products_in_cart)){
        echo"<h1 class='empty_cart'>You don't have any items in your cart !</h1>";
    }
    foreach ($products_in_cart as $product_in_cart) {
    $product_image = $product_in_cart['image'];
    $product_name = $product_in_cart['name'];
    $product_price = $product_in_cart['price']/100;

    echo "

    <div class='cart-item'>
        <img src='$product_image' alt=''>
        <div class='cart-items-details'>
            <p class='cart-item-name'>$product_name</p>
            <p class='cart-item-price'>Rs. $product_price</p>
        </div>
        <div class='add-minus-products'>
            <button class='add-to-cart-btn'><i class='fa-solid fa-minus'></i></button>
            <p>1</p>
            <button class='add-to-cart-btn'> <i class='fa-regular fa-plus'></i></button>
        </div>

        <div class='cart-item__actions'>
            <p class='total-price'>Total : Rs. $product_price</p>
            <button class='action-btn action-btn--delete'><i class='fa-solid fa-trash'></i></button>
        </div>
    </div>
    ";
    }
    ?>
</div>

