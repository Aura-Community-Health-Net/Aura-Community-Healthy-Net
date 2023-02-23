
<?php
/**
 *@var array $care_rider
 *@var string $active_link
 */
if (!$care_rider['is_verified']) {
echo "<div class='empty-registrations'> <p>You're not verified yet. Please check later.</p></div>";
}

?>

<!DOCTYPE html>
<html>

    <link rel="stylesheet" href="/assets/css/main.css">
<div class="dashboard__top-container">
    <div class="dashboard__top-cards">
        <h3>New Requests List</h3>
        <div class="dashboard__top-cards__detail">
            <img class="order-consumer-img" src="/assets/images/profilepic1.jpg" alt="">
            <div>
                <h4>Lakisha Lakmini</h4>
                <h5>071-5275437</h5>
            </div>
        </div>

        <div class="dashboard__top-cards__detail">
            <img class="order-consumer-img" src="/assets/images/profilepic2.jpg" alt="">
            <div>
                <h4>Kamal Deshabandu</h4>
                <h5>075-3455667</h5>
            </div>
        </div>

        <div class="dashboard__top-cards__detail">
            <img class="order-consumer-img" src="/assets/images/profilepic3.jpg" alt="">
            <div>
                <h4>Samith Chathuranga</h4>
                <h5>071-3456789</h5>
            </div>
        </div>

        <div class="dashboard__top-cards__detail">
            <img class="order-consumer-img" src="/assets/images/profilepic4.jpg" alt="">
            <div>
                <h4>Kamani Ranathunga</h4>
                <h5>075-7896555</h5>
            </div>
        </div>
    </div>

    <div class="dashboard__top-cards">
        <h3>Request</h3>
        <div class="dashboard__top-cards__info">
            <div class="dashboard__top-cards__detail">
                <img class="order-consumer-img" src="/assets/images/profilepic1.jpg" alt="">
                <div>
                    <h4>Sachini Deshapriya</h4>
                    <h5>0726778767</h5>
                </div>
            </div>

            <div class="care-rider-order-details">
                <div>
                    <h5>Date</h5>
                    <h5>9th October 2023 </h5>
                </div>
                <div>
                    <h5>Time</h5>
                    <h5>12.00 pm</h5>
                </div>
            </div>
        </div>



    </div>

    <div class="dashboard__top-cards">
        <h3>Request Count</h3>
        <div class="order-count__details">
            <h3>New Requests</h3>
            <p class="new-order-count">15</p>
        </div>
        <div class="order-count__details">
            <h3>All Requests</h3>
            <p class="all-order-count">59</p>
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
