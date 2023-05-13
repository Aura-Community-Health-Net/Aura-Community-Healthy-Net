<?php

/** @var array $consumer
 * @var array $pharmacy_reply
 * @var array $title
 * @var array $active_link
 *
 * */
?>

<div class="pharmacy-reply__left__background">

<?php
 foreach ($pharmacy_reply as  $detail)
{
    $pharmacy_name = $detail['name'];
    $profile_img = $detail['profile_picture'];
    $mobile_number = $detail['mobile_number'];
    $request_id = $detail['request_id'];
    $date_time = $detail['date_time'];
    $date = explode(" ",$date_time)[0];     $hasReplied = $detail['advance_amount'] !== null ? "<p class='pharmacy-replied'>Pharmacy replied</p>":
    $hasReplied = $detail['advance_amount'];

    echo "
            <div class='pharmacy_reply__left'>
                    <div class='pharmacy_reply__left__data'>
                        <img id='pharmacy-reply-consumer-profile' src='$profile_img' alt=''>
                        <p class='reply_detail_pharmacyName'>$pharmacy_name</p>
                        <p>$mobile_number</p>
                        <p>$date</p>
                        <p>Pharmacy Replied</p>
                        <button class='ok-btn' id='accept-reply-btn'><a href='/consumer-dashboard/services/pharmacy/payment-receipt?id=$request_id'>View</a></button>
                    </div>
            </div>";
}

?>

</div>


