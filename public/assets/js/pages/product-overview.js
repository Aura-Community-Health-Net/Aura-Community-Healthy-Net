import {Notifier} from "/assets/js/components/notifier.js"

const addToCartButtons = document.querySelectorAll(".add-to-cart-btn");


addToCartButtons.forEach((addToCartButton) => {

    addToCartButton.addEventListener("click", async function (e) {
        e.stopPropagation();
        try {
            const productId = addToCartButton.dataset.id;
            const response = await fetch(`/cart/add?product_id=${productId}`, {
                method: "post"
            })
            console.log(response)
            // const data  = await response.json();
            // console.log(data)
            if (response.status === 401) {
                Notifier.show("You are not authorized")
            } else if (response.status === 201) {
                Notifier.show("Successfully added to the cart")
            } else if (response.status === 204) {
                Notifier.show("Item already in cart, increased the amount")
            } else if (response.status === 400){
                Notifier.show("Item is out of stock")
            }
        } catch (e) {
            console.log(e)
        }
    })
})

