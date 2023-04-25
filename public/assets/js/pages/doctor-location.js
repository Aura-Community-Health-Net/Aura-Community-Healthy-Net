const customerLocationModal = document.querySelector("#customer-location-modal");
const customerLocationOverlay = document.querySelector("#customer-location-overlay");
const customerLocationButtons = document.querySelectorAll(".customer-location");

const openCustomerLocationModal = () => {
    customerLocationModal.style.display = "block";
    customerLocationOverlay.style.display = "block";
    customerLocationModal.classList.add("modal-open");
    customerLocationOverlay.classList.add("overlay-open");
};

customerLocationOverlay?.addEventListener("click", (e) => {
    console.log("click on overlay");
    if (e.target === customerLocationOverlay) {
        closeCustomerLocationModal();
    }
});

function closeCustomerLocationModal() {
    customerLocationOverlay.classList.remove("overlay-open");
    customerLocationModal.classList.remove("modal-open");
    customerLocationModal.classList.add("modal-close");
    customerLocationOverlay.classList.add("overlay-close");
    setTimeout(() => {
        customerLocationModal.style.display = "none";
        customerLocationOverlay.style.display = "none";
        customerLocationModal.classList.remove("modal-close");
        customerLocationOverlay.classList.remove("overlay-close");
    }, 200);
}

function attachLocationButtonListener(button){
    button.addEventListener("click", function () {

        //console.log(button.dataset)
        openCustomerLocationModal();
    });
}
customerLocationButtons.forEach(attachLocationButtonListener);