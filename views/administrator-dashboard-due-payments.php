<?php
/**
 * @var array $payments
 */
?>

<div class="due-payments__container-main">
    <form action="" class="due-payments__container">
        <input class="form-items--date-selector" type="date">
        <select class="form-items--dropdown" name="product-categories" id="product-categories">
            <option value="Doctor">Doctor</option>
            <option value="Pharmacy">Pharmacy</option>
            <option value="Product Seller">Product Seller</option>
        </select>

        <div class="due-payments__sort">
            <p>Sort <span><i class="fa-solid fa-arrow-up-wide-short"></i></span></p>
        </div>
    </form>

    <div class="due-payment__details-main">
        <div class="due-payments__details" >
            <h4>Profile Picture</h4>
            <h4>Provider Name</h4>
            <h4>Provider NIC</h4>
            <h4>Provider Type</h4>
            <h4>Amount</h4>
            <h4>Bank Acc Num</h4>
        </div>

        <?php
        foreach ($payments as $payment){
            $profile_picture = $payment['profile_picture'];
            $provider_name = $payment['name'];
            $provider_type = $payment['provider_type'];
            $account_num = $payment['bank_account_number'];
            $amount = number_format($payment["amount"], 2, '.', ',');
            $provider_nic = $payment['provider_nic'];
            echo "
            <div class='due-payments'>
                <img src='$profile_picture' class = 'due-payments__pro-pic' alt=''>
                <p>$provider_name</p>
                <p>$provider_nic</p>
                <p>$provider_type</p>
                <p>Rs $amount</p>
                <p>$account_num</p>
             
            </div>
            ";
        }
        ?>
    </div>


</div>

