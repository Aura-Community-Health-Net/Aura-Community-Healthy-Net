<?php

/**
 * @var array $orders
 *
 * */
?>

<table class="items-table">

    <table class="items-table">
        <tr>
            <th>Profile Picture</th>
            <th>Name</th>
            <th>Mobile Number</th>
            <th>Medicines</th>
        </tr>

        <?php
//        var_dump($orders);
        foreach ($orders as $order){
            $profile_picture = $order['profile_picture'];
            $consumer_name = $order['consumer_name'];
            $mobile_number = $order['mobile_number'];
            $medicines_list = $order['available_medicines'];
            $medicines = json_decode($medicines_list,true);

            $order_id = $order['order_id'];

//
//            foreach ($medicines as $medicine) {
//                $medicineList = implode(", ", $medicine);
//
//            }
//
//            var_dump($medicineList);
//            exit();
            $medicines_element = "";
            foreach ($medicines as $medicine){
                $medicines_element = $medicines_element."<li>$medicine</li>";
            }





            echo "
            <tr>
            <td><img class='product-seller-orders-profile-pic' src='$profile_picture' alt=''></td>
            <td>$consumer_name</td>
            <td>$mobile_number</td>
            
            <td>
            <ul style='list-style: none'>$medicines_element</ul>
</td>

          
            
            <form action='/pharmacy-dashboard/orders/mark-as-done?order_id=$order_id' method='post'>
               <td><button class='done-btn'>Done</button></td>
            </form>
           

            
        </tr>
            ";
        }
        ?>

    </table>

</table>


<!--<td>--><?php //foreach($medicines as $medicine){
//        $medicines_list_elements = $medicines_list_elements.'<li>$medicine</li>';
//    } ?><!--</td>-->
<?php
if (empty($orders)) {
    echo "
        <div class='no-feedback'>
            No orders yet
        </div>
        ";
}
?>