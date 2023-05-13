<?php
/**
 *
 * @var array $service_consumer ;
 * @var array $success ;
 *
 *
 *
 */



?>

<div class="request-success-container">
    <div class="request-success-container-top">
        <div class="request-success-text">
            <h2>Thanks for your Request</h2>
            <h1>Your Request Has Successfully Sent</h1>
            <i class="payment_success_icon fa-regular fa-circle-check"></i>
        </div>
        <div style="display: flex;flex-direction: column;gap: 0.5rem;">
            <h3 style="color: #5BC849;font-size: 2rem">Your Distance = <?php echo $success['distance'] . "km"; ?></h3>
            <h3 style="color: #5BC849;font-size: 2rem">Your Amount = <?php echo "Rs ".$success['distance']*70 ; ?></h3>
        </div>

    </div>
    <div class="request-success-container-bottom">
        <img src="/assets/images/care-rider-request-success.webp" alt="">
    </div>
</div>