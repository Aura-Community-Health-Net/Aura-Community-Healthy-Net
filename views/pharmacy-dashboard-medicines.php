<?php
/**
 * @var array $pharmacy
 * @var array $medicines
 * @var string $title
 * @var string $active_link
 */
?>
<?php
foreach ($medicines as $medicine) {
    $med_id = $medicine['med_id'];
}
?>
<form action="/pharmacy-dashboard/medicines" class="form-item--search" method="get">
    <div class="search-bar">
        <input type="text" placeholder="Search Medicine..." name="query" id="query">
        <button href="" type="submit"><i class="fa fa-search"></i></button>

    </div>
</form>
<table class="items-table">
    <tr>
        <th>Medicine Image</th>
        <th>ID_Number</th>
        <th>Medicine Name</th>
        <th>Price(Rs.)</th>
        <th>Quantity</th>
        <th>Quantity Unit</th>
        <th>Stock</th>

    </tr>
    <?php
    foreach ($medicines as $medicine) {

        $med_id = $medicine['med_id'];
        $med_name = $medicine['name'];
        $med_price = $medicine['price']/100;
        $med_quantity = $medicine['quantity'];
        $med_quantity_unit = $medicine['quantity_unit'];
        $med_stock = $medicine['stock'];


        echo "
                    <tr data-medicineid='$med_id' data-medicinename='$med_name' data-medicineprice='$med_price' data-medicinequantity ='$med_quantity' data-medicinequantity_unit='$med_quantity_unit' data-medicinestock ='$med_stock'>  
                     
                    <td id='image-block'><img class='products-img' src='{$medicine['image']}' alt=''></td>
                    <td>{$med_id}</td>
                    <td>{$med_name}</td>
                    <td>$med_price</td>
                    <td>{$medicine['quantity']}</td>
                    <td>{$medicine['quantity_unit']}</td>
                    <td>{$medicine['stock']}</td>
                    
                    <td id='action-block'>
                        <button id = 'delete-medicines-$med_id' data-medicineid = '$med_id' data-medicinename = '$med_name' class='action-btn action-btn--delete medicine-delete'><i class='fa-solid fa-trash'></i></button>
                        <button id = 'update-medicines-$med_id'  data-medicineid = '$med_id' data-medicinename = '$med_name' class='action-btn action-btn--update medicine-update'><i class='fa-solid fa-pen' style='color: #FFD700'></i></button>

                    </td>
                    
                                        
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

        </tr>
        <tr>
            <td><input type="file" id="add_img" name="image" style="display: none; visibility: hidden" accept="image/*"
                       required>
                <div class="form-upload-component">
                    <button class="upload-btn" id="image-btn" type="button">
                        <i class="fa fa-plus"></i>
                    </button>
                    <div id="image-filename"></div>
                </div>
            </td>
            <td><input type="text" name="med_name" value="<?php echo $_POST['med_name'] ?? ''; ?>"></td>
            <td><input type="number" name="price" value="<?php echo $_POST['price'] ?? ''; ?>"></td>
            <td><input type="number" name="quantity" value="<?php echo $_POST['quantity'] ?? ''; ?>"></td>
            <td><input type="text" name="quantity_unit" value="<?php echo $_POST['quantity_unit'] ?? ''; ?>"></td>
            <td><input type="number" name="stock" value="<?php echo $_POST['stock'] ?? ''; ?>"></td>
        </tr>
    </table>
    <button type="button" id="add-med-btn" class="add-btn">
        <i class="fa fa-plus"></i>
    </button>
</form>
<div class="overlay" id="add-medicine-overlay">
    <div class="modal" id="add-medicine-modal">
        <h3>Do you really want to add this medicine?</h3>
        <img class="modal-img" src="/assets/images/confirmation.jpg">
        <div class="modal-actions">
            <button class="cancel-btn" id="add-medicine-cancel-btn">Cancel</button>
            <button class="ok-btn" id="add-medicine-ok-btn">Ok</button>
        </div>
    </div>
</div>


<div class="overlay" id="delete-medicine-overlay">
    <div class="modal" id="delete-medicine-modal">

    </div>
</div>


<div class="overlay" id="update-medicine-overlay">
    <div class="modal" id="update-medicine-modal">

    </div>

</div>






<script src="/assets/js/pages/medicines.js"></script>