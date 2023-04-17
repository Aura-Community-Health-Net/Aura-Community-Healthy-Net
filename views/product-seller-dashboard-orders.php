<?php
/**
 *@var array $orders
 **/
?>
<table class="items-table">

    <table class="items-table">
        <tr>
            <th>Profile Picture</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Category</th>
            <th>Product</th>
            <th>Quantity</th>
        </tr>

        <?php
        foreach ($orders as $order){
            $profile_picture = $order['profile_picture'];
            $consumer_name = $order['consumer_name'];
            $mobile_number = $order['mobile_number'];
            $category = $order['category_name'];
            $product = $order['name'];
            $quantity = $order['quantity'];
            $quantity_unit = $order['quantity_unit'];

            echo "
            <tr>
            <td><img class='product-seller-orders-profile-pic' src='$profile_picture' alt=''></td>
            <td>$consumer_name</td>
            <td>$mobile_number</td>
            <td>$category</td>
            <td>$product</td>
            <td>$quantity $quantity_unit</td>
        </tr>
            ";
        }
        ?>

    </table>

</table>