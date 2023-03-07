const addCareRiderTimeslotModalButton = document.querySelector("#add-care-rider-timeslot-btn");
const addCareRiderTimeslotModal = document.querySelector("#add-care-rider-timeslot-modal");
const addCareRiderTimeslotOverlay = document.querySelector("#add-care-rider-timeslot-overlay");
const addCareRiderTimeslotForm = document.querySelector("#add-care-rider-timeslot-form");
const addCareRiderTimeslotConfirmButton = document.querySelector("#add-care-rider-timeslot-ok-btn");
addCareRiderTimeslotCancelButton = document.querySelector("#add-care-rider-timeslot-cancel-btn");
addCareRiderTimeslotConfirmButton.addEventListener("click", () => {addCareRiderTimeslotForm.submit();});
addCareRiderTimeslotCancelButton.addEventListener("click", () => {addCareRiderTimeslotCloseModal();});

const deleteCareRiderTimeslotModal = document.querySelector("#delete-care-rider-timeslot-modal");
const deleteCareRiderTimeslotOverlay = document.querySelector("#delete-care-rider-timeslot-overlay");
const deleteCareRiderTimeslotButtons = document.querySelectorAll(".care-rider-timeslot-delete");


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
const openDeleteCareRiderTimeslotModal = () => {
    deleteCareRiderTimeslotModal.style.display = "block";
    deleteCareRiderTimeslotOverlay.style.display = "block";
    deleteCareRiderTimeslotModal.classList.add("modal-open");
    deleteCareRiderTimeslotOverlay.classList.add("overlay-open");
};

deleteCareRiderTimeslotOverlay.addEventListener("click", (e) => {
    console.log("click on overlay");
    if (e.target === deleteCareRiderTimeslotOverlay) {
        closeDeleteCareRiderTimeslotModal();
    }
});

function closeDeleteCareRiderTimeslotModal() {
    deleteCareRiderTimeslotOverlay.classList.remove("overlay-open");
    deleteCareRiderTimeslotModal.classList.remove("modal-open");
    deleteCareRiderTimeslotModal.classList.add("modal-close");
    deleteCareRiderTimeslotOverlay.classList.add("overlay-close");
    setTimeout(() => {
        deleteCareRiderTimeslotModal.style.display = "none";
        deleteCareRiderTimeslotOverlay.style.display = "none";
        deleteCareRiderTimeslotModal.classList.remove("modal-close");
        deleteCareRiderTimeslotOverlay.classList.remove("overlay-close");
    }, 200);
}

function attachDeleteButtonListener(button){
    button.addEventListener("click", function () {

        //console.log(button.dataset)
        const slotNo = button.dataset.slot;
        console.log(slotNo)


        deleteCareRiderTimeslotModal.innerHTML = `
         <h3>Do you really want to delete</h3>
        <img class="modal-img" src="/assets/images/confirmation.jpg" alt="">
        <div class="modal-actions">
            <button class="cancel-btn" id="delete-cancel-btn">Cancel</button>
            <form action="/care-rider-dashboard/timeslot/delete?slotNo=${slotNo}" method="post">
                <button class="ok-btn" id="delete-ok-btn">Ok</button>
            </form>
        </div>
        `;
        const deleteCancelBtn =
            deleteCareRiderTimeslotModal.querySelector("#delete-cancel-btn");
        deleteCancelBtn.addEventListener("click", (e) => {
            console.log("click on cancel button");
            if (e.target === deleteCancelBtn) {
                closeDeleteCareRiderTimeslotModal();
            }
        });

        openDeleteCareRiderTimeslotModal();
    });
}
deleteCareRiderTimeslotButtons.forEach(attachDeleteButtonListener);

