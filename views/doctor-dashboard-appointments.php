<?php
/**
 * @var array $appointments
 * @var array $doctor
 * @var array $appointments_details
 */
//print_r($appointments_details);
//$provider_nic = $_SESSION['nic'];
?>

<div class="doctor-appointments_container">
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
            <?php foreach ($appointments_details as  $value) { ?>
            <div class="doctor-appointments__left">

                <div class="doctor-appointments__left__data">
                    <img src="<?php echo $value['profile_picture'];?>">
                    <p><?php echo $value['name'];?></p>
                    <p><?php echo $value['from_time']. " - " . $value['to_time'];?></p>
                    <p><?php echo $value['mobile_number'];?></p>
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                        <div class="doctor-appointments__buttons">
                            <form action="/doctor-dashboard/appointments?id=<?php echo $value['appointment_id'];?>" method="post">
                                <button style="background-color: #0002A1">Cancel</button>
                                <button style="background-color: #00005C "">Confirm</button>
                            </form>
                        </div>
            </div>
            <?php } ?>
        </div>
    </div>

        <div class="doctor-appointments__right">
            <div class="doctor-appointments__right__top">
                <img src="/assets/images/calander.jfif">
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d270201.1012553059!2d80.57066973934896!3d7.435740318327426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1668671876514!5m2!1sen!2slk"
                        width="400" height="250" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" frameborder="0"></iframe>   </div>
        </div>
    <script src="/assets/js/pages/timeslots.js"></script>
</div>


