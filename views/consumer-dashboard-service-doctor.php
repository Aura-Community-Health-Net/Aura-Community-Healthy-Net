<?php
/**
 * @var array $doctor;
 *
 */
//print_r($doctor);
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
                <div class="doctor-card">
                    <img src="/assets/images/profilepic2.jpg">
                    <div class="consumer-dashboard-doctor__bottom__center__data">
                        <h2><?php echo $doctor['name']; ?></h2>
                        <div>
                            <p><span>Mobile No </span> :<?php echo $doctor['mobile_number']; ?></p>
                        </div>
                        <a href="/consumer-dashboard/services/doctor/profile?">
                            <button>Make Appointment</button>
                        </a>
                    </div>
                </div>

            <div class="doctor-card">
                <img src="/assets/images/profilepic3.jpg">
                <div class="consumer-dashboard-doctor__bottom__center__data">
                    <h2> Lahiru Sampath</h2>
                    <div>
                        <p><span>Mobile No </span> :0712345678</p>
                    </div>
                    <a href="/consumer-dashboard/services/doctor/profile">
                        <button>Make Appointment</button>
                    </a>
                </div>
            </div>


            <div class="doctor-card">
                <img src="/assets/images/profilepic4.jpg">
                <div class="consumer-dashboard-doctor__bottom__center__data">
                    <h2> Ravishi Palihawadana</h2>
                    <div>
                        <p><span>Mobile No </span>: 0752345678</p>
                    </div>
                    <a href="/consumer-dashboard/services/doctor/profile">
                        <button>Make Appointment</button>
                    </a>
                </div>
            </div>


            <div class="doctor-card">
                <img src="/assets/images/profilepic5.jpg">
                <div class="consumer-dashboard-doctor__bottom__center__data">
                    <h2>Anjana Dilshan</h2>
                    <div>
                        <p><span>Mobile No </span> :0712345678</p>
                    </div>
                    <a href="/consumer-dashboard/services/doctor/profile">
                        <button>Make Appointment</button>
                    </a>
                </div>
            </div>


            <div class="doctor-card">
                <img src="/assets/images/profilepic6.jpg">
                <div class="consumer-dashboard-doctor__bottom__center__data">
                    <h2>Dhanuka Iroshana</h2>
                    <div>
                        <p><span>Mobile No </span> :0712345678</p>
                    </div>
                    <a href="/consumer-dashboard/services/doctor/profile">
                        <button>Make Appointment</button>
                    </a>
                </div>
            </div>


            <div class="doctor-card">
                <img src="/assets/images/profilepic7.jpg">
                <div class="consumer-dashboard-doctor__bottom__center__data">
                    <h2>Dumindu Lakshan</h2>
                    <div>
                        <p><span>Mobile No </span> :0712345678</p>
                    </div>
                    <a href="/consumer-dashboard/services/doctor/profile">
                        <button>Make Appointment</button>
                    </a>
                </div>
            </div>

        </div>

