<?php
/**
 * @var array $services
 */

?>

<div class="dashboard__top-container">
    <div class="dashboard__top-cards">
        <h3>Services Count</h3>
        <div class="services-count__details">
            <h3>Doctor</h3>
            <p class="services-count">5</p>
        </div>
        <div class="services-count__details">
            <h3>Pharmacy</h3>
            <p class="services-count">4</p>
        </div>
        <div class="services-count__details">
            <h3>Product Seller</h3>
            <p class="services-count">2</p>
        </div>
        <div class="services-count__details">
            <h3>Care Rider</h3>
            <p class="services-count">0</p>
        </div>
    </div>


    <div class="dashboard__top-cards">
        <div class="calendar">
            <div class="calendar-header">
                <span class="month-picker" id="month-picker">February</span>
                <div class="year-picker">
                <span class="year-change" id="prev-year">
                    <pre><</pre>
                </span>
                    <span id="year">2021</span>
                    <span class="year-change" id="next-year">
                    <pre>></pre>
                </span>
                </div>
            </div>
            <div class="calendar-body">
                <div class="calendar-week-day">
                    <div>Sun</div>
                    <div>Mon</div>
                    <div>Tue</div>
                    <div>Wed</div>
                    <div>Thu</div>
                    <div>Fri</div>
                    <div>Sat</div>
                </div>
                <div class="calendar-days"></div>
            </div>
            <div class="calendar-footer">
            </div>
            <div class="month-list"></div>
        </div>
    </div>

    <div class="dashboard__top-cards events-container">
        <h3 class="events-header">Events for this day</h3>
        <div class="events-container__empty">
            <i class="fa-regular fa-calendar-days events-icon"></i>
            <h4 class="no-events">No upcoming events due</h4>
        </div>
    </div>

</div>


<div>
    <div class="dashboard__bottom-cards past-services">
        <div class="dashboard__top-cards">
            <h3>Past Services List</h3>

            <?php
            foreach ($services as $service){
                $profile_picture = $service['profile_picture'];
                $name = $service['name'];
                $mobile_number = $service['mobile_number'];
                $provider_type = $service['provider_type'];
                $email_address = $service['email_address'];
                $service_date_time = $service['date_time'];
                $service_date = explode(" ", $service_date_time)[0];
                echo "
            <div class='dashboard__top-cards__detail'>
            <img class='order-consumer-img' src='$profile_picture' alt=''>
            <div>
                <h4>$name</h4>
                <h5>$mobile_number</h5>
            </div>
            <h4>$provider_type</h4>
           
            <h4 class='dashboard__top-cards_email'>$email_address</h4>
            <h4>$service_date</h4>
            
            
        </div>
            ";
            }

            ?>
        </div>
    </div>

</div>

<script src="/assets/js/components/calendar.js"></script>