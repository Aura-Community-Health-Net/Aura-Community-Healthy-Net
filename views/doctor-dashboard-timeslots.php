<?php
/**
 * @var array $timeslots;
 * @var $doctor;
 *
 */
?>
<div class="doctor-timeslots">
    <?php if(!$doctor['is_verified']) {?>
        <div class="not-verified-doctor-timeslot"><h2>You are not verified yet</h2></div><?php } else {?>
            <div class="items-table__scroll">
                    <table class="items-table">
                        <thead>
                        <tr><th>Slot No</th>
                            <th >Date</th>
                            <th >Day</th>
                            <th >From Time</th>
                            <th >To Time</th>
                        </tr>
                        </thead>


                            <?php foreach ($timeslots as  $value) { ?>
                                <tr>
                                    <td><?php echo $value['slot_number']; ?></td>
                                    <td><?php echo $value['date']; ?></td>
                                    <td><?php echo date('l', strtotime($value['date'])); ?></td>
                                    <td><?php echo $value['from_time']; ?></td>
                                    <td><?php echo $value['to_time']; ?></td>
                                    <td id='action-block'>
                                        <button id='edit-timeslot-<?php echo $value['slot_number']; ?>' data-slot="<?php echo $value['slot_number']; ?>" data-date="<?php echo $value['date'];?>" data-fromtime="<?php echo $value['from_time']; ?>" data-totime="<?php echo $value['to_time']; ?>" class='action-btn action-btn--edit timeslot-edit'><i class='fa-solid fa-pen'></i></button>
                                        <button id='delete-timeslot-<?php echo $value['slot_number']; ?>' data-slot="<?php echo $value['slot_number']; ?>" class='action-btn action-btn--delete timeslot-delete'><i class='fa-solid fa-trash'></i></button>
                                    </td>
                                </tr>
                            <?php } ?>

                    </table>
            </div>
            <form class="timeslots-form" action="/doctor-dashboard/timeslots/add" id="add-timeslot-form" method="POST">
                <table>
                    <tr>
                        <th><label class="timeslots-label" for="date">Date</label></th>
                        <th><label class="timeslots-label" for="from-time">From Time</label></th>
                        <th><label class="timeslots-label" for="to-time">To Time</label></th>
                    </tr>
                    <tr>
                        <td><input type="date" id="date" name="date" value="<?php echo $_POST['date'] ?? ''; ?>" required></td>
                        <td><input type="time" id="from-time" name="fromTime" value="<?php echo $_POST['from-time'] ?? ''; ?>"
                                   required></td>
                        <td><input type="time" id="to-time" name="toTime"
                                   value="<?php echo $_POST['to-time'] ?? ''; ?>" required></td>
                    </tr>
                </table>
                <input type="submit" id="add-timeslot-final-btn" style="display: none">
                <button class="add-btn" id="add-timeslot-btn" type="button"><i class="fa-solid fa-plus"></i></button>
            </form>


            <div class="overlay" id="add-timeslot-overlay">
                <div class="modal" id="add-timeslot-modal">
                    <h3>Do you really want to add this Timeslot?</h3>
                    <img class="modal-img" src="/assets/images/confirmation.jpg" alt="">
                    <div class="modal-actions">
                        <button class="cancel-btn" id="add-timeslot-cancel-btn">Cancel</button>
                        <button class="ok-btn" id="add-timeslot-ok-btn">Ok</button>
                    </div>
                </div>
            </div>

            <div class="overlay" id="delete-timeslot-overlay">
                <div class="modal" id="delete-timeslot-modal">

                </div>
            </div>

            <div class="overlay" id="edit-timeslot-overlay">
                <div class="modal_edit" id="edit-timeslot-modal">

                </div>
            </div>

            <script src="/assets/js/pages/timeslots.js"></script>
    <?php } ?>
</div>


