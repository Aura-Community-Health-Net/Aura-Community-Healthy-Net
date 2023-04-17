<?php
/**
 * @var array $consumer
 * @var array $pharmacy_request_details
 * @var array $pharmacy_details
 */
//print_r($appointments_details);
//$provider_nic = $_SESSION['nic'];


?>



<!--<div class="doctor-appointments__left__container">-->


    <div class="pharmacy-request__left__background">
        <?php foreach ($pharmacy_details as  $detail)
        {
            $pharmacy_name = $detail['name'];
            $profile_img = $detail['profile_picture'];
            $mobile_number = $detail['mobile_number'];
            $request_id = $detail['request_id'];

            echo "

            <div class='pharmacy_request__left'>

                    <div class='pharmacy_request__left__data'>
                        <img id='pharmacy-request-consumer-profile' src='$profile_img' alt=''>
                        <p>$pharmacy_name</p>
                        <p>$mobile_number</p>
                       <i class='fa-solid fa-location-dot'></i>
                    
                        <button class='ok-btn' id='accept-request-btn'><a href='/consumer-dashboard/services/pharmacy/payment-receipt?id=$request_id'>proceed</a></button>

                    </div>


            </div>";
          }?>
    </div>
<!--</div>-->

