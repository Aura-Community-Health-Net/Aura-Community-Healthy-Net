<?php

/**
 * @var array $medicines_list
 * @var array $pharmacy_details
 */

$provider_image = $pharmacy_details['profile_picture'];
$provider_name = $pharmacy_details['provider_name'];
$pharmacy_name = $pharmacy_details['pharmacy_name'];
$pharmacist_regNo = $pharmacy_details['pharmacist_reg_no'];
$address = $pharmacy_details['address'];
$med_image = $pharmacy_details['image'];
$med_name = $pharmacy_details['name'];
$med_quantity = $pharmacy_details['quantity'];
$med_quantity_unit = $pharmacy_details['quantity_unit'];
$med_price = $pharmacy_details['price'];




?>





<div class="item-top__container">
    <div class="item-top-left__container">

        <?php   echo "
        <img src='$provider_image' alt=''>
        <div class='provider__overview-detail'>
            <h2>$provider_name</h2>
            <h3>$pharmacy_name</h3>
            <p>Reg No : $pharmacist_regNo</p>
            <p>$address</p>
        </div>";
        ?>

    </div>

    <div class="item-top-right__container">
        <form action="">
            <div class="search-bar">
                <input type="text" placeholder="Search Product..." name="search">
                <i class="fa fa-search"></i>
            </div>
        </form>

        <?php
        foreach ($medicines_list as $medicines_list) {

            $list_med_image = $medicines_list['image'];
            $list_med_name = $medicines_list['name'];
            $list_med_quantity = $medicines_list['quantity'];
            $list_med_quantity_unit = $medicines_list['quantity_unit'];
            $list_med_price = $medicines_list['price'];


            echo "    <div class='overview - items'>
            <img src='$list_med_image' alt=''>
            <p class='overview-items__name'>$list_med_name </p>
            <p>$list_med_quantity  $list_med_quantity_unit</p>
            <p>Rs. $list_med_price</p>
        </div>";

        }

        ?>



    </div>

</div>

<div class="item-bottom-container">
    <div class="item-bottom-left-container">
        <div class="consumer-feedback">
            <div class="consumer-feedback__header">

                <div class="consumer-feedback__header-profile">
                    <img class="product-seller-orders-profile-pic" src="/assets/images/profilepic4.jpg" alt="">
                    <h3>Jack Henrick</h3>
                </div>
                <h4>12th of January 2023</h4>
            </div>
            <p class="consumer-dashboard__body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's
                standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                to
                make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                containing
                Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
                versions
                of Lorem Ipsum
            </p>
        </div>
        <div class="consumer-feedback">
            <div class="consumer-feedback__header">

                <div class="consumer-feedback__header-profile">
                    <img class="product-seller-orders-profile-pic" src="/assets/images/profilepic4.jpg" alt="">
                    <h3>Jane Roseld</h3>
                </div>
                <h4>12th of January 2023</h4>
            </div>
            <p class="consumer-dashboard__body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's
                standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                to
                make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                containing
                Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
                versions
                of Lorem Ipsum
            </p>
        </div>
        <div class="consumer-feedback">
            <div class="consumer-feedback__header">

                <div class="consumer-feedback__header-profile">
                    <img class="product-seller-orders-profile-pic" src="/assets/images/profilepic4.jpg" alt="">
                    <h3>Mary Shevon</h3>
                </div>
                <h4>12th of January 2023</h4>
            </div>
            <p class="consumer-dashboard__body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's
                standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it
                to
                make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                typesetting,
                remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets
                containing
                Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including
                versions
                of Lorem Ipsum
            </p>
        </div>
    </div>
    
    <div class="item-bottom-right-container">
        <h3>Give your feedback</h3>
        <form action="">
            <textarea name="" id="" cols="28" rows="17"></textarea>
        </form>
    </div>
</div>