<?php
?>




<form action="/pharmacy-dashboard/medicines" class="products-form" id="update-medicine-form" method="post"
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

    <button id = "update-medicines-submit-btn">submit</button>

</form>



