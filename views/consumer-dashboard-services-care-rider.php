<?php
/**
 * @var array $care_rider;
 * @var string|null $vehicle_type;
 * @var string|null $searchTerm;
 */
?>

<div class="consumer-dashboard-care-rider">
    <div class="consumer-dashboard-care-rider__top">
        <form action="/consumer-dashboard/services/care-rider" class="form-item--search" method="get">
            <div class="care-rider-search-bar">
                <input type="text" placeholder="Search ..." name="q" id="q" value="<?php echo $searchTerm; ?>">
                <button class="care-rider-button" type="submit"><i class="fa fa-search"></i></button>
            </div>

            <select class="form-items-dropdown" name="vehicle_type" id="vehicle_type">
                <option value="all" <?php echo $vehicle_type === 'all' ? 'selected' : ''; ?>>All</option>
                <option value="Car" <?php echo $vehicle_type === 'Car' ? 'selected' : ''; ?>>Car</option>
                <option value="Van" <?php echo $vehicle_type === 'Van' ? 'selected' : ''; ?>>Van</option>
                <option value="Three-Weel" <?php echo $vehicle_type === 'Three-Weel' ? 'selected' : ''; ?>>Three-Weel</option>
            </select>
            <input type="submit">
        </form>
    </div>

    <?php if (empty($care_rider)): ?>
        <div class="care-rider__card-details care-rider__card-details--empty">
            <div class='empty-care-riders'>No nearby Care Riders</div>
        </div>
    <?php else: ?>
        <div class="care-rider__card-details">
            <?php foreach ($care_rider as $value): ?>
                <div class="care-rider-container">
                    <div class="care-rider-card">
                        <img src="<?php echo $value['profile_picture']; ?>">
                        <div class="consumer-dashboard-care-rider__bottom__center__data">
                            <h2><?php echo $value['name'] ?></h2>
                            <div>
                                <p><span>Type of Vehicle:</span> <?php echo $value['type'] ?></p>
                                <p><span>Color:</span> <?php echo $value['color'] ?></p>
                                <p><span>Mobile No:</span> <?php echo $value['mobile_number'] ?></p>
                            </div>
                            <a href="/consumer-dashboard/services/care-rider/request?provider_nic=<?php echo $value['provider_nic'] ?>">
                                <button class="btn">Request</button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

