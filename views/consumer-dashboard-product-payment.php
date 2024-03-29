<div class="consumer-product__payment-container">
    <h2>Payment Details</h2>

    <form id="payment-form">
        <div id="link-authentication-element">
            <!--Stripe.js injects the Link Authentication Element-->
        </div>
        <div id="payment-element">
            <!--Stripe.js injects the Payment Element-->
        </div>
        <button id="submit" class="btn btn-payment btn--block mt-4">
            <i class="fa-solid fa-spinner hidden" id="payment-spinner"></i>
            <span id="button-text">Pay now</span>
            <style>
                .btn-payment {
                    margin-top: 2rem
                }
                #payment-spinner {
                    animation: spin 1s linear infinite;
                }
                #payment-spinner.hidden {
                    display: none;
                }
                @keyframes spin {
                    0% {
                        transform: rotate(0deg);
                    }
                    100% {
                        transform: rotate(360deg);
                    }
                }
            </style>
        </button>
        <div id="payment-message" class="hidden"></div>
    </form>

<!--    <div class="overlay" id="consumer-payment-overlay">-->
<!--        <div class="modal" id="consumer-payment-modal">-->
<!--            <h3>Your Payment is successful</h3>-->
<!--            <img class="modal-img" src="/assets/images/sucessful.png" alt="">-->
<!--            <div class="modal-actions">-->
<!--                <button class="pay-btn" id="consumer-payment-ok-btn"><a href="/consumer-dashboard">Ok</a></button>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="overlay" id="delete-consumer-payment-overlay">-->
<!--        <div class="modal" id="delete-consumer-payment-modal">-->
<!---->
<!--        </div>-->
<!--    </div>-->


<!--    <script src="/assets/js/pages/consumer-payment.js"></script>-->
</div>

<script>
    /**
     *
     * @type {HTMLDivElement}
     */
    const paymentForm = document.querySelector('#payment-form');
    /**
     * @type {HTMLButtonElement}
     */
    const paymentSubmitBtn = document.querySelector("#submit")

    if (paymentForm) {
        let elements;

        const stripe = Stripe("pk_test_51MisoQB9kJ5FDFAyDuNbY1BHait7n2fiQoM9s1zupkOW6hJxnjeCglOBaOaNgWdNFmRoPyuMeuX9ori14IUwplMU00KUCgpU6n");
        console.log(stripe);
        const params = new URLSearchParams(window.location.search)
        const productID = params.get("product_id");

        async function getProductPrice() {

            try {
                const res = await fetch(`/verify-product-amount?product_id=${productID}`, {
                    method: "get"
                })
                const responseCode = res.status;
                console.log(responseCode);
                switch (responseCode){
                    case 200:
                        const data = await res.json();
                        const clientSecret = data.clientSecret;
                        console.log(`client secret is ${clientSecret}`);
                        elements = stripe.elements({clientSecret});

                        const linkAuthenticationElement = elements.create("linkAuthentication");
                        linkAuthenticationElement.mount("#link-authentication-element");

                        const paymentElementOptions = {
                            layout: "tabs",
                        };


                        const paymentElement = elements.create("payment", paymentElementOptions);
                        paymentElement.mount("#payment-element");
                        paymentSubmitBtn.classList.add("active")

                        break;
                    case 500:
                        const errorData = await res.json();
                        const errorMessage = errorData.message;
                        console.error(errorMessage);
                        break;
                }
            } catch (error){
                alert(error.message)
            }
        }

        getProductPrice();
        // initialize();
// checkStatus();

        paymentForm.addEventListener("submit", handleSubmit);

        let emailAddress = '';

// Fetches a payment intent and captures the client secret

        async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);

            const {error} = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    // Make sure to change this to your payment completion page
                    return_url: "https://1439-2401-dd00-1e-00-fffe.ngrok-free.app/checkout/success",
                    receipt_email: emailAddress,
                },
            });

            // This point will only be reached if there is an immediate error when
            // confirming the payment. Otherwise, your customer will be redirected to
            // your `return_url`. For some payment methods like iDEAL, your customer will
            // be redirected to an intermediate site first to authorize the payment, then
            // redirected to the `return_url`.
            if (error.type === "card_error" || error.type === "validation_error") {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occurred.");
            }

            setLoading(false);
        }

// ------- UI helpers -------

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function () {
                messageContainer.classList.add("hidden");
                messageContainer.textContent = "";
            }, 4000);
        }

// Show a spinner on payment submission
        function setLoading(isLoading) {
            if (isLoading) {
                // Disable the button and show a spinner
                document.querySelector("#submit").disabled = true;
                document.querySelector("#payment-spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#payment-spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
        }

    }

</script>