<?php
/**
 * @var $doctor
 */
?>
<head>
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Analytics</title>
</head>

<?php if(!$doctor['is_verified']) {?>
    <div class="not-verified-doctor-timeslot"><h2>No Records yet</h2></div><?php } else {?>

<div class="doctor-analytics__container">
    <select class="doctor-analytics-dropdown" name="" id="doctor-analytics-dropdown">
        <option value="this_week">This Week</option>
        <option value="this_month">This Month</option>
        <option value="past_six_months">Past six months</option>
        <option value="all_time">All</option>
    </select>

    <!--    <div class="product-seller-analytics-chart__title">-->
    <!--        <h3>Order Count Chart</h3>-->
    <!--        <h3>Product Vs Revenue</h3>-->
    <!--    </div>-->

    <div class="doctor-analytics__top-container">
        <canvas id="appointment-count-chart" class="appointment-count-chart"></canvas>
    </div>

    <h3>Revenue</h3>
    <canvas id="revenue-chart" class="revenue-chart"></canvas>


</div>
<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>

<script src="/assets/js/pages/doctor-analytics.js"></script>
