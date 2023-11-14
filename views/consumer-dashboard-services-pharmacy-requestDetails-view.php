<?php
/**
 * @var array $sentRequest_details
 * @var array $consumer
 * @var array $title
 * @var array $active_link
 */

?>

    <div class='pharmacy_request_details'>
<?php


    $prescription = $sentRequest_details["prescription"];
    $customer_remark = $sentRequest_details["customer_remark"];
    echo "
         <img class='prescription_image' src='$prescription' alt='' >
         <div class='customer_remark'>Customer Remark : <p class='customer_remark_data'>$customer_remark</p></div>
   ";
?>


    </div>
