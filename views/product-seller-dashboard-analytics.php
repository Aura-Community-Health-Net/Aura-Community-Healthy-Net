<div class="product-seller-analytics__container">
    <select class="products-seller-analytics-dropdown" name="" id="product-analytics-dropdown">
        <option value="this_week">This Week</option>
        <option value="this_month">This Month</option>
        <option value="past_six_months">Past six months</option>
        <option value="all_time">All</option>
    </select>

<!--    <div class="product-seller-analytics-chart__title">-->
<!--        <h3>Order Count Chart</h3>-->
<!--        <h3>Product Vs Revenue</h3>-->
<!--    </div>-->

    <div class="product-seller-analytics__top-container">
        <canvas id="order-count-chart" class="order-count-chart"></canvas>
        <canvas id="product-vs-revenue-chart" class="product-vs-revenue-chart"></canvas>
    </div>

    <h3>Revenue</h3>
    <canvas id="product-revenue-chart" class="revenue-chart"></canvas>


</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>

<script src="/assets/js/pages/product-seller-analytics.js"></script>