const addCareRiderTimeslotModalButton = document.querySelector("#add-care-rider-timeslot-btn");
const addCareRiderTimeslotModal = document.querySelector("#add-care-rider-timeslot-modal");
const addCareRiderTimeslotOverlay = document.querySelector("#add-care-rider-timeslot-overlay");
const addCareRiderTimeslotForm = document.querySelector("#add-care-rider-timeslot-form");
const addCareRiderTimeslotConfirmButton = document.querySelector("#add-care-rider-timeslot-ok-btn");
const addCareRiderTimeslotCancelButton = document.querySelector(
    "#add-care-rider-timeslot-cancel-btn"
);



addCareRiderTimeslotConfirmButton.addEventListener("click", () => {
    addCareRiderTimeslotForm.submit();
});

addCareRiderTimeslotCancelButton.addEventListener("click", () => {
    addCareRiderTimeslotCloseModal();
});

addCareRiderTimeslotModalButton.addEventListener("click", () => {
    console.log("clicked");
    addCareRiderTimeslotModal.style.display = "flex";
    addCareRiderTimeslotModal.style.flexDirection = "column";
    addCareRiderTimeslotOverlay.style.display = "block";
    addCareRiderTimeslotModal.classList.add("modal-open");
});

function addCareRiderTimeslotCloseModal() {
    addCareRiderTimeslotOverlay.classList.remove("overlay-open");
    addCareRiderTimeslotModal.classList.remove("modal-open");
    addCareRiderTimeslotModal.classList.add("modal-close");
    addCareRiderTimeslotOverlay.classList.add("overlay-close");
    setTimeout(() => {
        addCareRiderTimeslotModal.style.display = "none";
        addCareRiderTimeslotOverlay.style.display = "none";
        addCareRiderTimeslotModal.classList.remove("modal-close");
        addCareRiderTimeslotOverlay.classList.remove("overlay-close");
    }, 200);
}

addCareRiderTimeslotOverlay.addEventListener("click", (e) => {
    if (e.target === addCareRiderTimeslotOverlay) {
        addCareRiderTimeslotCloseModal();
    }
});
