<?php
/**
 * @var array $care_rider
 * @var string $active_link
 * @var $request_confirm ;
 * @var $request_done ;
 * @var $new_request ;
 * @var $all_request ;
 * @var $request_details ;
 * @var $count_request ;
 * @var $date;
 */
/*var_dump($request_details);
die();*/
if (!$care_rider['is_verified']) {
    echo "<div class='empty-registrations'> <p>You're not verified yet. Please check later.</p></div>";
}


?>

<!DOCTYPE html>
<head>
    <title>Page Title</title>

</head>
<body>
<div style="margin: 2rem;">
<div class="care-rider-top-container">
    <div class="care-rider-top-left">
        <h3 style="text-align: center;margin-top: 1rem">New Requests List</h3>
        <table class="appointment-list__item__scroll">
            <?php foreach ($request_confirm as $value) { ?>
                <tr class="care-rider-request-list__item">
                    <td><img src="<?php echo $value['profile_picture'] ?>" alt=""></td>
                    <td><h5><b><?php echo $value['name'] ?></b><br>
                            <?php echo $value['mobile_number'] ?></h5></td>
                    <td><h4><?php echo $request_details['date'] ?></h4></td>
                    <!--                    <td><h4>--><?php //echo $value['address']?><!--</h4></td>-->
                    <!--                    <td><i class="fa-solid fa-location-dot"></i></td>-->
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="care-rider-top-center">
        <h3 style="text-align: center;margin-top: 1rem">Request</h3>
        <?php if ($count_request['COUNT(done)'] > 0) { ?>
            <div class="care-rider-dashboard__request">
                <div class="care-rider-dashboard__request__profile">
                    <div>
                        <img src=" <?php echo $request_details['profile_picture']; ?>">
                    </div>
                    <div>
                        <h4><b> <?php echo $request_details['name']; ?></b></h4>
                        <h5> <?php echo $request_details['mobile_number']; ?></h5>
                    </div>
                </div>
                <div class="care-rider-order-details">
                    <div>
                        <h5>Date</h5>
                        <h5><?php echo $request_details['MAX(care_rider_time_slot.date)']; ?> </h5>
                    </div>
                    <div>
                        <h5>Time</h5>
                        <h5><?php echo $date['time']; ?></h5>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<div class="care-rider-bottom-container">
    <div class="care-rider-dashboard-bottom-left">
        <h3 style="text-align: center;margin-top: 1rem">Request Count</h3>
        <div class="care-rider-request-details">
            <h3>New Requests</h3>
            <h1 style="color: #5BC849"><?php echo $new_request['COUNT(done)']; ?></h1>
        </div>
        <div class="care-rider-request-details">
            <h3>All Requests</h3>
            <h1 style="color: #FF0000"><?php echo $all_request['COUNT(done)']; ?></h1>
        </div>

    </div>
    <div class="care-rider-dashboard-bottom-right">
        <h3 style="text-align: center;margin-top: 1rem" >Analytics</h3>
        <img src="/assets/images/analytics_graph.png">
        <div class="doctor-dashboard__analytics">
            <p style="text-align: center;"> Lor Lorem Ipsum is simply dummy text<br> of the printing and text of the printing<br> and type setting
                industry.</p>
        </div>
    </div>
</div>
</div>
</body>