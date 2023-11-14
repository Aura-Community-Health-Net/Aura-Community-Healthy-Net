<?php

/**
 * @var array $feedback
 * @var array $pharmacy
 * @var string $active_link
 */

?>




<div class="pharmacy-feedback__container">
    <div class="pharmacy-feedback">


        <?php
        if(empty($feedback)){
            echo " <div class='no-feedback'>
            No feedback yet
        </div>";
        }
        else{
        foreach ($feedback as $Feedback) {

            $name = $Feedback['name'];
            $date_time = $Feedback['date_time'];
            $text = $Feedback['text'];

            echo "
            <div class='pharmacy-feedback__details'>
                <div>
                    <img class='consumer-profile' src='/assets/images/profilepic4.jpg' alt=''>
                    <h3>$name</h3>
                </div>
                     <h4>$date_time</h4>


            </div>
                <p>$text</p>
           ";
        } } ?>


    </div>




</div>



