<?php
/**
 * @var $doctor;
 * @var $time_slot;
 * @var $feedback;
 */
if (!isset($_GET['doctor-feedback-btn'])){
    $provider_nic = $_GET['provider_nic'];
}

/*if (!isset($_GET['doctor-pay-btn'])){
    $provider_nic = $_GET['provider_nic'];
}*/
//print_r($feedback);die();
//print_r($time_slot);die();
//print_r($doctor);die();
?>
<div class="consumer-dashboard-doctor-profile">
    <div class="consumer-dashboard-doctor-profile__top">
        <table>
            <tr>
                <td>
                    <div class="consumer-dashboard-doctor-profile__top__left">
                        <img src="/assets/images/profilepic2.jpg">
                        <div class="consumer-dashboard-doctor-profile__top__left__data">
                            <h3><b><?php echo $doctor['name']; ?></b></h3><br>
                            <h4><?php echo $doctor['field_of_study']; ?></h4>
                            <h4>SLMC Reg.No: <?php echo $doctor['slmc_reg_no']; ?></h4>
                            <p>Lorem Ipsum is simply dummy text of the hgiiir
                                printing and typesetting industry. Lorem dfdsss
                                Ipsum has been the industry's standard ddssda
                                dummy text ever since the 1500s, when an qwee
                                unknown printer took a galley of type and easss
                                scrambled it to make a type specimen book.</p>
                        </div>
                    </div>
                </td>
                <td>
                        <div class="consumer-dashboard-doctor-profile__top__right">
                            <h4>Available Time-Slots</h4>
                            <div class="consumer-dashboard-doctor-profile__top__right__dropdown">
                                <input type="date" id="time-slot-date" value="" onchange="timeSlotDate(this.value)">
                            </div>
                            <div class="consumer-dashboard-doctor-profile__top__right__timeslot">
                                <table id="doctor-available-slot">
                                    <?php foreach ($time_slot as  $value) { ?>
                                        <tr>
                                            <td hidden><?php echo date('l', strtotime($value['date']));?></td>
                                            <td><?php echo $value['date'];?></td>
                                            <td><?php echo $value['from_time']?></td>
                                            <td><?php echo $value['to_time']?></td>
                                            <td><?php echo " ";?></td>
                                            <td><input type="radio"></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                            <div class="consumer-dashboard-doctor-profile__top__right__location">
                                <p>Add Location</p>
                                <div class="consumer-dashboard-doctor-profile__top__right__location__search">
                                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                                </div>
                            </div>
                            <p class="consumer-dashboard-doctor-profile__top__right_p">You will need to pay Rs. 1500.00 for an appointment</p>
                            <a href="/consumer-dashboard/services/doctor/profile/payment"><button name="doctor-pay-btn">Continue to Pay</button></a>
                        </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="consumer-dashboard-doctor-profile__bottom">
        <table>
            <tr>
                <td>
                    <div class="consumer-dashboard-doctor-profile__bottom__left">
                        <?php foreach ($feedback as  $value) { ?>
                        <div class="consumer-dashboard-doctor-profile__bottom__left__data">
                            <img src="/assets/images/profilepic5.jpg">
                            <h3><b><?php echo $value['name']?></b></h3>
                            <h4><?php echo $value['date_time']?></h4>
                            <p><?php echo $value['text']?></p>
                        </div>
                        <?php } ?>
                    </div>
                </td>
                <td>
                    <div class="consumer-dashboard-doctor-profile__bottom__right">
                        <h3>Give your Feedback</h3>
                        <form action="/consumer-dashboard/services/doctor/profile" method="GET">
                            <input type="datetime-local" name="feedback-datetime" class="doctor-feedback-datetime">
                            <input type="text" name="doctor-feedback" class="doctor-feedback">
                            <input name="provider_nic" value="<?php echo $provider_nic?>" type="text" hidden >
                            <button name="doctor-feedback-btn" >Submit</button>
                        </form>
                    </div>
                </td>
            </tr>
        </table>

    </div>
    <script src="/assets/js/pages/timeslots.js"></script>
</div>
