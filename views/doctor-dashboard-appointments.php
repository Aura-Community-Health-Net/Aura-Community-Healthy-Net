<?php
/**
 * @var array $appointments
 * @var array $doctor
 * @var array $appointments_details
 */
//$provider_nic = $_SESSION['nic'];


//print_r($appointments_details[0]['location']);
$done = 1;
?>

<div class="doctor-appointments_container" xmlns="http://www.w3.org/1999/html">
    <div class="doctor-appointments__left__container">
        <table>
            <tr>
                <th>Profile pic</th>
                <th>Name</th>
                <th>Time Slot</th>
                <th>Mobile No</th>
                <th>Location</th>
            </tr>
        </table>

        <div class="doctor-appointments__left__background">
            <?php foreach ($appointments_details as $value) {

                $location = json_decode($value['location']);
                $lat = $location->lat;
                $lng = $location->lng;
//                var_dump($lat, $lng);

                ?>
                <div class="doctor-appointments__left">
                    <form method="post">
                        <div class="doctor-appointments__left__data">
                            <img src="<?php echo $value['profile_picture']; ?>">
                            <p><?php echo $value['name']; ?></p>
                            <p><?php echo $value['from_time'] . " - " . $value['to_time']; ?></p>
                            <p><?php echo $value['mobile_number']; ?></p>
                            <!--                        <p>--><?php //echo json_decode($value['location'])?><!--</p>-->

                            <?php $appointment_id = $value['appointment_id'] ?>
                            <button style="" type="button" data-lat="<?= $lat ?>" data-lng="<?= $lng ?>"
                                    class="action-btn action-btn--location location-btn"><i
                                        class="fa-solid fa-location-dot"></i></button>
                        </div>
                        <div class="doctor-appointments__buttons-consulted">
                            <button value="Done"
                                    formaction="<?php echo "/doctor-dashboard/appointments-consulted?appointment_id=$appointment_id&id=$done" ?>"
                                    type="submit" style="background-color: #0002A1;align-items: center">Consulted
                            </button>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>


    <input name="destination-lat" id="destination-lat" type="hidden" style="opacity: 0">
    <input name="destination-lng" id="destination-lng" type="hidden" style="opacity: 0">
    <div class="doctor-appointments__right">
        <div class="map" id="map" style="height:500px;width: 400px;margin-inline: auto"></div>
    </div>

    <script src="/assets/js/pages/doctor-location.js"></script>
</div>