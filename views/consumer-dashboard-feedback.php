<?php
/**
 * @var $feedback ;
 */

?>
<div class="consumer-feedback__container">

    <?php foreach ($feedback as $value) { ?>
        <div class="consumer-feedback">
            <div class="consumer-feedback__details">
                <div>
                    <img class="consumer-profile" src="<?php echo $value['profile_picture']; ?>" alt="">
                    <h3><?php echo $value['name'] ?></h3>
                </div>
                <h4><?php echo $value['date_time'] ?></h4>
            </div>
            <p><?php echo $value['text'] ?> </p>
        </div>

    <?php } ?>

</div>




