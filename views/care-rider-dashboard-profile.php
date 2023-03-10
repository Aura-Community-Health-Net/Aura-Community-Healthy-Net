<?php
/**
 *@var array $care_rider ;
 *
 *
 *
 **/
?>

<head>
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Care-Rider-Profile</title>
</head>

<div class="doctor-profile">
    <div class="doctor-profile__background">
        <div class="doctor-profile__data">
            <table>
                <tr>
                    <th>
                        <img src="<?php echo $care_rider['profile_picture']; ?>">
                    </th>
                    <th>
                        <h2><?php echo $care_rider['name']; ?></h2>
                        <h3>Care Rider</h3>
                    </th>
                </tr>
                <tr>
                    <td><b>Email Address</b></td>
                    <td><?php echo $care_rider['email_address']; ?></td>
                </tr>
                <tr>
                    <td><b>NIC</b></td>
                    <td><?php echo $care_rider['provider_nic']; ?></td>
                </tr>
                <tr>
                    <td><b>Mobile Number</b></td>
                    <td><?php echo $care_rider['mobile_number']; ?></td>
                </tr>


            </table>
        </div>
    </div>
</div>