
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



    <script src="/assets/js/pages/consumer-payment.js"></script>

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

        const params = new URLSearchParams(window.location.search)
        const medicinesRequestID = params.get("id");
        console.log(medicinesRequestID);

        async  function getMedicinesPrice(){
        try {
            const res = await fetch(`/verify-medicines-amount?id=${medicinesRequestID}`, {
                method: "get"
            })

            const data = await res.json();
            console.log(data)

        }catch (error){
            alert(error.message)
        }



            // const responseCode = res.status;
            // console.log(responseCode);
            // switch (responseCode){
            //     case 200:
            //         const data = await res.json();
            //         const clientSecret = data.clientSecret;
            //         console.log(`client secret is ${clientSecret}`);
            //         elements = stripe.elements({clientSecret});
            //
            //         const  linkAuthenticationElement = elements.create("linkAuthentication")
            //         linkAuthenticationElement.moun

            }



        }




</script>
