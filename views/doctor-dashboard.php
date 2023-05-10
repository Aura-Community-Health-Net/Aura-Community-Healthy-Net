<?php
/**
 *@var $doctor;
 * @var $appointment_confirm;
 * @var $appointment_done;
 * @var $new_patients;
 * @var $all_patients;
 * @var $patient_details;
 * @var $consulted_patients;
 */
//print_r($appointment_done);die();
if (!$doctor['is_verified']) {
echo "<div class='empty-registrations' style='color: red'> <p>You're not verified yet. Please check later.</p></div>";
}

//print_r($appointment_confirm);die();
//print_r($patient_details);
?>

<div class="doctor-dashboard">
        <div class="doctor-dashboard__left__top">
                <h3>New Appointment List</h3>
            <?php if(!$doctor['is_verified']) {?>
            <div class="not-verified-doctor"><h2>No patients yet</h2></div><?php } else {?>
                    <?php if($new_patients['COUNT(done)']!=0){?>
            <div class="appointment-list__item__scroll">
                <table>
                    <?php foreach ($appointment_confirm as  $value) { ?>
                        <tr class="appointment-list__item">
                            <td><img src="<?php echo $value['profile_picture']?>" alt=""></td>
                            <td><h5><b><?php echo $value['name']?></b><br>
                                    <?php echo $value['mobile_number']?></h5></td>
                            <td><h4><?php echo $value['date']?></h4></td>
                            <td><h4><?php echo $value['from_time']." - ".$value['to_time']?></h4></td>
                            <td><h4><?php echo $value['address']?></h4></td>
                        </tr>
                    <?php } ?>
                </table>
                <a href="/doctor-dashboard/appointments"><button>Show More</button></a>
            </div>
            <?php } } ?>
        </div>

        <div class="doctor-dashboard__center__top">
            <h3 style="margin-bottom: 1.5rem">Patients Count</h3>
            <?php if(!$doctor['is_verified']) {?>
                <div class="not-verified-doctor"><h2>No patients yet</h2></div><?php } else {?>
                    <div class="doctor-dashboard__patients__count">
                        <h3>New Patients</h3>
                        <h1 style="color: #5BC849"><?php echo $new_patients['COUNT(done)'];?></h1>
                    </div>
                    <div class="doctor-dashboard__patients__count">
                        <h3>All Patients</h3>
                        <h1 style="color: #FF0000"><?php echo $all_patients['COUNT(done)'];?></h1>
                    </div>
            <?php } ?>
        </div>

    <div class="doctor-dashboard__left__bottom">
        <h3>Past Patients List</h3>
        <?php if(!$doctor['is_verified']) {?>
            <div class="not-verified-doctor"><h2>No patients yet</h2></div><?php } else {?>
                <div class="doctor-dashboard__patients__list__scroll">
                    <?php foreach ($appointment_done as  $value) { ?>
                            <div class="doctor-dashboard__patients__list">
                                <img src="<?php echo $value['profile_picture']?>">
                                <h5><b><?php echo $value['name']?></b><br>
                                    <?php echo $value['mobile_number']?></h5>
                                <h5><?php echo $value['address']?></h5>
                            </div>
                    <?php } ?>
                </div>
        <?php } ?>
    </div>

        <div class="doctor-dashboard__center__bottom">
            <h3 style="margin-bottom: 1rem">Last Consulted Patient</h3>
            <?php if(!$doctor['is_verified']) {?>
                    <div class="not-verified-doctor"><h2>No patients yet</h2></div><?php } else {?>
                        <?php if($consulted_patients['COUNT(done)'] != 0){ ?>
                        <div class="doctor-dashboard__consulted">
                            <div class="doctor-dashboard__consulted__profile">
                                <img src=" <?php echo $patient_details['profile_picture'];?>">
                                <div>
                                    <h4><b> <?php echo $patient_details['name'] ;?></b></h4>
                                    <h5> <?php echo $patient_details['mobile_number'] ;?></h5>
                                </div>
                            </div>
                           <div class="doctor-dashboard__consulted__details">
                               <p><b>Last Checked</b> <?php echo " - ". $patient_details['MAX(doctor_time_slot.date)'] ;?></p>
                               <p><b>Address</b> <?php echo " - ". $patient_details['address'] ;?></p>
                               <p><b>Mobile Number</b><?php echo " - ". $patient_details['mobile_number'] ;?></p>
                           </div>
                    </div>
            <?php } } ?>
        </div>

        <div class="doctor-dashboard__right__bottom">
            <h3 style="margin-bottom: 2rem">Analytics</h3>
            <div class="doctor-dashboard__right__bottom-analytics">
                <canvas class="doctor-dashboard_revenue_analytics" id="doctor-dashboard_revenue_analytics"></canvas>
            </div>
        </div>
    <!-- </div> -->
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>

<script src="/assets/js/pages/doctor-analytics.js"></script>