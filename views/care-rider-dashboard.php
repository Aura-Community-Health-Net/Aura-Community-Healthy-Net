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
 * @var $date ;
 * @var $care_rider_time_slot;
 *
 *
 */
//print_r($care_rider_time_slot);die();
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
            <h3  style="text-align: center;margin: 1rem;padding: 1rem;">New Requests List</h3>
            <table class="care-rider-appointment-list__item__scroll">
                <?php

                if ($request_confirm) {
                    foreach ($request_confirm as $value) { ?>
                        <tr class="care-rider-request-list__item">
                            <td><img src="<?php echo $value['profile_picture'] ?>" alt=""></td>
                            <td><h5><b><?php echo $value['name'] ?></b><br>
                                    <?php echo $value['mobile_number'] ?></h5></td>
                            <td><h4><?php echo $value['date'] ?></h4></td>
                            <!--                    <td><h4>--><?php //echo $value['address']?><!--</h4></td>-->

                        </tr>
                        <?php
                    }
                } else {
                    echo "
                    <h2 class='empty-product-orders'>No request yet</h2>
                    ";
                        }
                ?>

            </table>
            <div><a href='/care-rider-dashboard/new-requests'>
                    <button class="view-privious-request-button">All Requests
                    </button>
                </a></div>

        </div>
        <div class="care-rider-top-center">
            <h3 style="text-align: center;margin: 1rem;padding: 1rem;">Newest Request Preview</h3>
            <?php
              if ($request_details) {

                if ($count_request['COUNT(done)'] > 0) { ?>
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
                    <?php
                }
            } else {
                  echo " <h2  class='empty-product-orders'>No request yet</h2>";
              }

              ?>
        </div>
    </div>
    <div class="care-rider-bottom-container">
        <div class="care-rider-dashboard-bottom-left">
            <h3  style="text-align: center;margin: 1rem;padding: 1rem;">Request Count</h3>

            <div class="care-rider-request-details">
                <h3>New Requests</h3>
                <h1 style="color: #5BC849"><?php echo $count_request['COUNT(done)']; ?></h1>
            </div>
            <div class="care-rider-request-details">
                <h3>All Requests</h3>
                <h1 style="color: #FF0000"><?php echo $all_request['COUNT(done)']; ?></h1>
            </div>

        </div>
        <div class="care-rider-dashboard-bottom-right">
            <h3  style="text-align: center;margin: 1rem;padding: 1rem;">Analytics</h3>
            <div class="care-rider-analytics"><canvas id="revenue-chart">   </canvas>
            </div>
        </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>

<script>
    const revenueRideChartCanvas = document.querySelector("#revenue-chart");

    async function getRideRevenueData(period="this_month"){
        try{
            const result = await fetch("/care-rider-dashboard/analytics/revenue-chart?period=this_month");
            const data = await result.json();
            console.log(data)
            const dates = data.map((d)=> {
                return d.date;

            })
            const revenues = data.map((d)=> {
                return d.revenue;
            })

            revenueRideChart = new Chart(revenueRideChartCanvas, {
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




        } catch (e){
            console.log(e)
        }
    }
    window.addEventListener("load",async () => {
        await getRideRevenueData();

    })
</script>

