<?php
/**
 * @var array $requests
 * @var array $careRider
 * @var array $request_details
 */
$cancel = 1;
$confirm =2;
?>

<head>
    <link rel="stylesheet" href="/assets/css/main.css">

</head>
<div class="care-rider-new-requests">
    <div class="care-rider-new-requests__left">
        <table>
            <tr>
                <th>Name</th>
                <th>Time Slot</th>
                <th>Mobile No</th>
                <th>Location</th>
            </tr>
        </table>
        <div class="doctor-appointments__left__background">
            <?php foreach ($request_details as  $value) { ?>
                <div class="doctor-appointments__left">
                    <form action="" method="post">
                        <div class="doctor-appointments__left__data">
                            <img src="<?php echo $value['profile_picture'];?>">
                            <p><?php echo $value['name'];?></p>
                            <p><?php echo $value['from_time']. " - " . $value['to_time'];?></p>
                            <p><?php echo $value['mobile_number'];?></p>
                            <i class="fa-solid fa-location-dot"></i>
                            <?php $request_id = $value['request_id']?>
                        </div>
                        <div class="doctor-appointments__buttons">
                            <button value="Cancel" formaction="<?php echo"/care-rider-dashboard/request-conform-cancel?request_id=$request_id&id=$cancel"?>" type="submit" style="background-color: #0002A1">Cancel</button>
                            <button value="Confirm" formaction="<?php echo"/care-rider-dashboard/request-conform-cancel?request_id=$request_id&id=$confirm"?>" type="submit" style="background-color: #00005C">Confirm</button>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>



    </div>


    <div class="care-rider-new-requests__right">
        <div class="care-rider-new-requests__right__top">
            <img src="/assets/images/calander.jfif">
        </div>
        <div class="care-rider-new-requests__right__bottom">
            <a href="https://www.google.com/maps"><img src="/assets/images/care-rider-map.jfif"></a>
        </div>
    </div>
</div>

