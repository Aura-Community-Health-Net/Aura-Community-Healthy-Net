<?php

/**
 * @var array $pharmacies
 */


?>

<div class="sent-request__container">
    <button class="consumer-services-pharmacy-pharmacyRequest-button"><a
                href="/consumer-dashboard/services/pharmacy/request-details">Sent Requests</a></button>

    <button class="consumer-services-pharmacy-pharmacyReply-button"><a href="/consumer-dashboard/services/pharmacy/pharmacy-reply">Pharmacy Reply</a></button>
</div>


<div class='consumer-services-pharmacy-pharmacylist-Container'>

    <?php
    foreach ($pharmacies as $pharmacy){
        $pharmacy_name = $pharmacy['pharmacy_name'];
        $mobile = $pharmacy['mobile_number'];
        $id = $pharmacy['id'];

        echo "
         <tr data-pharmacyid='$id' data-pharmacyname = '$pharmacy_name'>
        <div class = 'services-pharmacy-pharmacyList'>
            <div class='services-pharmacy-attributes' id='services-pharmacy-pharmacyName'>$pharmacy_name
            </div>

            <div class= 'services-pharmacy-attributes' id='services-pharmacy-pharmacyContactNo'>$mobile
            </div>

            <div  class='services-pharmacy-attributes' id='services-pharmacy-pharmacyViewButton'>
                <button class='pharmacy-view-btn'><a href='/consumer-dashboard/services/pharmacy/view?id=$id'>View</a></button>
            </div>
            

            <div  class='services-pharmacy-attributes' id='services-pharmacy-presUpload-btn'>
                <button id='request-pharmacy-$id' data-pharmacyid='$id' data-pharmacyname='$pharmacy_name'  class='action-btn action-btn--request pharmacy-request'>Upload Prescription</button>
            </div>
            

        </div>
    </tr>
        
        ";
    }
    ?>
</div>

<div class="overlay" id="pharmacy-request-overlay">
    <div class="modal" id="pharmacy-request-modal">

    </div>

</div>


<script src="/assets/js/pages/pharmacy-request.js"></script>

