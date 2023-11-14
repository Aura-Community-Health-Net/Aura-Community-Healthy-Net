
<div class="pharmacy-analytics__container">

    <select class="pharmacy-analytics-dropdown" name="" id="medicine-analytics-dropdown">
        <option value="this_week">This Week</option>
        <option value="this_month">This Month</option>
        <option value="past_six_months">Past six months</option>
        <option value="all_time">All</option>
    </select>


    <div class="pharmacy-analytics__top-container">
        <canvas id="order-count-chart" class="order-count-chart"></canvas>
    </div>

    <h3>Revenue</h3>
    <canvas id="revenue-chart" class="revenue-chart"></canvas>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>

<script src="/assets/js/pages/pharmacy-Analytics.js"></script>