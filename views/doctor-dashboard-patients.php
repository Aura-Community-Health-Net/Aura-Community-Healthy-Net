<?php
/**
 * @var array $patients
 * @var $patient_details
 */

//print_r($patient_details);die();
?>

<head>
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Past-Patients</title>
</head>

<div class="doctor-patients">
        <table>
            <tr>
                <th class="doctor-patients__head">Name</th>
                <th class="doctor-patients__head">Mobile No</th>
                <th class="doctor-patients__head">Last Checked</th>
                <th class="doctor-patients__head">Observation</th>
            </tr>
        </table>
                <?php foreach ($patient_details as $value) {?>
                            <div class="doctor-patients__data">
                                <img src="<?php echo $value['profile_picture'];?>">
                                <p><?php echo $value['name'];?></p>
                                <p><?php echo $value['mobile_number'];?></p>
                                <p><?php echo $value['MAX(doctor_time_slot.date)'];?></p>
                                <p>Lorem Ipsum is simply Lorem simply</p>
                            </div>
                <?php }?>
</div>