<?php
/**
 * @var array $doctor;
 *
 */
//print_r($doctor);die();
?>
<div class="consumer-dashboard-doctor">
    <div class="consumer-dashboard-doctor__top">
        <form action="" class="form-item--search">

            <div class="search-bar">
                <input type="text" placeholder="Search..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>

            <select class="form-items--dropdown" name="product-categories" id="product-categories">
                <option value="Doctor">Western Doctor</option>
                <option value="Pharmacy">Indigenous Doctor</option>
                <option value="Product Seller">Counsellor</option>
            </select>

        </form>
    </div>
    <div class="doctor__card-details">
        <div class="doctor-container">
            <?php foreach ($doctor as $value) {
                    $nic = $value['provider_nic'];?>
                <div class="doctor-card">
                    <img src="/assets/images/profilepic2.jpg">
                    <div class="consumer-dashboard-doctor__bottom__center__data">
                        <h2><?php echo $value['name']; ?></h2>
                        <div>
                            <p><?php echo $value['field_of_study']; ?></p>
                        </div>
                        <?php echo $nic?>
                        <a href="/consumer-dashboard/services/doctor/profile?provider_nic=<?php echo$nic ?>">
                            <button>Make Appointment</button>
                        </a>
                    </div>
                </div>
            <?php } ?>
    </div>
</div>

