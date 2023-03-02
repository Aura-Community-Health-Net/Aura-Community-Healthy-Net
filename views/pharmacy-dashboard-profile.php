<?php
/**
 * @var  array $pharmacy
 * @var  array $pharmacy_details
 *
*/
//
//var_dump($pharmacy_details);
 ?>


<div class="pharmacy-profile">

    <?php

    foreach ($pharmacy_details as $pharmacyDetails)
        {
            $pharmacy_owner_name = $pharmacyDetails['name'];
            $pharmacy_name = $pharmacyDetails['pharmacy_name'];
            $pharmacy_regNo = $pharmacyDetails['pharmacist_reg_no'];
            $pharmacy_profile = $pharmacyDetails['profile_picture'];
            $pharmacy_owner_email = $pharmacyDetails['email_address'];
//            $pharmacy_nic = $pharmacyDetails['provider_nic'];
            $pharmacy_nic = $_SESSION['nic'];
            $pharmacy_mobile = $pharmacyDetails['mobile_number'];
            $pharmacy_address = $pharmacyDetails['address'];

            echo "
             <div class='pharmacy-profile__content'>

      <div class='pharmacy-profile__owner-profile'>
            <div class='pharmacy-profile__owner-profile__profile-pic'>
               <img src='$pharmacy_profile' alt=''>

             </div>
             <div class='pharmacy-profile__owner-profile__pharmacy-details'>
                 <p class='pharmacy-owner-name'>$pharmacy_owner_name</p>
                 <p class='pharmacy-name'>$pharmacy_name</p>
                 <p class='pharmacy-regNo'>$pharmacy_regNo</p>

             </div>




      </div>



      <div class='pharmacy-profile__owner-details'>

          <p class='owner-details__attributes'>Email Address</p>
          <p class='owner-details__values'>$pharmacy_owner_email</p>
          <p class='owner-details__attributes'>NIC</p>
          <p class='owner-details__values'>$pharmacy_nic</p>
          <p class='owner-details__attributes'>Mobile Number</p>
          <p class='owner-details__values'>$pharmacy_mobile</p>
          <p class='owner-details__attributes'>Address</p>
          <p class='owner-details__values'>$pharmacy_address</p>

      </div>
 </div>


       "; }?>


</div>


