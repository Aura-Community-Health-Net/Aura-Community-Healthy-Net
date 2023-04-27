const locationButtons = document.querySelectorAll(".location-btn");

function attachLocationButtonListener(button){
    button.addEventListener("click", function () {
        const lat = button.dataset.lat;
        const lng = button.dataset.lng;

    });
}

locationButtons.forEach(attachLocationButtonListener);