<?php
/**
 * @var array $requests
 * @var $care_rider
 * @var array $request_details
 */
//print_r($careRider);die();
//print_r($request_details[0]['from_location']);die();
$cancel = 1;
$confirm = 2;
?>
<div class="care_rider-request_container">
    <div class="care_rider-request__left__container">

        <table style="width:100%">
            <thead class="care_rider-request__left__head">
            <tr class="care_rider-request__left__data">
                <th style="width: 2.6999999999999993rem;">Profile</th>
                <th style="width: 5rem">Name</th>
                <th style="width: 5rem;">Time Slot</th>
                <th style="width: 6rem;">Date</th>
                <th style="width: 5rem">Mobile No</th>
                <th style="width: 3rem">Location</th>
            </tr>
            </thead>

            <?php
            if ($request_details)  {
                foreach ($request_details as $value) {
                    $profile_picture = $value["profile_picture"];
                    $consumer_name = $value["name"];
                    $from_time = $value["from_time"];
                    $to_time = $value["to_time"];
                    $mobile_number = $value["mobile_number"];
                    $date = $value["date"];
                    $to_location = $value["to_location"];
                    $from_location = $value["from_location"];
                    $request_id = $value['request_id'];

                    $from_location = json_decode($value['from_location']);
                    $from_lat = $from_location->lat;
                    $from_lng = $from_location->lng;

                    $to_location = json_decode($value['to_location']);
                    $to_lat = $to_location->lat;
                    $to_lng = $to_location->lng;

                    echo "
                        <tbody class='care_rider-request__left'>
                            <tr class='care_rider-request__left__data'>
                                <td><img class='care_rider-request__left__data__img' src='$profile_picture' alt=''></td>
                                <td><p>$consumer_name</p></td>
                                <td><p>$from_time  $to_time</p></td>
                                <td><p>$date</p></td>
                                <td><p>$mobile_number</p></td>    
                                <td>
                                    <button style='color: black; background-color: #FFFFFF' type='button' data-from_lat=$from_lat data-from_lng=$from_lng data-to_lat=$to_lat data-to_lng=$to_lng class='action-btn action-btn--location location-btn'> 
                                        <i class='fa-solid fa-location-dot'></i>
                                    </button>
                                </td> 
                            </tr>
                            
                                                     <tr class='care_rider-request__buttons-consulted'>
                                                     <form action='' method='post'>
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
                                                         </form>                                                 
                                                    </tr>
                                            </tbody>
                                    ";
                        }  }
            else {
                {
                    echo "<tbody class='care_rider-request__left'><tr><td colspan='6' class='Not-verified-care-rider-new-requests'>No Request Yet</td></tr></tbody>";
                }
            }
                                        ?>

                </table>

    </div>


    <div>



    </div>




<!---->
<!--    <input name="destination-lat" id="destination-lat" type="hidden" style="opacity: 0">-->
<!--    <input name="destination-lng" id="destination-lng" type="hidden" style="opacity: 0">-->
    <div class="care_rider-request__right">
        <div class="map" id="map" style="height:500px;width: 400px;margin-inline: auto"></div>
    </div>

    <script src="/assets/js/pages/care-rider-location.js"></script>

</div>

