<?php
/**
 * @var array $consumer
 * @var array $pharmacy_request_details
 * @var array $pharmacy_details
 */
?>



<!--<div class="doctor-appointments__left__container">-->


    <div class="pharmacy-request__left__background">

        <?php

        if (empty($pharmacy_details)) {
            echo "<h2 class='empty-feedbacks'>You haven't made requests yet</h2>";

        }
        else{




        foreach ($pharmacy_details as  $detail)
        {
            $pharmacy_name = $detail['name'];
            $profile_img = $detail['profile_picture'];
            $mobile_number = $detail['mobile_number'];
            $request_id = $detail['request_id'];
            $date_time = $detail['date_time'];
            $date = explode(" ",$date_time)[0];
            $hasReplied = $detail['advance_amount'] !== null ? "<p class='pharmacy-replied'>Pharmacy replied</p>" : "<p>Request In Progress</p>";


            echo "
            <div class='pharmacy_request__left'>
                    <div class='pharmacy_request__left__data'>
                        <img id='pharmacy-request-consumer-profile' src='$profile_img' alt=''>
                        <p class='request_detail_pharmacyName'>$pharmacy_name</p>
                        <p>$mobile_number</p>
                        <p>$date</p>
                        $hasReplied
                        <button class='ok-btn' id='accept-request-btn'><a href='/consumer-dashboard/services/pharmacy/payment-receipt?id=$request_id'>View</a></button>
                    </div>
            </div>";
          }}
        ?>
    </div>
<!--</div>-->

