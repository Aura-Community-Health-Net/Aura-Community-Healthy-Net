<?php

/**
 * @var array $pharmacies
*/


?>

<div class="consumer-services-pharmacy-pharmacylist-Container">
   <?php

     foreach ($pharmacies as $pharmacy)
     {
         $pharmacy_name = $pharmacy['pharmacy_name'];
         $mobile = $pharmacy['mobile_number'];
         $id = $pharmacy['id'];



         echo "
         <div class = 'services-pharmacy-pharmacyList'>
        

     <div class='services-pharmacy-attributes' id='services-pharmacy-pharmacyName'>$pharmacy_name
        </div>

        <div class= 'services-pharmacy-attributes' id='services-pharmacy-pharmacyContactNo'>$mobile
        </div>

        <div  class='services-pharmacy-attributes' id='services-pharmacy-pharmacyViewButton'>
            <button class='pharmacy-view-btn'><a href='/consumer-dashboard/services/pharmacy/view?id=$id'>view</a></button>
        </div>

        <div  class='services-pharmacy-attributes' id='services-pharmacy-presUpload-btn'>
            <button class='pharmacy-pres-upload-btn'>Upload prescription</button>
        </div>
        <div  class='services-pharmacy-attributes' id='services-pharmacy-pharmacyLocation'>
            <i class='fa-solid fa-location-dot'></i>
        </div>


     

       
    </div>


         ";
     }

   ?>














    <button class="consumer-services-pharmacy-pharmacyRequest-button"><a href="/consumer-dashboard/services/pharmacy/payment-receipt">Pharmacy Request</a> </button>


</div>



