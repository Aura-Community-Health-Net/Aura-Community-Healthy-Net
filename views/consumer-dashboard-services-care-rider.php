<?php
/**
 * @var array $care_rider;
 *
 */
//print_r($care_rider);
?>
<head>
    <link rel="stylesheet" href="/assets/css/main.css">

</head>
<div class="consumer-dashboard-care-rider">
    <div class="consumer-dashboard-care-rider__top">
            <form action="" class="form-item--search">

                <div class="search-bar">
                    <input type="text" placeholder="Search..." name="search">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </div>

                <div class="search-bar">
                    <input type="Date" placeholder="Search Product..." name="date">
                </div>


                <div class="search-bar">
                    <input type="Time" placeholder="Search Product..." name="time">

                </div>
            </form>
    </div>
        <div class="care-rider__card-details">
            <?php foreach ($care_rider as $value) {?>
            <div class="care-rider-container">
                <div class="care-rider-card">
                    <img src="<?php echo $value['profile_picture']; ?>">
                    <div class="consumer-dashboard-care-rider__bottom__center__data">
                        <h2><?php echo $value['name']?></h2>
                        <div>
                            <p><span>Type of Vehicle </span><?php echo $value['type']?></p>
                            <p><span>color </span> :<?php echo $value['color']?></p>
                            <p><span>Mobile No </span> <?php echo $value['mobile_number']?></p>
                        </div>
                        <a href="/consumer-dashboard/services/care-rider/request?provider_nic=<?php echo$value['provider_nic'] ?>">
                            <button > Request</button>
                        </a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

