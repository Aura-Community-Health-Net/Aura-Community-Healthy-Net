<?php
/**
 * @var array $timeslots
 *@var array $care_rider
 */
?>
<table class="items-table">
    <thead>
    <tr>
        <th>Slot No</th>
        <th id="date">Date</th>
        <th id="day">Day</th>
        <th id="from">From Time</th>
        <th id="to">To Time</th>
    </tr>
    </thead>

    <?php
    if (empty($timeslots)) {
        echo " <tbody class='care-rider-table-size'><tr> <td colspan='6' class='Not-verified-care-rider-timeslot'>No Timeslots Here </td></tr> </div>";
    } else {
        foreach ($timeslots as $timeslot) {
            ?>

            <tr>
                <td class="time-slots-td"><?php echo $timeslot['slot_number']; ?></td>
                <td><?php echo $timeslot['date']; ?></td>
                <td><?php echo date('l', strtotime($timeslot['date'])); ?></td>
                <td><?php echo $timeslot['from_time']; ?></td>
                <td><?php echo $timeslot['to_time']; ?></td>

                <td id='action-block'>
                    <button id='edit-care-rider-timeslot-<?php echo $timeslot['slot_number']; ?>' data-slot="<?php echo $timeslot['slot_number']; ?>" data-date="<?php echo $timeslot['date'];?>" data-fromtime="<?php echo $timeslot['from_time']; ?>" data-totime="<?php echo $timeslot['to_time']; ?>" class='action-btn action-btn--edit care-rider-timeslot-edit'>
                        <i class='fa-solid fa-pen'></i>
                    </button>
                    <button id='delete-care-rider-timeslot-<?php echo $timeslot['slot_number']; ?>' data-slot='<?php echo $timeslot['slot_number']; ?>' class='action-btn action-btn--delete care-rider-timeslot-delete'>
                        <i class='fa-solid fa-trash'></i>
                    </button>
                </td>
            </tr>

            <?php
        }
    }
    ?>
    </tbody>
</table>
<form class="products-form" action="/care-rider-dashboard/timeslots" id="add-care-rider-timeslot-form" method="post">
    <table>
        <tr>
            <th><label class="products-label" for="date">Date</label></th>
            <th><label class="products-label" for="from-time">From Time</label></th>
            <th><label class="products-label" for="to-time">To Time</label></th>
        </tr>
        <tr>
            <td><input type="date" id="date" name="date" value="<?php echo $_POST['date'] ?? ''; ?>" required></td>
            <td><input type="time" id="from-time" name="fromTime" value="<?php echo $_POST['from-time'] ?? ''; ?>" required></td>
            <td><input type="time" id="to-time" name="toTime" value="<?php echo $_POST['to-time'] ?? ''; ?>" required></td>
        </tr>
    </table>
    <button class="add-btn" id="add-care-rider-timeslot-btn" type="button">
        <i class="fa fa-plus add-icon"></i>
    </button>
</form>


<div class="overlay" id="add-care-rider-timeslot-overlay">
    <div class="modal" id="add-care-rider-timeslot-modal">
        <h3>Do you really want to add this timeslot?</h3>
        <img class="modal-img" src="/assets/images/confirmation.jpg">
        <div class="modal-actions">
            <button class="cancel-btn" id="add-care-rider-timeslot-cancel-btn">Cancel</button>
            <button class="ok-btn" id="add-care-rider-timeslot-ok-btn">Ok</button>
        </div>
    </div>
</div>
<div class="overlay" id="delete-care-rider-timeslot-overlay">
    <div class="modal" id="delete-care-rider-timeslot-modal">

    </div>
</div>
<div class="overlay" id="edit-care-rider-timeslot-overlay">
    <div class="modal_edit" id="edit-care-rider-timeslot-modal">

    </div>
</div>

<script src="/assets/js/pages/care-rider-timeslots.js"></script>
}