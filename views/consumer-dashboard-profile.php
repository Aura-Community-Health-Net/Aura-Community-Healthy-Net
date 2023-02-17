<?php
/**
 * @var array $consumer;
 *
 */
//print_r($consumer);die();
?>
<div class="consumer-dashboard-profile">
    <div class="consumer-dashboard-profile_background">
        <div class="consumer-dashboard-profile__bottom">
            <table>
                <tr>
                    <td>
                        <img src="/assets/images/profilepic2.jpg">
                    </td>
                    <td>
                        <h2><?php echo $consumer['name']; ?></h2>
                    </td>
                </tr>
                <tr>
                    <td><b>Email Address</b></td>
                    <td><?php echo $consumer['email_address']; ?></td>
                </tr>
                <tr>
                    <td><b>NIC</b></td>
                    <td><?php echo $consumer['consumer_nic']; ?></td>
                </tr>
                <tr>
                    <td><b>Mobile Number</b></td>
                    <td><?php echo $consumer['mobile_number']; ?></td>
                </tr>
                <tr>
                    <td><b>Address</b></td>
                    <td><?php echo $consumer['address']; ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
