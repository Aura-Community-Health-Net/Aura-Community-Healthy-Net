<?php
/**
 * @var $feedback ;
 */

?>

<head>
    <link rel="stylesheet" href="/assets/css/main.css">
    <title>Care-Rider-Feedbacks</title>
</head>
<div class="care-rider-feedbacks">


    <?php
    if (empty($feedback)) {
        echo "<div class='Not-verified-care-rider-feedback'>No Feedback Yet </div>";
    } else {
    foreach ($feedback as $value) { ?>
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

    <?php } } ?>


</div>
