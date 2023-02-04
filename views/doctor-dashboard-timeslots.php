<?php
/**
 * @var array $timeslots
 */
?>
<div class="doctor-timeslots">
    <table class="items-table">
        <thead>
        <tr>
            <th >Date</th>
            <th >Day</th>
            <th >From Time</th>
            <th >To Time</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($timeslots as  $value) { ?>
            <tr>

                <td><?php echo $value['date']; ?></td>
                <td><?php echo date('l', strtotime($value['date'])); ?></td>
                <td><?php echo $value['from_time']; ?></td>
                <td><?php echo $value['to_time']; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <form class="products-form" action="/doctor-dashboard/timeslots" id="add-doctor-timeslot" method="POST">
        <table>
            <tr>
                <th><label class="products-label" for="date">Date</label></th>
                <th><label class="products-label" for="from-time">From Time</label></th>
                <th><label class="products-label" for="to-time">To Time</label></th>
            </tr>
            <tr>
                <td><input type="date" id="date" name="date" value="<?php echo $_POST['date'] ?? ''; ?>" required></td>
                <td><input type="time" id="from-time" name="fromTime" value="<?php echo $_POST['from-time'] ?? ''; ?>"
                           required></td>
                <td><input type="time" id="to-time" name="toTime"
                           value="<?php echo $_POST['to-time'] ?? ''; ?>" required></td>
            </tr>
        </table>
        <button class="add-btn" id="add-doctor-timeslot-btn" type="submit">
            <i class="fa fa-plus"></i>
        </button>
    </form>
</div>


