import {Notifier} from "/assets/js/components/notifier.js"

const addToCartButton = document.querySelector("#add-to-cart-btn");


addToCartButton.addEventListener("click", async function (){
    try {
        const productId = addToCartButton.dataset.id;
        const response = await fetch(`/cart/add?product_id=${productId}`, {
            method: "post"
        })
        console.log(response)
        // const data  = await response.json();
        // console.log(data)
        if(response.status === 401) {
            Notifier.show("You are not authorized")
        } else if (response.status === 201) {
            Notifier.show("Successfully added to the cart")
        } else if (response.status === 204){
            Notifier.show("Item already in cart, increased the amount")
        }
    } catch (e) {
        console.log(e)
    }
})

