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
$advance_amount = $payment_details['advance_amount'];
$Total_amount = $payment_details['total_amount'];
$note = $payment_details['pharmacy_remark'];
$medicines_list = $payment_details['available_medicines'];
$medicines = json_decode($medicines_list,true);

//$medicines_list = json_decode($payment_details['medicines_list'],true);

//$medicines_list = json_decode($payment_details['medicines_list'],true);
$request_id = $payment_details['request_id'];

?>



<div class='consumer-pharmacy-neworders-advanceinfo'>
    <?php




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
                    <li>$medicines_list</li>

                </ul>
            </div>
            <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details__description__TotalAmount'>
                <p>$Total_amount</p>
            </div>
            <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details__description__AdvanceAmount'>
                <p>$advance_amount</p>
            </div>
            <div class='consumer-pharmacy-neworders-advanceinfo__order-med-details__description__Note'>
                <p>$note</p>
            </div>
        </div>
    </div>
    <div class='consumer-pharmacy-neworders-advanceinfo__button'><button class='advance-info-submit-button' id='advance-info-submit-button'><a href='/consumer-dashboard/services/pharmacy/medicines-payment?id=$request_id'>Continue to Pay</a></button>



    </div>

</div>
?>";