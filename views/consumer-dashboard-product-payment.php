<div class="consumer-product__payment-container">
    <h2>Payment Details</h2>
    <form action="">
        <div class="consumer-product__card-type">
            <label class="consumer-payment__label" for="">Card Type</label>
            <div class="consumer-product__card-options">
                <div>
                    <img src="/assets/images/visa.jpg" alt="">
                    <label for="visa">Visa</label>
                    <input type="radio" id="visa" name="card-type">
                </div>
                <div>
                    <img src="/assets/images/master-card.png" alt="">
                    <label for="master">Master Card</label>
                    <input type="radio" id="master" name="card-type">
                </div>
            </div>
        </div>
        
        <div class="consumer-product__card-num">
            <label class="consumer-payment__label" for="">Card Number</label>
            <input class="consumer-payment__input" type="text">
        </div>

        <div class=consumer-product__expire-date>
            <label class="consumer-payment__label" for="">Expiration Date</label>
            <input class="consumer-payment__input" type="date">

        </div>
        
        <div class="consumer-product__cvn">
            <label class="consumer-payment__label" for="">CVN</label>
            <div>
                <input class="consumer-payment__input" type="text">
                <i class="fa-solid fa-circle-info"></i>
            </div>
<!--            <p>This code is a three or four digits number printed on the back or front of credit cards</p>-->
        </div>

        <button type="button" class="product__pay-btn" id="product__pay-btn">Pay</button>
    </form>

    <div class="overlay" id="consumer-payment-overlay">
        <div class="modal" id="consumer-payment-modal">
            <h3>Your Payment is successful</h3>
            <img class="modal-img" src="/assets/images/sucessful.png" alt="">
            <div class="modal-actions">
                <button class="pay-btn" id="consumer-payment-ok-btn">Ok</button>
            </div>
        </div>
    </div>
    <div class="overlay" id="delete-consumer-payment-overlay">
        <div class="modal" id="delete-consumer-payment-modal">

        </div>
    </div>
    <script src="/assets/js/pages/consumer-payment.js"></script>
</div>