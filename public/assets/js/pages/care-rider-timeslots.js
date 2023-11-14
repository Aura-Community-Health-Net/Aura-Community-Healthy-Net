const addCareRiderTimeslotModalButton = document.querySelector("#add-care-rider-timeslot-btn");
const addCareRiderTimeslotModal = document.querySelector("#add-care-rider-timeslot-modal");
const addCareRiderTimeslotOverlay = document.querySelector("#add-care-rider-timeslot-overlay");
const addCareRiderTimeslotForm = document.querySelector("#add-care-rider-timeslot-form");
const addCareRiderTimeslotConfirmButton = document.querySelector("#add-care-rider-timeslot-ok-btn");
addCareRiderTimeslotCancelButton = document.querySelector("#add-care-rider-timeslot-cancel-btn");

addCareRiderTimeslotConfirmButton.addEventListener("click", () => {
    //addCareRiderTimeslotForm.submit();
    addCareRiderFinalButton.click()
});
addCareRiderTimeslotCancelButton.addEventListener("click", () => {
    addCareRiderTimeslotCloseModal();
});
const addCareRiderFinalButton = document.querySelector("#add-care-rider-time-slot-final-button");
const deleteCareRiderTimeslotModal = document.querySelector("#delete-care-rider-timeslot-modal");
const deleteCareRiderTimeslotOverlay = document.querySelector("#delete-care-rider-timeslot-overlay");
const deleteCareRiderTimeslotButtons = document.querySelectorAll(".care-rider-timeslot-delete");

const editCareRiderTimeSlotModal = document.querySelector("#edit-care-rider-timeslot-modal");
const editCareRiderTimeSlotOverlay = document.querySelector("#edit-care-rider-timeslot-overlay");
const editCareRiderTimeSlotButtons = document.querySelectorAll(".care-rider-timeslot-edit");


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


const openEditCareRiderTimeSlotModal = () => {
    editCareRiderTimeSlotModal.style.display = "block";
    editCareRiderTimeSlotOverlay.style.display = "block";
    editCareRiderTimeSlotModal.classList.add("modal-open");
    editCareRiderTimeSlotOverlay.classList.add("overlay-open");
};

editCareRiderTimeSlotOverlay.addEventListener("click", (e) => {
    console.log("click on overlay");
    if (e.target === editCareRiderTimeSlotOverlay) {
        closeEditCareRiderTimeSlotModal();
    }
});

function closeEditCareRiderTimeSlotModal() {
    editCareRiderTimeSlotOverlay.classList.remove("overlay-open");
    editCareRiderTimeSlotModal.classList.remove("modal-open");
    editCareRiderTimeSlotModal.classList.add("modal-close");
    editCareRiderTimeSlotOverlay.classList.add("overlay-close");
    setTimeout(() => {
        editCareRiderTimeSlotModal.style.display = "none";
        editCareRiderTimeSlotOverlay.style.display = "none";
        editCareRiderTimeSlotModal.classList.remove("modal-close");
        editCareRiderTimeSlotOverlay.classList.remove("overlay-close");
    }, 200);
}

function attachEditButtonListener(button){
    button.addEventListener("click", function () {

        const slotNo = button.dataset.slot;
        console.log(slotNo)

        const date =button.dataset.date;
        console.log(date);

        const fromTime =button.dataset.fromtime;
        console.log(fromTime);

        const toTime =button.dataset.totime;
        console.log(toTime);




        editCareRiderTimeSlotModal.innerHTML = `<h3>Enter the details to Edit</h3>
<form action="/care-rider-dashboard/timeslot/update?slotNo=${slotNo}" class="care-rider-timeslots-form"  id="edit-care-rider-timeslot-form" method="POST">
        <table class="items-table">
            <thead>
                <tr>
                      <th >Date</th>
                      <th >From Time</th>
                      <th >To Time</th>
                </tr>
            </thead>
            <tbody>
                   <tr>
                       <td><input type="date" id="edit-date" name="edit-date"></td>
                       <td><input type="time" id="edit-from-time" name="edit-fromTime"></td>
                       <td><input type="time" id="edit-to-time" name="edit-toTime"></td>
                   </tr>           
            </tbody>
        </table>

        <div class="modal-actions">
            <button class="cancel-btn" id="edit-cancel-btn">Cancel</button>
           
                <button class="ok-btn" id="edit-ok-btn">Ok</button>
</form>
        </div>
        `;
        document.getElementById("edit-date").value = date;
        document.getElementById("edit-from-time").value = fromTime;
        document.getElementById("edit-to-time").value = toTime;

        const editCancelBtn = editCareRiderTimeSlotModal.querySelector("#edit-cancel-btn");
        editCancelBtn.addEventListener("click", (e) => {
            console.log("click on cancel button");
            if (e.target === editCancelBtn) {
                closeEditCareRiderTimeSlotModal();
            }
        });

        openEditCareRiderTimeSlotModal();
    });
}
editCareRiderTimeSlotButtons.forEach(attachEditButtonListener);

function CareRider(val) {

    jQuery.ajax({
        url: '/consumer-dashboard/services/care-rider',
        type: 'GET',
        data: JSON.stringify(val),
        contentType: 'application/json; charset=utf-8',
        success: function (data) {
            alert(data.success);
        },
        error: function () {
            alert("error");
        },
        async: false
    });
}