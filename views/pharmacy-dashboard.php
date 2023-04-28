<?php
/**
 * @var array $pharmacy
 * @var array $medicines
 * @var array $orders_counts
 * @var array $all_orders_count
 * @var array $medicines_orders_list
 * @var array $order_preview
 * @var string $active_link
 */

if (!$pharmacy['is_verified']) {
    echo "<div class='empty-registrations'> <p>You're not verified yet. Please check later.</p></div>";
}



?>

<div class="dashboard__top-container">
    <div class="dashboard__top-cards">
        <h3>New Orders</h3>
        <?php
        foreach ($medicines_orders_list as $new_order) {

            $consumer_profile = $new_order["profile_picture"];
            $consumer_name = $new_order["consumer_name"];
            $mobile_number = $new_order["mobile_number"];


            echo "
        <div class='dashboard__top-cards__detail'>
            <img class='order-consumer-img' src='$consumer_profile' alt=''>
            <div>
                <h4>$consumer_name</h4>
                <h5>$mobile_number</h5>
            </div>
        </div>
";
        } ?>

    </div>


    <div class="dashboard__top-cards">
        <h3>Orders</h3>


        <?php

        if ($order_preview === null) {
            echo "NO ORDERS YET";
        } else {

            $consumer_name = $order_preview["consumer_name"];
            $consumer_profile = $order_preview["profile_picture"];
            $consumer_mobile = $order_preview["mobile_number"];
            $med_prescription = $order_preview["prescription"];


            echo "
        <div class='dashboard__top-cards__info'>
            <div class='dashboard__top-cards__detail'>
                <img class='order-consumer-img' src='$consumer_profile' alt=''>
                <div>
                    <h4>$consumer_name</h4>
                    <h5>$consumer_mobile</h5>
                </div>
            </div>

            <div class='product-order-details'>
               <img class='order-product-img' src='$med_prescription' alt=''>

            </div>
        </div>

";
        }
        ?>

    </div>


         

    <div class='dashboard__top-cards'>
        <h3>Order Count</h3>
        <div class='order-count__details'>
            <?php foreach ($orders_counts as $count) {
                $order_count = $count["order_count"];
                echo "
            <h3>New Orders</h3>
            <p class='new-order-count'>$order_count</p>
        </div>
        ";
            } ?>

            <?php foreach ($all_orders_count as $all_order){
                $all_orders_count = $all_order["all_order_count"];
                echo "     
        <div class='order-count__details'>
            <h3>All Orders</h3>
            <p class='all-order-count'>$order_count</p>
        </div>";
            }
            ?>

    </div>


</div>

<div class="dashboard__bottom-container">
    <div class="dashboard__bottom-cards">
        <h3>Medicines List</h3>

        <?php foreach ($medicines as $medicine) {

            $med_image = $medicine['image'];
            $med_name = $medicine['name'];
            $med_price = $medicine['price'];
            $med_quantity = $medicine['quantity'];
            $med_quantity_unit = $medicine['quantity_unit'];

            echo "
             <div class='dashboard__bottom-cards__detail'> <img class='dashboard__bottom-product-img' src='$med_image' alt=''>
            <h4></h4>
            <h4>$med_name</h4>
            <h4>$med_quantity $med_quantity_unit</h4>
            <h4>Rs. $med_price</h4>
                  </div>";

        } ?>


    </div>

    <div class="dashboard__bottom-cards">
        <h3>Analytics</h3>
        <img class="dashboard-analytics-img" src="/assets/images/dashboard-analytics.jpg" alt="">
        <div class="dashboard-analytics-description">
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                Ipsum has been the </p>
        </div>
    </div>
</div>
