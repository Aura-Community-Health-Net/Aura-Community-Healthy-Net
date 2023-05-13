<?php
/**
 * @var array $services;
 * @var array $care_rider_services;
 * @var array $consumer;
 * @var $care_rider_provider_count;
 * @var $doctor_provider_count;
 * @var $pharmacy_provider_count;
 * @var $product_seller_provider_count;
 * @var $care_rider_provider_count;
 * @var $current_upcoming_details;
 * @var $upcoming_details;
 */


if (!$current_upcoming_details  AND $upcoming_details){
    return $upcoming_details;
}else{

?>

<head>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css' />
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js'></script>
    <script>

        $(document).ready(function() {
            $('#calendar').fullCalendar({
                dayClick: function(date, jsEvent, view) {
                    // create a form to submit selected date
                    var form = $('<form>').attr({
                        method: 'GET',
                        action: '/consumer-dashboard'
                    }).append(
                        $('<input>').attr({
                            type: 'hidden',
                            name: 'date',
                            value: date.format()
                        })
                    );
                    // append the form to the body and submit it
                    $('body').append(form);
                    form.submit();
                    console.log('Selected date: ' + date.format());
                }
            });
        });

    </script>
    <title></title>
</head>

<div class="dashboard__top-container">
    <div class="dashboard__top-cards">
        <h3>Services Count</h3>
        <div class="services-count__details">
            <h3>Doctor</h3>
            <p class="services-count"><?php echo $doctor_provider_count['COUNT(record_id)']; ?></p>
        </div>
        <div class="services-count__details">
            <h3>Pharmacy</h3>
            <p class="services-count"><?php echo $pharmacy_provider_count['COUNT(record_id)']; ?></p>
        </div>
        <div class="services-count__details">
            <h3>Product Seller</h3>
            <p class="services-count"><?php echo $product_seller_provider_count['COUNT(record_id)']; ?></p>
        </div>
        <div class="services-count__details">
            <h3>Care Rider</h3>
            <p class="services-count"><?php echo $care_rider_provider_count['COUNT(request_id)']; ?></p>
        </div>
    </div>


    <div class="dashboard__top-cards" style="width: 38%">
        <div id='calendar'></div>
<!--                <div class="calendar">-->
<!--            <div class="calendar-header">-->
<!--                <span class="month-picker" id="month-picker">February</span>-->
<!--                <div class="year-picker">-->
<!--                <span class="year-change" id="prev-year">-->
<!--                    <pre><</pre>-->
<!--                </span>-->
<!--                    <span id="year">2021</span>-->
<!--                    <span class="year-change" id="next-year">-->
<!--                    <pre>></pre>-->
<!--                </span>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="calendar-body">-->
<!--                <div class="calendar-week-day">-->
<!--                    <div>Sun</div>-->
<!--                    <div>Mon</div>-->
<!--                    <div>Tue</div>-->
<!--                    <div>Wed</div>-->
<!--                    <div>Thu</div>-->
<!--                    <div>Fri</div>-->
<!--                    <div>Sat</div>-->
<!--                </div>-->
<!--                <div class="calendar-days"></div>-->
<!--            </div>-->
<!--            <div class="calendar-footer">-->
<!--            </div>-->
<!--            <div class="month-list"></div>-->
<!--        </div>-->
<!---->
    </div>

    <div class="dashboard__top-cards events-container">
        <h3 class="events-header">Events for this day</h3>
        <?php if(!$current_upcoming_details) { ?>
        <div class="events-container__empty">
            <i class="fa-regular fa-calendar-days events-icon"></i>
            <h4 class="no-events">No upcoming events due</h4>
        </div>
        <?php }else{?>
        <div class="doc_upcoming_details_scroll_bar">
            <?php if(!$upcoming_details){?>
                    <?php foreach ($current_upcoming_details as $value){ ?>
                            <div class="doc_upcoming_details">
                                <div style="display: flex;flex-direction: row;gap: 1.5rem">
                                    <img src="<?php echo $value['profile_picture']?>" alt="">
                                    <div style="display: flex; flex-direction: column;justify-content: center;">
                                        <h4><?php echo $value['name']; ?></h4>
                                        <h5><?php echo $value['provider_type'];?></h5>
                                    </div>
                                </div>
                                <div style="display: flex;gap: 1.5rem;flex-direction: row;">
                                    <h4><?php echo $value['date'];?></h4>
                                    <h4><?php echo $value['from_time']." - ".$value['to_time'];?></h4>
                                </div>
                            </div>
                    <?php } ?>
            <?php }else{?>
                    <?php foreach ($upcoming_details as $value){ ?>
                        <div class="doc_upcoming_details">
                            <div style="display: flex;flex-direction: row;gap: 1.5rem">
                                <img src="<?php echo $value['profile_picture']?>" alt="">
                                <div style="display: flex; flex-direction: column;justify-content: center;">
                                    <h4><?php echo $value['name']; ?></h4>
                                    <h5><?php echo $value['provider_type'];?></h5>
                                </div>
                            </div>
                            <div style="display: flex;gap: 1.5rem;flex-direction: row;">
                                <h4><?php echo $value['date'];?></h4>
                                <h4><?php echo $value['from_time']." - ".$value['to_time'];?></h4>
                            </div>
                        </div>
                    <?php } ?>
            <?php } ?>
        </div>
        <?php }?>
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

            foreach ($care_rider_services as $care_rider_service){
                $profile_picture = $care_rider_service['profile_picture'];
                $name = $care_rider_service['name'];
                $mobile_number = $care_rider_service['mobile_number'];
                $provider_type = $care_rider_service['provider_type'];
                $email_address = $care_rider_service['email_address'];
                $care_rider_services_date_time = $care_rider_service['date'];
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

<?php } ?>