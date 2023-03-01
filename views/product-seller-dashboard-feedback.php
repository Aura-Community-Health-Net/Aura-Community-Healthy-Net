<?php
/**
 * @var array $feedback_from_consumers
 */
?>

<div class="product-seller-feedback__container">
    <?php
    if(empty($feedback_from_consumers)){
        echo "
        <div class='no-feedback'>
            No feedback yet
        </div>
        ";
    } else{
        foreach ($feedback_from_consumers as $feedback_from_consumer){
            $consumer_image = $feedback_from_consumer['profile_picture'];
            $consumer_name = $feedback_from_consumer['name'];
            $date_time = $feedback_from_consumer['date_time'];
            $feedback_text = $feedback_from_consumer['text'];
            echo "
        <div class='product-seller-feedback'>
        <div class='product-seller-feedback__details'>
            <div>
                <img class='product-seller-orders-profile-pic' src='$consumer_image' alt=''>
                <h3>$consumer_name</h3>
            </div>
            <h4>$date_time</h4>


        </div>
        <p>$feedback_text</p>
    </div>
        ";
        }
    }
    ?>
</div>
