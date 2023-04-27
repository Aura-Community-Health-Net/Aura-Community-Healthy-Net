<?php
/**
 * @var array $services
 */

?>

<div class="dashboard__top-container">
    <div class="dashboard__top-cards">
        <h3>Past Services List</h3>

        <?php
        foreach ($services as $service){
            $profile_picture = $service['profile_picture'];
            $name = $service['name'];
            $mobile_number = $service['mobile_number'];
            $provider_type = $service['provider_type'];
            $email_address = $service['email_address'];
            $service_date = $service['date_time'];

            echo "
            <div class='dashboard__top-cards__detail'>
            <img class='order-consumer-img' src='$profile_picture' alt=''>
            <div>
                <h4>$name</h4>
                <h5>$mobile_number</h5>
            </div>
            <h4>$provider_type</h4>
            <h4>$email_address</h4>
            <h4>$service_date</h4>
        </div>
            ";
        }

        ?>
    </div>
</div>

<div class="dashboard__bottom-container">
    <div class="dashboard__bottom-cards">
<!--        <h3>New Orders</h3>-->
<!--        <div class="dashboard__bottom-cards__detail">-->
<!--            <img class="dashboard__bottom-product-img" src="/assets/images/nil-veralu.jfif" alt="">-->
<!--            <h4>Nil Veralu</h4>-->
<!--            <h4>Medicinal Fruits & Vegetables</h4>-->
<!--            <h4>100 g</h4>-->
<!--            <h4>Rs. 150</h4>-->
<!--        </div>-->
<!---->
<!--        <div class="dashboard__bottom-cards__detail">-->
<!--            <img class="dashboard__bottom-product-img" src="/assets/images/vali%20anoda.jfif" alt="">-->
<!--            <h4>Vali Anoda</h4>-->
<!--            <h4>Medicinal Fruits & Vegetables</h4>-->
<!--            <h4>1 kg</h4>-->
<!--            <h4>Rs. 550</h4>-->
<!--        </div>-->
<!---->
<!--        <div class="dashboard__bottom-cards__detail">-->
<!--            <img class="dashboard__bottom-product-img" src="/assets/images/belimal.webp" alt="">-->
<!--            <h4>Beli Mal</h4>-->
<!--            <h4>Seeds</h4>-->
<!--            <h4>100 g</h4>-->
<!--            <h4>Rs. 350</h4>-->
<!--        </div>-->

<!--        <div class="dashboard__bottom-cards__detail">-->
<!--            <img class="dashboard__bottom-product-img" src="/assets/images/porridge.jfif" alt="">-->
<!--            <h4>Vegetable Porridge</h4>-->
<!--            <h4>Cooked Foods</h4>-->
<!--            <h4>1 l</h4>-->
<!--            <h4>Rs. 550</h4>-->
<!--        </div>-->
        <div class="calender_container">
            <div class="calender">
                <div class="calender_header">
                    <span class="month-picker" id="month-picker"> May </span>
                    <div class="year-picker" id="year-picker">
                        <span class="year-change" id="pre-year">
                            <pre><</pre>
                        </span>
                        <span id="year">2023</span>
                        <span class="year-change" id="next-year">
                            <pre>></pre>
                        </span>
                    </div>
                </div>

                <div class="calender-body">
                    <div class="calender-week-days">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                </div>
                <div class="calender-footer">

                </div>

                <div class="date-time-format">TODAY</div>
                <div class="date-time-value">
                    <div class="time-format">02:51:24</div>
                    <div class="date-format">25 - April - 2023</div>
                </div>
            </div>
            <div class="month-list"></div>
        </div>
    </div>

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

    <div class="dashboard__bottom-cards">
        <h3>Analytics</h3>
        <img class="dashboard-analytics-img" src="/assets/images/dashboard-analytics.jpg" alt="">
        <div class="dashboard-analytics-description">
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                Ipsum has been the </p>
        </div>
    </div>

</div>

