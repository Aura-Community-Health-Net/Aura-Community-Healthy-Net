<?php
/**
 * @var $patient_details
 * @var $doctor
 */

//print_r($patient_details);die();
?>

<head>
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Past-Patients</title>
</head>

<?php if(!$doctor['is_verified']) {?>
    <div class="not-verified-doctor-timeslot"><h2>No Patients yet</h2></div><?php } else {?>
<div class="doctor-patients">
<!--        <table>-->
<!--            <tr>-->
<!--                <th class="doctor-patients__head">Name</th>-->
<!--                <th class="doctor-patients__head">Mobile No</th>-->
<!--                <th class="doctor-patients__head">Last Checked</th>-->
<!--                <th class="doctor-patients__head">Observation</th>-->
<!--            </tr>-->
<!--        </table>-->

                <?php foreach ($patient_details as $value) {?>
                            <div class="doctor-patients__data">
                                <img src="<?php echo $value['profile_picture'];?>" alt="">
                                <p><?php echo $value['name'];?></p>
                                <p><?php echo $value['date'];?></p>
                                <p><?php echo $value['from_time']."-".$value['to_time'];?></p>
                                <p><?php echo $value['mobile_number'];?></p>
                                <p><?php echo $value['address'];?></p>
                            </div>
                <?php }?>
</div>
<?php } ?>