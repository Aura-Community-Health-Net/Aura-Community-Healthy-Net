<?php
/**
 * @var array $consumer
 * @var array $consumer_request
 */
?>



<!--<div class="doctor-appointments__left__container">-->


    <div class="pharmacy-request__left__background">
<<<<<<< HEAD
=======

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
>>>>>>> 7bfe5a0b48dcc02550b10fcb0439a150877777c6


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
<<<<<<< HEAD
            </div>
             ";




             } ?>
    </div>


=======
            </div>";
          }}
        ?>
    </div>
<!--</div>-->
>>>>>>> 7bfe5a0b48dcc02550b10fcb0439a150877777c6

