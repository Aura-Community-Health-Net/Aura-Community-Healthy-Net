<?php
/**
 * @var array $doctor;
 * @var array $profile;
 * @var array $doctorQualification;
 *
 */
//echo $profile1;exit();
//print_r($doctor['provider_nic']);
//print_r($profile)
?>

<head>
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Doctor-Profile</title>
</head>

<div class="doctor-profile">
    <div class="doctor-profile__background">
        <div class="doctor-profile__data">
            <table>
                <tr>
                    <th>
                        <img src="<?php echo $doctor['profile_picture']; ?>">
                    </th>
                    <th>
                        <h2><?php echo $doctor['name']; ?></h2>
                        <h3><?php echo $profile['field_of_study']; ?></h3>
                    </th>
                </tr>
                <tr>
                    <td><b>Email Address</b></td>
                    <td><?php echo $doctor['email_address']; ?></td>
                </tr>
                <tr>
                    <td><b>NIC</b></td>
                    <td><?php echo $doctor['provider_nic']; ?></td>
                </tr>
                <tr>
                    <td><b>Mobile Number</b></td>
                    <td><?php echo $doctor['mobile_number']; ?></td>
                </tr>
                <tr>
                    <td><b>Qualifications</b></td>
                    <td>
                        <?php foreach ($doctorQualification as $value) {
                             echo $value['qualifications'].'<br>';
                         } ?>
                    </td>
                </tr>

            </table>
        </div>
    </div>
</div>