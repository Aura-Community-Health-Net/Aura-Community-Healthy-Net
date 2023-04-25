<?php
/**
 * @var array $medicines
 * @var array $pharmacy
 * @var array $feedback_set
 */


$provider_id = $pharmacy['id'];
$provider_nic = $pharmacy['provider_nic'];
$provider_image = $pharmacy['profile_picture'];
$provider_name = $pharmacy['name'];
$pharmacy_name = $pharmacy['pharmacy_name'];
$pharmacist_regNo = $pharmacy['pharmacist_reg_no'];
$address = $pharmacy['address'];
//$med_image = $pharmacy['image'];
//$med_name = $pharmacy['name'];
//$med_quantity = $pharmacy['quantity'];
//$med_quantity_unit = $pharmacy['quantity_unit'];
//$med_price = $pharmacy['price'];


?>


<div class="item-top__container">
    <div class="item-top-left__container">

        <?php echo "
        <img src='$provider_image' alt=''>
        <div class='provider__overview-detail'>
            <h2>$provider_name</h2>
            <h3>$pharmacy_name</h3>
            <p>Reg No : $pharmacist_regNo</p>
            <p>$address</p>
        </div>";
        ?>

    </div>

    <div class="item-top-right__container">
        <form action="/consumer-dashboard/services/pharmacy/view?id=<?php echo $provider_id?>" class="form-item--search" method="get">
           <div class="search-bar">
            <input type="text" placeholder="Search Medicine..." name="query" id="query">
            <button href="" type="submit"><i class="fa fa-search"></i></button>

          </div>
        </form>

        <?php
        foreach ($medicines as $medicine) {

            $list_med_image = $medicine['image'];
            $list_med_name = $medicine['name'];
            $list_med_quantity = $medicine['quantity'];
            $list_med_quantity_unit = $medicine['quantity_unit'];
            $list_med_price = $medicine['price'];


            echo "    <div class='overview-items overview-medicine'>
            <img src='$list_med_image' alt=''>
            <div>
               <p class='overview-items__name'>$list_med_name </p>
               <p>$list_med_quantity  $list_med_quantity_unit</p>
               <p class='overview-items__price'>Rs. $list_med_price</p> 
            </div>
           
        </div>";

        }

        ?>


    </div>

</div>

<div class="item-bottom-container">
    <div class="item-bottom-left-container">
        <?php


        if (empty($feedback_set)) {
            echo "No Feedback yet";
        } else {

            foreach ($feedback_set as $feedback) {

                $feedback_profilepic = $feedback['profile_picture'];
                $feedback_consumerName = $feedback['name'];
                $feedback_date = $feedback['date_time'];
                $feedback_text = $feedback['text'];

                echo "
        
        <div class='consumer-feedback'>
            <div class='consumer-feedback__header'>

                <div class='consumer-feedback__header-profile'>
                    <img class='product-seller-orders-profile-pic' src='$feedback_profilepic' alt=''>
                    <h3>$feedback_consumerName</h3>
                </div>
                <h4>$feedback_date</h4>
            </div>
            <p class='consumer-dashboard__body'>
             $feedback_text
            </p>
        </div>";


            }
        }


        ?>
    </div>
    <div class='item-bottom-right-container'>
        <h3>Give your feedback</h3>
        <form action="<?php echo "/consumer-dashboard/services/pharmacy/view/feedback?id=$provider_id&provider_nic=$provider_nic"; ?>"
              method="post">
            <textarea class="feedback-textarea" name="pharmacy-feedback" id="" cols="28" rows="17"></textarea>
            <button class="btn">submit</button>
        </form>
    </div>
</div>


