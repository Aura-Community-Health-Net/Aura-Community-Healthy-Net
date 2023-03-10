<?php
/**
 * @var array $pharmacy
 * @var array $medicines
 */
?>
<table class="items-table">
    <tr>
        <th>Medicine Image</th>
        <th>ID_Number</th>
        <th>Medicine Name</th>
        <th>Price(Rs.)</th>
        <th>Quantity</th>
        <th>Quantity Unit</th>
        <th>Stock</th>
        <th>Stock Unit</th>
    </tr>
    <?php
    foreach ($medicines as $medicine) {
        echo "
                      <tr>   
                    <td id='image-block'><img class='products-img' src='{$medicine['image']}' alt=''></td>
                    <td>{$medicine['med_id']}</td>
                    <td>{$medicine['name']}</td>
                    <td>{$medicine['price']}</td>
                    <td>{$medicine['quantity']}</td>
                    <td>{$medicine['quantity_unit']}</td>
                    <td>{$medicine['stock']}</td>
                    <td>{$medicine['stock_unit']}</td>
                    
                    <td id='action-block'><button class='action-btn action-btn--edit'><i class='fa-solid fa-pen'></i></button> <button class='action-btn action-btn--delete'><i class='fa-solid fa-trash'></i></button></td>
        </tr>";
    } ?>
</table>
<form action="/pharmacy-dashboard/medicines" class="products-form" id="add-medicine-form" method="post"
      enctype="multipart/form-data">
    <table>
        <tr>
            <th><label>Medicine Image</label></th>
            <!-- <th>ID_Number</th> -->
            <th><label class="products-label">Medicine Name</label></th>
            <th><label class="products-label">Price(Rs.)</label></th>
            <th><label class="products-label">Quantity</label></th>
            <th><label class="products-label">Quantity Unit</label></th>
            <th><label class="products-label">Stock</label></th>
            <th><label class="products-label">Stock Unit</label></th>
        </tr>
        <tr>
            <td><input type="file" id="add_img" name="image" style="display: none; visibility: hidden" accept="image/*"
                       required>
                <div class="form-upload-component">
                    <button class="upload-btn" id="image-btn" type="button">
                        <i class="fa-solid fa-plus add-icon"></i>
                    </button>
                    <div id="image-filename"></div>
                </div>
            </td>
            <td><input type="text" name="med_name" value="<?php echo $_POST['med_name'] ?? ''; ?>"></td>
            <td><input type="number" name="price" value="<?php echo $_POST['price'] ?? ''; ?>"></td>
            <td><input type="number" name="quantity" value="<?php echo $_POST['quantity'] ?? ''; ?>"></td>
            <td><input type="text" name="quantity_unit" value="<?php echo $_POST['quantity_unit'] ?? ''; ?>"></td>
            <td><input type="number" name="stock" value="<?php echo $_POST['stock'] ?? ''; ?>"></td>
            <td><input type="text" name="stock_unit" value="<?php echo $_POST['stock_unit'] ?? ''; ?>"></td>
        </tr>
    </table>
    <button type="button" id="add-med-btn" class="add-btn">
        <i class="fa-solid fa-plus"></i>
    </button>
</form>
<div class="overlay" id="add-medicine-overlay">
    <div class="modal" id="add-medicine-modal">
        <h3>Do you really want to add this product?</h3>
        <img class="modal-img" src="/assets/images/confirmation.jpg">
        <div class="modal-actions">
            <button class="cancel-btn" id="add-medicine-cancel-btn">Cancel</button>
            <button class="ok-btn" id="add-medicine-ok-btn">ok</button>
        </div>
    </div>
</div>

<script src="/assets/js/pages/medicines.js"></script>