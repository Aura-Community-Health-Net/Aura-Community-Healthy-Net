<?php
/**
 * @var array $products
 * @var string $title
 * @var string $category
 * @var array $product_seller
 * @var string $active_link
 *
 */

$stock = $_POST["stock"] ?? "";
?>
<table class="items-table">
    <tr>
        <th>Product Image</th>
        <th>ID Number</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price (Rs.)</th>
        <?php if ($category != 5) {
            echo '<th>Stock</th>';
        } ?>
        <th id="actions">Actions</th>
    </tr>

    <?php
    foreach ($products as $product) {
        $price = (int) $product["price"] / 100;
        $id = $product['product_id'];
        $name = $product['name'];
        $categoryId = $product['category_id'];
        $quantity = $product['quantity'];
        $quantity_unit = $product['quantity_unit'];
        $stock = $product['stock'];


        echo "<tr data-productid='$id' data-productname='$name' data-productquantity='$quantity' data-productquantity_unit='$quantity_unit' data-productprice='$price' data-productstock = '$stock'>
        
        <td id='image-block'>
        <img src='{$product["image"]}' alt='' class='products-img'>
        </td>
        <td >{$id}</td>
        <td >{$name}</td>
        <td>{$product['quantity']} {$product['quantity_unit']} </td> 
        <td>{$price}</td>
        <td>{$product['stock']}</td>
        <td id='action-block'>
        <button id='update-product-$id' data-productid='$id' data-productName='$name' data-categoryId='$categoryId' class='action-btn action-btn--edit product-update'><i class='fa-solid fa-pen'></i></button> 
        <button id='delete-product-$id' data-productid='$id' data-productName='$name' data-categoryId='$categoryId' class='action-btn action-btn--delete product-delete'><i class='fa-solid fa-trash'></i></button></td>
    </tr>";
    }

    ?>
</table>

<form class="products-form" id="add-product-form"
    action="/product-seller-dashboard/products?category=<?php echo $category ?>" method="post"
    enctype="multipart/form-data">
    <table>
        <tr>
            <th><label for="image">Product Image</label></th>
            <th><label class="products-label" for="name">Product Name</label></th>
            <th><label class="products-label" for="quantity">Quantity</label></th>
            <th><label class="products-label" for="quantity_unit">Quantity Unit</label></th>
            <th><label class="products-label" for="price">Price (Rs.)</label></th>
            <?php if ($category != 5) {
                echo '<th><label class="products-label" for="stock">Stock</label></th>';
            } ?>
        </tr>

        <tr>
            <td><input type="file" id="image" name="image" style="display: none; visibility: hidden" accept="image/*"
                    required>
                <div class="form-upload-component">
                    <button class="upload-btn" id="image-btn" type="button">
                        <i class="fa fa-plus add-icon"></i>
                    </button>
                    <div id="image-filename"></div>
                </div>
            </td>

            <td><input type="text" id="name" name="name" value="<?php echo $_POST['name'] ?? ''; ?>" required></td>
            <td><input type="number" id="quantity" name="quantity" value="<?php echo $_POST['quantity'] ?? ''; ?>"
                    required></td>
            <td><input type="text" id="quantity_unit" name="quantity_unit"
                    value="<?php echo $_POST['quantity_unit'] ?? ''; ?>" required></td>
            <td><input type="number" id="price" name="price" value="<?php echo $_POST['price'] ?? ''; ?>" required></td>
            <?php if ($category != 5) {
                $stock = $_POST["stock"] ?? "";
                echo "<td><input type='number' id='stock' name='stock' value='$stock' required></td>";
            } ?>
        </tr>
    </table>

    <button class="add-btn" id="add-product-btn" type="button"><i class="fa fa-plus"></i></button>
</form>

<div class="overlay" id="add-product-overlay">
    <div class="modal" id="add-product-modal">
        <h3>Do you really want to add this Product?</h3>
        <img class="modal-img" src="/assets/images/confirmation.jpg" alt="">
        <div class="modal-actions">
            <button class="cancel-btn" id="add-product-cancel-btn">Cancel</button>
            <button class="ok-btn" id="add-product-ok-btn">Ok</button>
        </div>
    </div>
</div>

<div class="overlay" id="delete-product-overlay">
    <div class="modal" id="delete-product-modal">

    </div>
</div>

<div class="overlay" id="update-product-overlay">
    <div class="modal" id="update-product-modal">

    </div>
</div>

<script src="/assets/js/pages/products.js"></script>