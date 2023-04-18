

const consumerPaymentForm = document.querySelector("#consumer-payment-form");
const consumerPaymentOverlay = document.querySelector("#consumer-payment-overlay");
const consumerPaymentOKBtn = document.querySelector("#consumer-payment-ok-btn");

const deletePaymentModal = document.querySelector("#consumer-payment-modal");
const deletePaymentOverlay = document.querySelector("#consumer-payment-overlay");

// const nameInput = document.getElementById("name");
// const weightInput = document.getElementById("weight");
// const priceInput = document.getElementById("price");
// const stock = document.getElementById("stock");

// const productImageUploadButton = document.querySelector("#image-btn");
// const productImageInput = document.querySelector("#image");
// const productImageFilename = document.querySelector("#image-filename");
//
// const deletePaymentButtons = document.querySelectorAll(".product-delete");



consumerPaymentOKBtn.addEventListener("click", () => {
    consumerPaymentForm.submit();
});

consumerPaymentOverlay.addEventListener("click", (e) => {
    console.log("click on overlay");
    if (e.target === consumerPaymentOverlay) {
        closeConsumerPaymentModal();
    }
});
;

function closeConsumerPaymentModal() {
    consumerPaymentOverlay.classList.remove("overlay-open");
    consumerPaymentModal.classList.remove("modal-open");
    consumerPaymentModal.classList.add("modal-close");
    consumerPaymentOverlay.classList.add("overlay-close");
    setTimeout(() => {
        consumerPaymentModal.style.display = "none";
        consumerPaymentOverlay.style.display = "none";
        consumerPaymentModal.classList.remove("modal-close");
        consumerPaymentOverlay.classList.remove("overlay-close");
    }, 200);
}

const openDeleteProductModal = () => {
    deletePaymentModal.style.display = "block";
    deletePaymentOverlay.style.display = "block";
    deletePaymentModal.classList.add("modal-open");
    deletePaymentOverlay.classList.add("overlay-open");
};

deletePaymentOverlay.addEventListener("click", (e) => {
    console.log("click on overlay");
    if (e.target === deletePaymentOverlay) {
        closeDeleteProductModal();
    }
});

function closeDeleteProductModal() {
    deletePaymentOverlay.classList.remove("overlay-open");
    deletePaymentModal.classList.remove("modal-open");
    deletePaymentModal.classList.add("modal-close");
    deletePaymentOverlay.classList.add("overlay-close");
    setTimeout(() => {
        deletePaymentModal.style.display = "none";
        deletePaymentOverlay.style.display = "none";
        deletePaymentModal.classList.remove("modal-close");
        deletePaymentOverlay.classList.remove("overlay-close");
    }, 200);
}

openConsumerPaymentModal();
