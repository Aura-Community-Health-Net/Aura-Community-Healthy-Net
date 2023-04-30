<?php
/**
 * @var array $appointments
 * @var array $doctor
 * @var array $appointments_details
 */
//$provider_nic = $_SESSION['nic'];


//print_r($appointments_details[0]);die();
$done = 1;
?>

<div class="doctor-appointments_container" xmlns="http://www.w3.org/1999/html">
    <div class="doctor-appointments__left__container">
        <form method="post">
                <table style="width:100%">
                    <thead class="doctor-appointments__left__head">
                            <tr class="doctor-appointments__left__data">
                                <th style="width: 2.6999999999999993rem;"  >Profile</th>
                                <th style="width: 5rem">Name</th>
                                <th style="width: 5rem;">Time Slot</th>
                                <th style="width: 6rem;">Date</th>
                                <th style="width: 5rem">Mobile No</th>
                                <th style="width: 3rem">Location</th>
                            </tr>
                    </thead>

<!--                <div class="doctor-appointments__left__background">-->

                    <?php foreach ($appointments_details as $value) { ?>

                        <?php $location = json_decode($value['location']);
                        $lat = $location->lat;
                        $lng = $location->lng;
        //                var_dump($lat, $lng);


                        $appointment_id = $value['appointment_id']; ?>

                        <tbody class="doctor-appointments__left">
                                <tr class="doctor-appointments__left__data">
                                    <td><img class="doctor-appointments__left__data__img" src="<?php echo $value['profile_picture']; ?>" alt=""></td>
                                    <td ><p><?php echo $value['name']; ?></p></td>
                                    <td ><p><?php echo $value['from_time'] ." ". $value['to_time']; ?></p></td>
                                    <td ><p><?php echo $value['date']; ?></p></td>
                                    <td ><p><?php echo $value['mobile_number']; ?></p></td>
                                    <td>
                                        <button style="" type="button" data-lat="<?= $lat ?>" data-lng="<?= $lng ?>"
                                                class="action-btn action-btn--location location-btn">
                                                <i class="fa-solid fa-location-dot"></i>
                                        </button>
                                    </td>

                                </tr>
                                <tr class="doctor-appointments__buttons-consulted">
                                    <td>
                                        <button value="Done"
                                                formaction="<?php echo "/doctor-dashboard/appointments-consulted?appointment_id=$appointment_id&id=$done" ?>"
                                                type="submit" style="background-color: #0002A1;align-items: center">Consulted
                                        </button>
                                    </td>
                                </tr>
                        </tbody>
                    <?php } ?>

<!--                </div>-->
                </table>
        </form>
    </div>


            <input name="destination-lat" id="destination-lat" type="hidden" style="opacity: 0">
            <input name="destination-lng" id="destination-lng" type="hidden" style="opacity: 0">

                    <div class="doctor-appointments__right">
                        <div class="map" id="map" style="height:500px;width: 400px;margin-inline: auto"></div>
                    </div>

            <script src="/assets/js/pages/doctor-location.js"></script>
</div>