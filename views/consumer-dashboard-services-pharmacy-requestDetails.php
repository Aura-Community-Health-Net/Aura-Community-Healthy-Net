<?php
/**
 * @var array $consumer
 * @var array $consumer_request
 */
//print_r($appointments_details);
//$provider_nic = $_SESSION['nic'];


?>



<!--<div class="doctor-appointments__left__container">-->


    <div class="pharmacy-request__left__background">


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
                        <button class='ok-btn' id='accept-request-btn'><a href='/consumer-dashboard/services/pharmacy/request-details/view?id=$request_id'>View</a></button>
                    </div>
            </div>
             ";




             } ?>
    </div>



