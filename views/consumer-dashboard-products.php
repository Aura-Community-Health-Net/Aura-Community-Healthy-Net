<?php
/**
 * @var array | null $products
 * @
 */

$products = is_null($products) ? [] : $products;
?>


<form action="/consumer-dashboard/products" class="form-item--search" method="get">
    <div class="search-bar">
        <input type="text" placeholder="Search Product..." name="q" id="q">
        <button href="" type="submit"><i class="fa fa-search"></i></button>
    </div>
    <select class="form-items--dropdown" name="product-categories" id="product-categories">
        <option value="Medicinal Fruits & Vegetables">Medicinal Fruits & Vegetables</option>
        <option value="Seeds">Seeds</option>
        <option value="Leaves">Leaves</option>
        <option value="Dried Herbs">Dried Herbs</option>
        <option value="Cooked Foods">Cooked Foods</option>
    </select>
</form>

<div class="consumer-product__grid-container" id="consumer-product__grid-container">
    <?php
    foreach ($products as $product){
        $product_id = $product['product_id'];
        $product_name = $product['name'];
        $product_quantity = $product['quantity'];
        $product_price = $product['price']/100;
        $product_quantity_unit = $product['quantity_unit'];
        $product_image = $product['image'];
        $business_name = $product['business_name'];
        $product_stock = $product['stock'];
        $category_id = $product['category_id'];
        $is_available = $product_stock > 0 || $category_id === 5 ? "" : "<p>No stock</p>";
        echo "<div class='product__grid-item'>
        <img src='$product_image' alt=''>
        <div class='product'>
            <h2>$product_name</h2>
            <h3>$product_quantity $product_quantity_unit</h3>
            $is_available
            <h1>Rs. $product_price</h1>
            <h3>$business_name</h3>
            <a href='/products/view?id=$product_id' class='product-select-btn'>Select</a>
        </div>
    </div>";
    }
    ?>
</div>

<!--<div class='pagination-numbers'>-->
<!--    <a class="pagination-button">1</a>-->
<!--    <a class="pagination-button pagination-button--active">2</a>-->
<!--    <a class="pagination-button">3</a>-->
<!--</div>-->




