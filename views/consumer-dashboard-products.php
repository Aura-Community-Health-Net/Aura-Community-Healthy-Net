<?php
/**
 * @var array | null $products
 * @var array $product_category
 * @var string|null $searchTerm
 */

$products = is_null($products) ? [] : $products;
//$product_category = $_GET["product_category"] ?? "Medicinal Fruits & Vegetables";

$searchTerm = $searchTerm ? $searchTerm : "";

?>


<form action="/consumer-dashboard/products" class="form-item--search" method="get">
    <div class="search-bar">
        <input type="text" placeholder="Search Product..." name="q" id="q" value="<?= $searchTerm ?>">
<!--        <button href="" type="submit"><i class="fa fa-search"></i></button>-->
    </div>
        <?php
        $med_fruit_veg_selected = $product_category == "Medicinal Fruits & Vegetables" ? "selected" : "";
        $seeds = $product_category == "Seeds" ? "selected": "";
        $leaves = $product_category == "Leaves" ? "selected" : "";
        $dried_herbs = $product_category == "Dried Herbs" ? "selected" : "";
        $cooked_foods = $product_category == "Cooked Foods" ? "selected" : "s";
        ?>
    <select class="form-items--dropdown" name="product-categories" id="product-categories">
        <option value="all">Select category</option>
        <?php
//        if($med_fruit_veg_selected){
//            echo "<option value='Medicinal Fruits & Vegetables' selected>Medicinal Fruits & Vegetables</option>";
//        } else {
            echo "<option value='Medicinal Fruits & Vegetables' $med_fruit_veg_selected>Medicinal Fruits & Vegetables</option>";
//        }

//        if ($seeds){
//            echo "<option value='Seeds' selected> Seeds </option>";
//        } else {
            echo "<option value='Seeds' $seeds> Seeds </option>";
//        }

//        if ($leaves){
//            echo "<option value='Leaves' selected>Leaves</option>";
//        } else{
            echo "<option value='Leaves' $leaves>Leaves</option>";
//        }

//        if ($dried_herbs){
//            echo "<option value='Dried Herbs' selected>Dried Herbs</option>";
//        } else {
            echo " <option value='Dried Herbs' $dried_herbs>Dried Herbs</option>";
//        }

//        if ($cooked_foods){
//            echo "<option value='Cooked Foods' selected>Cooked Foods</option>";
//        } else{
            echo "<option value='Cooked Foods' $cooked_foods>Cooked Foods</option>";
//        }
        ?>
    </select>
    <input type="submit">
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

    if(empty($products)) {
        echo "No results";
    }
    ?>
</div>

<!--<div class='pagination-numbers'>-->
<!--    <a class="pagination-button">1</a>-->
<!--    <a class="pagination-button pagination-button--active">2</a>-->
<!--    <a class="pagination-button">3</a>-->
<!--</div>-->




