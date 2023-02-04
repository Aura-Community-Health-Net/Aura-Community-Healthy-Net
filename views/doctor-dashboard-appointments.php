<?php
/**
 * @var array $appointments
 * @var array $doctor
 * @var array $timeslots
 */
?>

<div class="doctor-appointments">
    <div class="doctor-appointments__left">
        <table>
            <tr>
                <th>Name</th>
                <th>Time Slot</th>
                <th>Mobile No</th>
                <th>Location</th>
            </tr>
            <tr>
                <td><img src="<?php echo $doctor['profile_picture'] ?>"><?php echo $doctor["name"]; ?></td>
                <td><?php echo $timeslots['from-time']; echo $timeslots['to-time']?></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="doctor-appointments__right">
        <div class="doctor-appointments__right__top">

        </div>
        <div class="doctor-appointments__right__bottom">

        </div>
    </div>
</div>


