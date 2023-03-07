<?php
/**
 * @var $care_rider ;
 * @var $time_slot ;
 * @var $feedback ;
 */
if (!isset($_GET['care-rider-feedback-btn'])) {
    $provider_nic = $_GET['provider_nic'];
}

/*if (!isset($_GET['doctor-pay-btn'])){
    $provider_nic = $_GET['provider_nic'];
}*/
//print_r($feedback);die();
//print_r($time_slot);die();
//print_r($doctor);die();
?>
<link rel="stylesheet" href="/assets/css/main.css" xmlns="http://www.w3.org/1999/html">
<div class="consumer-dashboard-doctor-profile">
    <div class="consumer-dashboard-doctor-profile__top">
        <table>
            <tr>
                <td>
                    <div class="consumer-dashboard-doctor-profile__top__left">
                        <div class="item-top-left__container">
                            <img src="<?php echo $care_rider[0]['profile_picture']; ?>" alt="">
                            <div class="provider__overview-detail">
                                <h2><?php echo($care_rider[0]['name']) ?></h2>
                                <h3>Type of Vehicle:<?php echo($care_rider[0]['type']); ?></h3>
                                <h3>color:<?php echo($care_rider[0]['color']); ?></h3>
                                <h3>No-Plate:<?php echo($care_rider[0]['number_plate']); ?>4</h3>
                                <h3>MobileNo:<?php echo($care_rider[0]['mobile_number']); ?>7</h3>
                            </div>
                        </div>


                    </div>
                </td>
                <td>
                    <div class="consumer-dashboard-care-rider-profile__top__right">

                        <div class="item-top-right__container">
                            <div class="map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d270201.1012553059!2d80.57066973934896!3d7.435740318327426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1668671876514!5m2!1sen!2slk"
                                        width="400" height="250" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade" frameborder="0"></iframe>
                            </div>
                            <form class="pickup-time-form" action="">
                                <label for="">Pick up time</label>
                                <input type="time">
                            </form>
                            <button class="btn"><a href="/consumer-dashboard/services/care-rider/request/payment">Continue
                                    to Pay</a></button>

                        </div>

                    </div>
    </div>
    </td>
    </tr>
    </table>
</div>
<div class="consumer-dashboard-doctor-profile__bottom">
    <table>
        <tr>
            <td>
                <div class="consumer-dashboard-doctor-profile__bottom__left">
                    <?php foreach ($feedback as $value) { ?>
                        <div class="consumer-dashboard-doctor-profile__bottom__left__data">
                            <img src="<?php echo $value['profile_picture']; ?>" alt="">
                            <h3><b><?php echo $value['name'] ?></b></h3>
                            <h4><?php echo $value['date_time'] ?></h4>
                            <p><?php echo $value['text'] ?></p>
                        </div>
                    <?php } ?>
                </div>
            </td>
            <td>
                <div class="consumer-dashboard-doctor-profile__bottom__right">
                    <h3>Give your Feedback</h3>
                    <form action="/consumer-dashboard/services/care-rider/request/feedback" method="get">
                        <input type="datetime-local" name="feedback-datetime" class="doctor-feedback-datetime">
                        <input type="text" name="feedback-msg" class="doctor-feedback">
                        <input name="provider_nic" value="<?php echo $provider_nic ?>" type="text" hidden>
                        <button name="care-rider-feedback-btn">Submit</button>
                    </form>
                </div>
            </td>
        </tr>
    </table>

</div>
<script src="/assets/js/pages/timeslots.js"></script>
</div>
