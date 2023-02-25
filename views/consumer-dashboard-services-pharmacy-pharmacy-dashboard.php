<?php
/**
 * @var array $medicines
 * @var array $pharmacy
 */



$provider_image = $pharmacy['profile_picture'];
$provider_name = $pharmacy['name'];
$pharmacy_name = $pharmacy['pharmacy_name'];
$pharmacist_regNo = $pharmacy['pharmacist_reg_no'];
$address = $pharmacy['address'];
//$med_image = $pharmacy['image'];
//$med_name = $pharmacy['name'];
//$med_quantity = $pharmacy['quantity'];
//$med_quantity_unit = $pharmacy['quantity_unit'];
//$med_price = $pharmacy['price'];




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
        foreach ($medicines as $medicine) {

            $list_med_image = $medicine['image'];
            $list_med_name = $medicine['name'];
            $list_med_quantity = $medicine['quantity'];
            $list_med_quantity_unit = $medicine['quantity_unit'];
            $list_med_price = $medicine['price'];


            echo "    <div class='overview-items'>
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