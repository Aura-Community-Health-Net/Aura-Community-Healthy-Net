<?php
/**
 * @var array $pharmacy
 * @var array $orders
 * @var string $title
 * @var string $active_link
 */
?>


<div class="pharmacy-neworders">
   <div class="pharmacy-neworders-main-block">

       <?php
       if (empty($orders)) {
           echo "
        <div class='no-feedback'>
            No New Requests yet
        </div>
        ";
       }
       ?>


       <?php
       foreach ($orders as $order) {



           $consumer_profilepic = $order["profile_picture"];
           $consumer_name = $order["name"];
           $consumer_mobile = $order["mobile_number"];
           $prescription = $order["prescription"];
           $id = $order["request_id"];
           echo "
       <div class='pharmacy-neworders-blocks'>

      
           
           
                 <div class='pharmacy-neworders-blocks__consumer-details'>
                       <div class='consumer-details__profile_picture'>
                               <img class='consumer-profile' src='$consumer_profilepic' alt='consumer-profile'>
                       </div>
                       <div class='consumer-details__identity'>
                            <div class='consumer-details__identity__consumer-name'>
                                 <p>$consumer_name</p>
                            </div>
                            <div class='consumer-details__identity__contactNo'>
                                 <p>$consumer_mobile</p>
                            </div>
                       </div>
                 </div>
                <div class='pharmacy-neworders-blocks__prescription'>
                      <div class='prescription_info'>
                           <div class='prescription_title'>Prescription</div>
                           <div class='prescription_img'>
                                 <img class='pres_img' id='pres_img' src='$prescription' alt='prescription' onclick='change(this)'>
                           </div>
                      </div>
                </div>
                
             
               <div class='pharmacy-neworders-blocks__adinfo-btn'>
                       <button class='adinfo-btn' id='add-info'><a href='/pharmacy-dashboard/new-requests/view?id=$id'>Send Advance Info</a> </button>
               </div>
           
           
           
           
           
           
           
           
         

    </div>
    
                <div class='popup_image'>  
                     <span><i class='fa-regular fa-circle-xmark' style='color: #e73718;'></i></span>
                     <img src='$prescription' alt='prescription'>
                </div>
      ";
           } ?>
   </div>
</div>



<script src="/assets/js/pages/prescription.js"></script>