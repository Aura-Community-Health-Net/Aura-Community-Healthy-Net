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
        const appointmentID = params.get("appointment_id");
        console.log(appointmentID);

        async function getDoctorFees() {

            try {
                const res = await fetch(`/verify-DoctorFees-amount?appointment_id=${appointmentID}`, {
                    method: "get"
                })
                const responseCode = res.status;
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
                        console.log(errorData);
                        return;
                }
            } catch (error){
                alert(error.message)
            }
        }

        getDoctorFees();
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
                    return_url: "https://01db-2401-dd00-1e-00-fffe.ngrok-free.app/doctor/payment/success",
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