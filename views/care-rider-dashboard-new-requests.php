<?php
/**
 * @var array $requests
 * @var array $careRider
 * @var array $request_details
 */
//print_r($request_details);die();
$cancel = 1;
$confirm = 2;
?>
<div class="care-rider-new-requests_container">
    <div class="care-rider-new-requests__left__container">
        <table>
            <tr>
                <th>Profile Picture</th>
                <th>Name</th>
                <th>Date</th>
                <th>Time Slot</th>
                <th>Mobile No</th>
                <th>Location</th>
            </tr>

            <?php foreach ($request_details

            as $value1) {

            $from_location = json_decode($value1['from_location']);
            $from_lat = $from_location->lat;
            $from_lng = $from_location->lng;

            $to_location = json_decode($value1['to_location']);
            $to_lat = $to_location->lat;
            $to_lng = $to_location->lng;
            }
            ?>


            <div class="care-rider-new-requests__left">
                <form action="" method="post">

                            <?php foreach ($request_details as $value) {
                                $profile_picture = $value["profile_picture"];
                                $consumer_name = $value["name"];
                                $from_time = $value["from_time"];
                                $to_time = $value["to_time"];
                                $mobile_number = $value["mobile_number"];
                                $date = $value["date"];
                                $to_location = $value["to_location"];
                                $from_location = $value["from_location"];
                                $request_id = $value['request_id'];

                                echo "
                                    <tr class='care_rider-request__left__data'>
                                            <tr>
                                                    <td  ><img class='care-rider-new-requests__right__top' src='$profile_picture' alt=''></td>
                                                    <td class='care_rider-request-data'>$consumer_name</td>
                                                    <td class='care_rider-request-data'>$date</td>
                                                    <td class='care_rider-request-data'>$from_time - $to_time</td>
                                                    <td class='care_rider-request-data'>$mobile_number</td>    
                                                    <td>
                                                        <button style='background-color: #EFEEFD;;color: black' type='button'> 
                                                                        <i class='fa-solid fa-location-dot'></i>
                                                        </button>
                                                    </td> 
                                             </tr>
                                             <tr>
                                                    <td>
                                                        <button class='btn' id='cancel-btn' value='Cancel'
                                                                formaction='/care-rider-dashboard/request-conform-cancel?request_id=$request_id & id=$cancel'
                                                                type='submit' style=background-color: #0002A1>Cancel
                                                        </button>
                                                    </td>
                                                    <td>
                                                        <button class='btn' id='confirm-btn' value='Confirm'
                                                                formaction='/care-rider-dashboard/request-conform-cancel?request_id=$request_id & id=$confirm'
                                                                type='submit' style='background-color: #00005C'>Confirm
                                                        </button>
                                                    </td>
                                                                                                  
                                            </tr>
                                    </tr>
                            ";
                                }
                                ?>
                </form>
        </table>
    </div>


    <div>



    </div>





    <input name="destination-lat" id="destination-lat" type="hidden" style="opacity: 0">
    <input name="destination-lng" id="destination-lng" type="hidden" style="opacity: 0">
    <div class="doctor-appointments__right">
        <div class="map" id="map"
             style="height:500px;width: 350px;margin-inline: auto;left: 50px;margin-top: 50px;"></div>
    </div>

    <script src="/assets/js/pages/care-rider-location.js"></script>

</div>

