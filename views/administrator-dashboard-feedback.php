<?php
/**
 * @var array $feedback_from_providers
 */
?>

<div class="administrator-feedback__container">
    <?php
    if (empty($feedback_from_providers)){
        echo "
        <div class='no-feedback'>
        No feedback yet
        </div>
        ";
    } else {
        foreach ($feedback_from_providers as $feedback_from_provider) {
            $provider_image = $feedback_from_provider['profile_picture'];
            $provider_name = $feedback_from_provider['name'];
            $provider_type = $feedback_from_provider['provider_type'];
            $date_time = $feedback_from_provider['date_time'];
            $feedback_text = $feedback_from_provider['text'];
            echo "
            <div class='administrator-feedback'>
        <div class='administrator-feedback__details'>
            <div class='administrator-feedback-header'>
                <img class='product-seller-orders-profile-pic' src='$provider_image'  alt=''>
                <div class='administrator-feedback-profile'>
                    <h3>$provider_name</h3>
                    <p>$provider_type</p>
                </div>

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
