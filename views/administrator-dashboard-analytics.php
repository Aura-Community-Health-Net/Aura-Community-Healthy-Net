<div class="administrator-analytics__container">
    <select class="administrator-analytics-dropdown" name="" id="administrator-analytics-dropdown">
        <option value="this_week">This Week</option>
        <option value="this_month">This Month</option>
        <option value="past_six_months">Past six months</option>
        <option value="all_time">All</option>
    </select>

    <!--    <div class="product-seller-analytics-chart__title">-->
    <!--        <h3>Order Count Chart</h3>-->
    <!--        <h3>Product Vs Revenue</h3>-->
    <!--    </div>-->

    <div class="administrator-analytics__top-container">
        <canvas id="admin-doctor-revenue-chart" class="admin-revenue-chart"></canvas>
        <canvas id="admin-pharmacy-revenue-chart" class="admin-revenue-chart"></canvas>
    </div>

    <div class="administrator-analytics__top-container">
        <canvas id="admin-product-seller-revenue-chart" class="admin-revenue-chart"></canvas>
        <canvas id="admin-care-rider-revenue-chart" class="admin-revenue-chart"></canvas>
    </div>



</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>

<script src="/assets/js/pages/administrator-analytics.js"></script>