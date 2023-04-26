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
        <form action="/consumer-dashboard/services/care-rider" class="form-item--search" method="get">
            <div class="search-bar">
                <input type="text" placeholder="Search ..." name="q" id="q">
                <button href="" type="submit"><i class="fa fa-search"></i></button>
            </div>
            <select class="form-items-dropdown" name="product-categories" id="product-categories">
                <option value="Car">Car</option>
                <option value="Van">Van</option>
                <option value="Three-Weel">Three-Weel</option>
            </select>
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

