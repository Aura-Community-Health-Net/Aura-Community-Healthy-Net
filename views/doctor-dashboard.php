<?php
/**
 *@var $doctor;
 * @var $appointment_confirm;
 * @var $appointment_done;
 * @var $new_patients;
 * @var $all_patients;
 * @var array $patient_details;
 */
/*if (!$doctor['is_verified']) {
echo "<div class='empty-registrations'> <p>You're not verified yet. Please check later.</p></div>";
}*/

//print_r($all_patients);
//print_r($patient_details);die();
?>

<div class="doctor-dashboard">
        <div class="doctor-dashboard__left__top">
                <h3>New Appointment List</h3>
            <div class="appointment-list__item__scroll">
                <?php foreach ($appointment_confirm as  $value) { ?>
                    <div class="appointment-list__item">
                        <img src="<?php echo $value['profile_picture']?>">
                        <h5><b><?php echo $value['name']?></b><br>
                            <?php echo $value['mobile_number']?></h5>
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="doctor-dashboard__center__top">
            <h3>Past Patients List</h3>
            <div class="doctor-dashboard__patients__count">
                <h3>New Patients</h3>
                <h1 style="color: #5BC849"><?php echo $new_patients['COUNT(confirmation)'];?></h1>
            </div>
            <div class="doctor-dashboard__patients__count">
                <h3>All Patients</h3>
                <h1 style="color: #FF0000"><?php echo $all_patients['COUNT(confirmation)'];?></h1>
            </div>
        </div>

    <div class="doctor-dashboard__right__top">
        <h3>Notes</h3>
        <div class="doctor-dashboard__notes">
            <img src="/assets/images/notes.png">
            <h4><b>Keep your Doctor Informed
                    about</b></h4>
            <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
        </div>
    </div>

    <div class="doctor-dashboard__left__bottom">
        <h3>Past Patients List</h3>
        <div class="doctor-dashboard__patients__list__scroll">
            <?php foreach ($appointment_done as  $value) { ?>
                    <div class="doctor-dashboard__patients__list">
                        <img src="<?php echo $value['profile_picture']?>">
                        <h5><b><?php echo $value['name']?></b><br>
                            <?php echo $value['mobile_number']?></h5>
                    </div>
            <?php } ?>
        </div>

    </div>

        <div class="doctor-dashboard__center__bottom">
            <h3>Consulted</h3>
            <div class="doctor-dashboard__consulted">
                <div class="doctor-dashboard__consulted__profile">
                    <img src="<?php echo $patient_details['profile_picture']?>">
                    <div>
                        <h4><b><?php echo $patient_details['name']?></b></h4>
                        <h5><?php echo $patient_details['mobile_number']?></h5>
                    </div>
                </div>
               <div class="doctor-dashboard__consulted__details">
                   <p><b>Last Checked</b><?php echo " ". $patient_details['MAX(doctor_time_slot.date)']?></p>
                   <p><b>Address</b><?php echo " ". $patient_details['address']?></p>
                   <p><b>Observation</b>Lorem Ipsum is simple text of the printing and typesetting industry.</p>
               </div>
            </div>
        </div>

        <div class="doctor-dashboard__right__bottom">
            <h3>Analytics</h3>
            <img src="/assets/images/analytics_graph.png">
            <div class="doctor-dashboard__analytics">
                <p> Lor Lorem Ipsum is simply dummy text<br> of the printing and text of the printing<br> and type setting industry.</p>
            </div>
        </div>
    <!-- </div> -->
</div>