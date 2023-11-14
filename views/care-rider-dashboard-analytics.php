<?php
/**
 * @var array $new_request
 */
?>
<head>
    <title>Analytics</title>
</head>

<div class="care-rider-analytics-container">
    <select class="care-rider-analytics-dropdown" name="" id="care-rider-analytics-dropdown">
        <option value="this_week">This Week</option>
        <option value="this_month">This Month</option>
        <option value="past_six_months">Past six months</option>
        <option value="all_time">All</option>
    </select>



    <div class="care-rider-chart">

        <canvas id="care-rider-request-count-chart"></canvas>
    </div>

    <div class="care-rider-revenue-chart">
        <canvas  id="care-rider-revenue-chart"></canvas
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>


<script src="/assets/js/pages/care-rider-analytics.js"></script>
