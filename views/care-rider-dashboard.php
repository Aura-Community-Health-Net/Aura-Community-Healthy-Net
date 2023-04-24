
<?php
/**
 *@var array $care_rider
 *@var string $active_link
 * @var $request_confirm;
 * @var $request_done;
 * @var $new_request;
 * @var $all_request;
 * @var $request_details;
 * @var $count_request;

 */
/*var_dump($request_details);
die();*/
if (!$care_rider['is_verified']) {
echo "<div class='empty-registrations'> <p>You're not verified yet. Please check later.</p></div>";
}

?>

<!DOCTYPE html>
<html lang=""

    <link rel="stylesheet" href="/assets/css/main.css">
<!--<div class="dashboard__top-container">-->
<!--    <div class="dashboard__top-cards">-->
<!--        <h3>New Requests List</h3>-->
<!--        <div class="dashboard__top-cards__detail">-->
<!--            --><?php //foreach ($request_confirm as  $value) { ?>
<!--                <div class="appointment-list__item">-->
<!--                    <img src="--><?php //echo $value['profile_picture']?><!--">-->
<!--                    <h5><b>--><?php //echo $value['name']?><!--</b><br>-->
<!--                        --><?php //echo $value['mobile_number']?><!--</h5>-->
<!--                    <i class="fa-solid fa-location-dot"></i>-->
<!--                </div>-->
<!--        </div>-->
<!--        --><?php //} ?>
        <div class="doctor-dashboard">
            <div class="doctor-dashboard__left__top">
                <h3>New Appointment List</h3>
                <div class="appointment-list__item__scroll">
                    <?php foreach ($request_confirm as  $value) { ?>
                        <div class="appointment-list__item">
                            <img src="<?php echo $value['profile_picture']?>">
                            <h5><b><?php echo $value['name']?></b><br>
                                <?php echo $value['mobile_number']?></h5>
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                    <?php } ?>
                </div>
            </div>


    <div class="dashboard__top-cards">
        <h3>Request</h3>
        <?php if($count_request['COUNT(done)']>0){?>
        <div class="dashboard__top-cards__info">
            <div class="dashboard__top-cards__detail">
                <img class="order-consumer-img" src=" <?php echo $request_details['profile_picture'];?>" alt="">
                <div>
                    <h4><?php echo $request_details['name'] ;?></h4>
                    <h5><?php echo $request_details['mobile_number'] ;?></h5>
                </div>
            </div>

            <div class="care-rider-order-details">
                <div>
                    <h5>Date</h5>
                    <h5><?php echo " ". $request_details['MAX(care_rider_time_slot.date)'] ;?> </h5>
                </div>
                <div>
                    <h5>Time</h5>
                    <h5>12.00 pm</h5>
                </div>
            </div>
            <?php } ?>
        </div>



    </div>

    <div class="dashboard__top-cards">
        <h3>Request Count</h3>
        <div class="order-count__details">
            <h3>New Requests</h3>
            <h1 style="color: #5BC849"><?php echo $new_request['COUNT(done)'];?></h1>
        </div>
        <div class="order-count__details">
            <h3>All Requests</h3>
            <h1 style="color: #FF0000"><?php echo $all_request['COUNT(done)'];?></h1>
        </div>
    </div>
</div>

<div class="dashboard__bottom-container">
    <div class="dashboard__bottom-cards">
        <h3>Google Map</h3>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d270201.1012553059!2d80.57066973934896!3d7.435740318327426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1668671876514!5m2!1sen!2slk"
                    width="400" height="250" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0"></iframe>   </div>
    </div>
    <div class="dashboard__bottom-cards">
        <h3>Analytics</h3>
        <img class="dashboard-analytics-img" src="/assets/images/dashboard-analytics.jpg" alt="">
        <div class="dashboard-analytics-description">
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                Ipsum has been the </p>
        </div>
    </div>
</div>
