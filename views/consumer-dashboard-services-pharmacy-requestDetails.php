<?php
/**
 * @var array $consumer
 * @var array $consumer_request
 * @var array $pharmacy_reply
 */
//print_r($appointments_details);
//$provider_nic = $_SESSION['nic'];


?>



<!--<div class="doctor-appointments__left__container">-->


    <div class="pharmacy-request__left__background">
        <?php foreach ($pharmacy_reply as  $detail)
        {
            $pharmacy_name = $detail['name'];
            $profile_img = $detail['profile_picture'];
            $mobile_number = $detail['mobile_number'];
            $request_id = $detail['request_id'];
            $date_time = $detail['date_time'];
            $date = explode(" ",$date_time)[0];
//            $hasReplied = $detail['advance_amount'] !== null ? "<p class='pharmacy-replied'>Pharmacy replied</p>";
            $hasReplied = $detail['advance_amount'];

            echo "
            <div class='pharmacy_request__left'>
                    <div class='pharmacy_request__left__data'>
                        <img id='pharmacy-request-consumer-profile' src='$profile_img' alt=''>
                        <p class='request_detail_pharmacyName'>$pharmacy_name</p>
                        <p>$mobile_number</p>
                        <p>$date</p>
                        <p>Pharmacy Replied</p>
                        <button class='ok-btn' id='accept-request-btn'><a href='/consumer-dashboard/services/pharmacy/payment-receipt?id=$request_id'>View</a></button>
                    </div>
            </div>";
          }?>


          <?php
             foreach ($consumer_request as $consumer){

                 $consumer_profile = $consumer["profile_picture"];
                 $pharmacy_name = $consumer['name'];
                 $mobile_number = $consumer['mobile_number'];
                 $request_id = $consumer['request_id'];
                 $date_time = $consumer['date_time'];
                 $date = explode(" ",$date_time)[0];

             echo "  <div class='pharmacy_request__left'>
                    <div class='pharmacy_request__left__data'>
                        <img id='pharmacy-request-consumer-profile' src='$consumer_profile' alt=''>
                        <p class='request_detail_pharmacyName'>$pharmacy_name</p>
                        <p>$mobile_number</p>
                        <p>$date</p>
                        <p>Request sent</p>
                        <button class='ok-btn' id='accept-request-btn'><a href='/consumer-dashboard/services/pharmacy/payment-receipt?id=$request_id'>View</a></button>
                    </div>
            </div>
             ";




             } ?>
    </div>
<!--</div>-->

