<?php
/**
 * @var array $consumer
 * @var array $payment_details
 * @var array $title
 * @var array $active_link
 */

//var_dump($consumer);
//var_dump($payment_details);
//var_dump($pharmacy);
$pharmacy_name = $payment_details['pharmacy_name'];
$advance_amount = $payment_details['advance_amount']/100;
$Total_amount = $payment_details['total_amount']/100;
$note = $payment_details['pharmacy_remark'];
$medicines_list = $payment_details['available_medicines'];
$prescription = $payment_details['prescription'];
$customer_remark = $payment_details['customer_remark'];
$medicines = json_decode($medicines_list, true);


//$medicines_list = json_decode($payment_details['medicines_list'],true);

//$medicines_list = json_decode($payment_details['medicines_list'],true);
$request_id = $payment_details['request_id'];

?>


    <div class='consumer-pharmacy-neworders-advanceinfo'>
<?php

if ($medicines === null) {
    echo "<div class='pharmacy_reply'>Pharmacy has not replied yet</div>";
    echo "
            <div class='pharmacy_request_details'>
                  <img class='prescription_image' src='$prescription' alt=''>
                  <div class='customer_remark'>Customer Remark : <p class='customer_remark_data'>$customer_remark</p></div>      
            </div>";
} else {

    $medicines_list_elements = "";

    foreach ($medicines as $medicine) {
        $medicines_list_elements = $medicines_list_elements . "<li>$medicine</li>";
    }


    echo "
    <div class='consumer-pharmacy-neworders-advanceinfo-pharmacyName'>
      <h2>$pharmacy_name</h2>
    </div>

    <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details'>
        <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details__names'>
            <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details__names__availableMedList'>
                <p>Available Medicines List</p>
            </div>
            <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details__names__TotalAmount'>
                <p>Total Amount</p>
            </div>
            <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details__names__AdvanceAmount'>
                <p>Advance Amount</p>
            </div>
            <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details__names__Note'>
                <p>Note</p>
            </div>
        </div>
  
        <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details__description'>
            <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details__description__medicineList'>
                <ul class='medicines_list'>
                  $medicines_list_elements 
                </ul>
            </div>
            <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details__description__TotalAmount'>
                <p>Rs. $Total_amount</p>
            </div>
            <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details__description__AdvanceAmount'>
                <p>Rs. $advance_amount</p>
            </div>
            <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details__description__Note'>
                <p>$note</p>
            </div>
        </div>
    </div>
    <div class='consumer-pharmacy-neworders-advanceinfo__button'><button class='advance-info-submit-button' id='advance-info-submit-button'><a href='/consumer-dashboard/services/pharmacy/medicines-checkout?id=$request_id'>Continue to Pay</a></button>

    </div>

</div>
?>";
}

