<?php
/**
 *@var array $product_seller
 *@var string $active_link
 * @var array $product_lists
 * @var array $new_orders_count
 * @var array $all_orders_count
 * @var array $orders_list
 * @var array $order_preview
 */

if (!$product_seller['is_verified']) {
    echo "<div class='empty-registrations'> <p>You're not verified yet. Please check later.</p></div>";
}
if ($order_preview){
    $latest_profile_picture = $order_preview["profile_picture"];
    $latest_consumer_name = $order_preview["consumer_name"];
    $latest_mobile_number = $order_preview["mobile_number"];
    $latest_product_name = $order_preview["name"];
    $latest_quantity = $order_preview["quantity"];
    $latest_quantity_unit = $order_preview["quantity_unit"];
    $latest_product_image = $order_preview["image"];
    $latest_order_date = $order_preview["created_at"];
}


?>

<div class="dashboard__top-container">
    <div class="dashboard__top-cards">
        <h3>New Orders</h3>

        <?php
        if ($orders_list){
            foreach ($orders_list as $order_list){
                $profile_picture = $order_list['profile_picture'];
                $consumer_name = $order_list['consumer_name'];
                $product_name = $order_list['name'];
                $order_date = $order_list['created_at'];

                echo "
            <div class='dashboard__top-cards__detail'>
            <img class='order-consumer-img' src='$profile_picture' alt=''>
            
            <div>
                <h4>$consumer_name</h4>
                <h5>$product_name</h5>
            </div>
             <h5>$order_date</h5>
        </div>
            ";


            }
        } else {
            echo "
                <h2 class='empty-product-orders'>No orders yet</h2>
                ";
        }

        ?>

        <a href='/product-seller-dashboard/orders'>
            <button class="all-orders-btn">All Orders</button>
        </a>
    </div>

    <div class="dashboard__top-cards">
        <h3>Newest order preview</h3>

        <?php
        if ($order_preview){
            echo "
        <div class='dashboard__top-cards__info'>
            <div class='dashboard__top-cards__detail'>
                <img class='order-consumer-img' src='$latest_profile_picture' alt=''>
                <div>
                    <h4>$latest_consumer_name</h4>
                    <h5>$latest_mobile_number</h5>
                </div>
                
            </div>

            <div class='product-order-details'>
                <h5>$latest_product_name</h5><br>
                <h5>$latest_quantity $latest_quantity_unit</h5>
                <h5>$latest_order_date</h5>
            </div>
            
            <img class='order-product-img' src='$latest_product_image' alt=''>
        </div>
        ";
        } else{
            echo "
                <h2 class='empty-product-orders'>No orders yet</h2>
                ";
        }

        ?>

    </div>

    <div class='dashboard__top-cards'>
        <h3>Orders Count</h3>
        <div class='order-count__details'>
            <?php
        foreach ($new_orders_count as $order){
        $order_count = $order["order_count"];
        echo "
            <h3>New Orders</h3>
            <p class='new-order-count'>$order_count</p>
        </div>
    
        ";
    }
    ?>
    <?php
    foreach($all_orders_count as $all_order){
        $all_order_count = $all_order["all_order_count"];
        echo "
        <div class='order-count__details'>
            <h3>All Orders</h3>
            <p class='all-order-count'>$all_order_count</p>
        </div>
        ";
    }

    ?>

        </div>

</div>

<div class="dashboard__bottom-container">
    <div class="dashboard__bottom-cards">
        <h3>Products List</h3>

            <?php
            if ($product_lists){
                foreach ($product_lists as $product_list){
                    $product_image = $product_list['image'];
                    $product_name = $product_list['name'];
                    $category_name = $product_list['category_name'];
                    $product_quantity = $product_list['quantity'];
                    $product_quantity_unit = $product_list['quantity_unit'];
                    $product_price = $product_list['price']/100;

                    echo "
                <div class='dashboard__bottom-cards__detail'>
                <img class='dashboard__bottom-product-img' src='$product_image' alt=''>
                <h4 class='dashboard__top-cards__data2'>$product_name</h4>
                <h4 class='dashboard__top-cards__data2'>$category_name</h4>
                <h4 class='dashboard__top-cards__data1'>$product_quantity $product_quantity_unit</h4>
                <h4 class='dashboard__top-cards__data1'>Rs. $product_price</h4>
                </div>
           
                ";
                }
            } else{
                echo "
                <h2 class='empty-product-orders'>No products yet</h2>
                ";
            }

            ?>
        <a href='/product-seller-dashboard/categories'>
            <button class="all-products-btn">All Products</button>
        </a>

    </div>

    <div class="dashboard__bottom-cards" style="width: 500px">
        <h3>Analytics</h3>
        <canvas id="revenue-chart" class="revenue-chart" style="margin-top: 1rem"></canvas>
        <p class="dashboard__top-cards-analytics">Daily Revenue Chart of current week</p>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
    <script>
        const revenueChartCanvas = document.querySelector("#revenue-chart");

        async function getRevenueData(){
            try{
                const result = await fetch(`/product-seller-dashboard/analytics/revenue-chart?period=this_week`);
                const data = await result.json();
                console.log(data)
                const dates = data.map((d) => {
                    return d.date;
                })
                const revenues = data.map((d) => {
                    return Number(d.revenue)/100;
                })
                console.log(dates)
                console.log(revenues)
                console.log(Chart)

                revenueChart = new Chart(revenueChartCanvas, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: 'Revenue',
                            data: revenues,
                            borderColor: '#B71375',
                            backgroundColor: 'rgba(225, 18, 153, 0.5)',
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
            } catch (e){
                console.log(e)
            }

        }

        window.addEventListener("load", async () => {
            await getRevenueData();
        })
    </script>