<?php
/**
 * @var array $feedback

 */
//print_r($feedback); die();
//print_r($feedback['consumer_nic']);

?>

<head>
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Doctor-Feedbacks</title>
</head>
<div class="doctor-feedbacks__container">
<div class="doctor-feedbacks">

            <?php foreach ($feedback as $value) { ?>
                <div class="doctor-feedbacks__data__container">
                    <div class="doctor-feedbacks__data">
                        <table>
                            <tr>
                                <td><img src="/assets/images/profilepic3.jpg"></td>
                                <td><h3><b><?php echo $value['name'];?></b></h3></td>
                                <td><h4><?php echo $value['date_time'];?></h4></td>
                            </tr>
                        </table>
                    </div>
                    <p> <?php echo $value['text'];?></p>
                </div>

            <?php } ?>
</div>

</div>
