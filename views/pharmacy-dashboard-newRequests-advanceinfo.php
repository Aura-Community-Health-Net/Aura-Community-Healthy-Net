<?php
/**
 * @var array $pharmacy
 * @var array $available_med_details
 * @var string $title
 * @var string $active_link
 */

?>

<div class='pharmacy-neworders-advanceinfo'>

    <?php
    $consumer_name = $available_med_details["name"];
     $consumer_profile_pic = $available_med_details["profile_picture"];
     $consumer_mobile = $available_med_details["mobile_number"];
     $request_id = $available_med_details["request_id"];

     echo "
     
        <div class='pharmacy-neworders-advanceinfo__consumer-details'>

           <div class='consumer-details__image'>
               <img class='consumer-profile-pic' src='$consumer_profile_pic' alt='consumer-profile'>
           </div>
           <div class='consumer-details__details'>
              <div class='consumer-details__details__name'>
                <p>$consumer_name</p>
              </div>
              <div class='consumer-details__details__contact'>
                <p>$consumer_mobile</p>
              </div>
           </div>
      </div>
    
      ";
      ?>

         <div class="neworders-advanceinfo-submit-form-container">
             <form class="neworders-advanceinfo-submit-form" action="<?php  echo "/pharmacy-dashboard/new-requests/view?id=$request_id";?>" method="post">
                 <div class='pharmacy-neworders-advanceinfo__order-med-details'>
                     <div class='pharmacy-neworders-advanceinfo__order-med-details__names'>
                         <div class='pharmacy-neworders-advanceinfo__order-med-details__names__availableMedList'>
                             <p>Available Medicines List</p>
                         </div>
                         <div class='pharmacy-neworders-advanceinfo__order-med-details__names__TotalAmount'>
                             <p>Total Amount</p>
                         </div>
                         <div class='pharmacy-neworders-advanceinfo__order-med-details__names__AdvanceAmount'>
                             <p>Advance Amount</p>
                         </div>
                         <div class='pharmacy-neworders-advanceinfo__order-med-details__names__Note'>
                             <p>Note</p>
                         </div>
                     </div>

                     <div class='pharmacy-neworders-advanceinfo__order-med-details__description'>
                         <div class='pharmacy-neworders-advanceinfo__order-med-details__description__medicinesList'>
                             <!--                               <ul class='medicines_list'>-->
                             <!--                                     <li><input id='medicines_list' type='text' name='medicines_list' value='-->
                             <!--                               </ul>-->
                             <textarea name="medicines_list" class="pharmacy-request__text-area" placeholder="Please enter each medicine seperated with comma"></textarea>
                         </div>
                         <div class='pharmacy-neworders-advanceinfo__order-med-details__description__TotalAmount'>
                             <p><input id='total_amount' class="pharmacy-request__input" type='number' name='total_amount' value='<?php echo $_POST['total_amount'] ?? '';?>'  required ></p>
                         </div>
                         <div class='pharmacy-neworders-advanceinfo__order-med-details__description__AdvanceAmount'>
                             <p><input id='advance_amount' class="pharmacy-request__input" type='number' name='advance_amount' readonly required ></p>
                         </div>
                         <div class='pharmacy-neworders-advanceinfo__order-med-details__description__Note'>
                             <p><input id='note' class="pharmacy-request__input" type='text' name='note' value='<?php echo $_POST['note'] ?? '';?>'  required ></p>
                         </div>
                     </div>
                 </div>
                 <div class='pharmacy-neworders-advanceinfo__button'>
                     <button class='advance-info-submit-button' id='advance-info-submit-button'>Send </button>
                 </div>
             </form>

          </div>

</div>

<script>
    const total_amount_input = document.querySelector("#total_amount");
    const advance_amount_input = document.querySelector("#advance_amount");

    total_amount_input.addEventListener("input",e=>{
        advance_amount_input.value = Number(e.target.value)*0.3;
    })
</script>

