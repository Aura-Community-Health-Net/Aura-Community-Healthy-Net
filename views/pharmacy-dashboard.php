<?php
/**
 * @var array $pharmacy
 * @var array $medicines
 * @var array $orders_counts
 * @var array $all_orders_count
 * @var array $medicines_orders_list
 * @var array $order_preview
 * @var string $active_link
 */

if (!$pharmacy['is_verified']) {
    echo "<div class='empty-registrations'> <p>You're not verified yet. Please check later.</p></div>";
}



?>

<div class="dashboard__top-container">
    <div class="dashboard__top-cards">
        <h3>New Orders</h3>
        <?php

        if ($medicines_orders_list) {

        foreach ($medicines_orders_list as $new_order) {

            $consumer_profile = $new_order["profile_picture"];
            $consumer_name = $new_order["consumer_name"];
            $mobile_number = $new_order["mobile_number"];
            $date = $new_order["created_at"];


            echo "
        <div class='dashboard__top-cards__detail'>
            <img class='order-consumer-img' src='$consumer_profile' alt=''>
            <div>
                <h4>$consumer_name</h4>
                <h5>$mobile_number</h5>
            </div>
            <div>
               <h5>$date</h5>
            </div>
        </div>
";

        }}
        else{
                echo "<h2 class= 'No_med_orders'>No Orders Yet</h2>";


        }?>

        <a href='/pharmacy-dashboard/orders'>
            <button class="all-orders-btn">All Orders</button>
        </a>

    </div>


    <div class="dashboard__top-cards">
        <h3>Newest Order Preview</h3>


        <?php

        if ($order_preview === null) {
            echo "<h2 class= 'No_med_orders'>No Orders Yet</h2>";
        } else {

            $consumer_name = $order_preview["consumer_name"];
            $consumer_profile = $order_preview["profile_picture"];
            $consumer_mobile = $order_preview["mobile_number"];
            $med_prescription = $order_preview["prescription"];
            $date = $order_preview["created_at"];


            echo "
        <div class='dashboard__top-cards__info'>
            <div class='dashboard__top-cards__detail'>
                <img class='order-consumer-img' src='$consumer_profile' alt=''>
                <div>
                    <h4>$consumer_name</h4>
                    <h5>$consumer_mobile</h5>
                   <h4>$date</h4>

                </div>
                
            </div>
            

            <div class='product-order-details'>
               <img class='order-product-img' src='$med_prescription' alt=''>

            </div>
        </div>

";
        }
        ?>

    </div>


         

    <div class='dashboard__top-cards'>
        <h3>Orders Count</h3>
        <div class='order-count__details'>
            <?php foreach ($orders_counts as $count) {
                $order_count = $count["order_count"];
                echo "
            <h3>New Orders</h3>
            <p class='new-order-count'>$order_count</p>
        </div>
        ";
            } ?>

            <?php foreach ($all_orders_count as $all_order){
                $all_orders_count = $all_order["all_order_count"];
                echo "     
        <div class='order-count__details'>
            <h3>All Orders</h3>
            <p class='all-order-count'>$all_orders_count</p>
        </div>";
            }
            ?>

    </div>


</div>

<div class="dashboard__bottom-container">
    <div class="dashboard__bottom-cards">
        <h3>Medicines List</h3>

        <?php
        if($medicines){
            foreach ($medicines as $medicine) {

                $med_image = $medicine['image'];
                $med_name = $medicine['name'];
                $med_price = $medicine['price']/100;
                $med_quantity = $medicine['quantity'];
                $med_quantity_unit = $medicine['quantity_unit'];

                echo "
             <div class='dashboard__bottom-cards__detail'> <img class='dashboard__bottom-product-img' src='$med_image' alt=''>
            <h4></h4>
            <h4>$med_name</h4>
            <h4>$med_quantity $med_quantity_unit</h4>
            <h4>Rs. $med_price</h4>
                  </div>";

            }
        }
        else{
            echo "<h2 class='empty-medicines-list'>No Medicines yet</h2>";
        }?>

        <a href='/pharmacy-dashboard/medicines'>
            <button class="all-products-btn">All Medicines</button>
        </a>


    </div>

    <div class="dashboard__bottom-cards">
        <h3>Analytics</h3>
        <canvas id="revenue-chart" class="revenue-chart" style="margin-top: 1rem"></canvas>
        <p class="dashboard__top-cards-analytics">Daily Revenue Chart of current week</p>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>

<script>

    const medRevenueChartCanvas = document.querySelector("#revenue-chart");

    async  function getMedRevenueData(period="this_month"){
        try{

            const result = await fetch(`/pharmacy-dashboard/analytics/revenue-chart?period=this_week`);
            const data = await result.json();
            console.log(data)
            const dates = data.map((d)=> {
                return d.date;
            })

            const revenues = data.map((d)=>{
                return Number(d.revenue)/100;
            })
            console.log(dates)
            console.log(revenues)
            console.log(Chart)

            medRevenueChart = new Chart(medRevenueChartCanvas, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Revenue',
                        data: revenues,
                        borderColor: 'rgb(20, 240, 60)',
                        backgroundColor: 'rgba(20, 240, 60, 0.5)',
                        fill: 'origin'
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        }catch (e){
            console.log(e)
        }
    }


    window.addEventListener("load", async () => {
        await getMedRevenueData();
    })










</script>
