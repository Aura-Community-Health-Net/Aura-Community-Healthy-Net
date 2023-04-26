<?php
/**
 * @var array $doctor;
 *
 */

//print_r($doctor);
/*if (!isset($_GET['doctor-appointment-btn'])){
    $consumer_nic = $_SESSION['nic'];
}*/
?>
<div class="consumer-dashboard-doctor">
    <div class="consumer-dashboard-doctor__top">
        <form action="/consumer-dashboard/services/doctor" class="form-item--search" method="get">

            <div class="search-bar">
                <input type="text" placeholder="Search..." name="q" id="q">
                <button type="submit" ><i class="fa fa-search"></i></button>
            </div>
            <select class="form-items--dropdown" name="doctor-categories" id="doctor-categories" onchange="filterDoctor(value)">
                <option value="Western">Western Doctor</option>
                <option value="Indigenous">Indigenous Doctor</option>
                <option value="Counselor">Counsellor</option>
            </select>
        </form>
    </div>
    <div class="doctor__card-details">
            <div class="doctor-container" id="doctor-container">
                <?php foreach ($doctor as $value) {
                    $nic = $value['provider_nic'];?>
                    <div class="doctor-card" id="doctor-card">
                        <img src="<?php echo $value['profile_picture']; ?>">
                        <div class="consumer-dashboard-doctor__bottom__center__data" id="doctor-card">
                            <h2><?php echo $value['name']; ?></h2>
                            <h2 hidden> <?php echo $value['type']; ?></h2>
                            <div>
                                <p><?php echo $value['field_of_study']; ?></p>
                            </div>
                            <a href="/consumer-dashboard/services/doctor/profile?provider_nic=<?php echo $value['provider_nic']; ?>">
                                <button name="doctor-appointment-btn">Make Appointment</button>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
    </div>

    <script src="/assets/js/pages/timeslots.js"></script>
</div>

