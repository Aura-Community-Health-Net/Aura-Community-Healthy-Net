<?php
/**
 * @var array $timeslots
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
    <tbody>
    <?php foreach ($data as $key => $value) { ?>
        <tr>
            <td><?php echo $value['slot_number']; ?></td>
            <td><?php echo $value['date']; ?></td>
            <td><?php echo date('l', strtotime($value['date'])); ?></td>
            <td><?php echo $value['from_time']; ?></td>
            <td><?php echo $value['to_time']; ?></td>
            <td>
                <form class="getUpdateId" action="/care-rider-timeslots-update" method="get">
                    <input type="hidden" name="slot_id" value="<?php echo $value['slot_number']; ?>">
                    <button>
                        <i class="fas fa-edit"></i>
                    </button>
                </form>
            </td>
            <form class="deleteCareRiderTimeslot" action="/care-rider-timeslots-delete" method="post">
                <td>
                    <input type="hidden" name="slot_id" value="<?php echo $value['slot_number']; ?>">
                    <button onclick="deleteCarerider()">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </td>
            </form>
        </tr>
    <?php } ?>
    </tbody>
</table>
<form class="products-form" action="/care-rider-dashboard/timeslots" id="add-care-rider-timeslot" method="post">
    <table>
        <tr>
            <th><label class="products-label" for="date">Date</label></th>
            <th><label class="products-label" for="from-time">From Time</label></th>
            <th><label class="products-label" for="to-time">To Time</label></th>
        </tr>
        <tr>
            <td><input type="date" id="name" name="name" value="<?php echo $_POST['date'] ?? ''; ?>" required></td>
            <td><input type="time" id="from-time" name="fromTime" value="<?php echo $_POST['from-time'] ?? ''; ?>"
                       required></td>
            <td><input type="time" id="to-time" name="toTime"
                       value="<?php echo $_POST['to-time'] ?? ''; ?>" required></td>
        </tr>
    </table>
    <button class="add-btn" id="add-care-rider-timeslot-btn" type="button">
        <i class="fa fa-plus"></i>
    </button>
</form>

