
const addtimeslotModalButton = document.getElementById("add-timeslot-btn");
const addtimeslotModal = document.querySelector("#add-timeslot-modal");
const addtimeslotForm = document.querySelector("#add-timeslot-form");
const addtimeslotOverlay = document.querySelector("#add-timeslot-overlay");
const addtimeslotOKBtn = document.querySelector("#add-timeslot-ok-btn");
const addtimeslotCancelBtn = document.querySelector("#add-timeslot-cancel-btn");

const deletetimeslotModal = document.querySelector("#delete-timeslot-modal");
const deletetimeslotOverlay = document.querySelector("#delete-timeslot-overlay");
const deletetimeslotButtons = document.querySelectorAll(".timeslot-delete");

const edittimeslotModal = document.querySelector("#edit-timeslot-modal");
const edittimeslotOverlay = document.querySelector("#edit-timeslot-overlay");
const edittimeslotButtons = document.querySelectorAll(".timeslot-edit");

addtimeslotModalButton.addEventListener("click", () => {
    addtimeslotModal.style.display = "block";
    addtimeslotOverlay.style.display = "block";
    addtimeslotModal.classList.add("modal-open");
    addtimeslotOverlay.classList.add("overlay-open");
});

addtimeslotOKBtn.addEventListener("click", () => {
    addtimeslotForm.submit();
});

addtimeslotOverlay.addEventListener("click", (e) => {
    console.log("click on overlay");
    if (e.target === addtimeslotOverlay) {
        closeAddtimeslotModal();
    }
});

addtimeslotCancelBtn.addEventListener("click", (e) => {
    console.log("click on cancel button");
    if (e.target === addtimeslotCancelBtn) {
        closeAddtimeslotModal();
    }
});

function closeAddtimeslotModal() {
    addtimeslotOverlay.classList.remove("overlay-open");
    addtimeslotModal.classList.remove("modal-open");
    addtimeslotModal.classList.add("modal-close");
    addtimeslotOverlay.classList.add("overlay-close");
    setTimeout(() => {
        addtimeslotModal.style.display = "none";
        addtimeslotOverlay.style.display = "none";
        addtimeslotModal.classList.remove("modal-close");
        addtimeslotOverlay.classList.remove("overlay-close");
    }, 200);
}



const openDeletetimeslotModal = () => {
    deletetimeslotModal.style.display = "block";
    deletetimeslotOverlay.style.display = "block";
    deletetimeslotModal.classList.add("modal-open");
    deletetimeslotOverlay.classList.add("overlay-open");
};

deletetimeslotOverlay.addEventListener("click", (e) => {
    console.log("click on overlay");
    if (e.target === deletetimeslotOverlay) {
        closeDeletetimeslotModal();
    }
});

function closeDeletetimeslotModal() {
    deletetimeslotOverlay.classList.remove("overlay-open");
    deletetimeslotModal.classList.remove("modal-open");
    deletetimeslotModal.classList.add("modal-close");
    deletetimeslotOverlay.classList.add("overlay-close");
    setTimeout(() => {
        deletetimeslotModal.style.display = "none";
        deletetimeslotOverlay.style.display = "none";
        deletetimeslotModal.classList.remove("modal-close");
        deletetimeslotOverlay.classList.remove("overlay-close");
    }, 200);
}

function attachDeleteButtonListener(button){
    button.addEventListener("click", function () {

        //console.log(button.dataset)
        const slotNo = button.dataset.slot;
        console.log(slotNo)


        deletetimeslotModal.innerHTML = `
         <h3>Do you really want to Delete</h3>
        <img class="modal-img" src="/assets/images/confirmation.jpg" alt="">
        <div class="modal-actions">
            <button class="cancel-btn" id="delete-cancel-btn">Cancel</button>
            <form action="/doctor-dashboard/timeslots/delete?slotNo=${slotNo}" method="post">
                <button class="ok-btn" id="delete-ok-btn">Ok</button>
            </form>
        </div>
        `;
        const deleteCancelBtn = deletetimeslotModal.querySelector("#delete-cancel-btn");
        deleteCancelBtn.addEventListener("click", (e) => {
            console.log("click on cancel button");
            if (e.target === deleteCancelBtn) {
                closeDeletetimeslotModal();
            }
        });

        openDeletetimeslotModal();
    });
}
deletetimeslotButtons.forEach(attachDeleteButtonListener);


const openEdittimeslotModal = () => {
    edittimeslotModal.style.display = "block";
    edittimeslotOverlay.style.display = "block";
    edittimeslotModal.classList.add("modal-open");
    edittimeslotOverlay.classList.add("overlay-open");
};

edittimeslotOverlay.addEventListener("click", (e) => {
    console.log("click on overlay");
    if (e.target === edittimeslotOverlay) {
        closeEdittimeslotModal();
    }
});

function closeEdittimeslotModal() {
    edittimeslotOverlay.classList.remove("overlay-open");
    edittimeslotModal.classList.remove("modal-open");
    edittimeslotModal.classList.add("modal-close");
    edittimeslotOverlay.classList.add("overlay-close");
    setTimeout(() => {
        edittimeslotModal.style.display = "none";
        edittimeslotOverlay.style.display = "none";
        edittimeslotModal.classList.remove("modal-close");
        edittimeslotOverlay.classList.remove("overlay-close");
    }, 200);
}

function attachEditButtonListener(button){
    button.addEventListener("click", function () {

        const slotNo = button.dataset.slot;
        console.log(slotNo)


        edittimeslotModal.innerHTML = `<h3>Do you really want to Edit</h3>
       <table class="items-table">
            <thead>
        <tr>
            <th>Slot No</th>
            <th >Date</th>
            <th >Day</th>
            <th >From Time</th>
            <th >To Time</th>
        </tr>
            </thead>
            <tbody>
                   <tr>
                   <td></td>
                   </tr>
            </tbody>
        </table>
        <div class="modal-actions">
            <button class="cancel-btn" id="edit-cancel-btn">Cancel</button>
            <form action="/doctor-dashboard/timeslots/edit?slotNo=${slotNo}" method="post">
                <button class="ok-btn" id="edit-ok-btn">Ok</button>
            </form>
        </div>
        `;
        const editCancelBtn = edittimeslotModal.querySelector("#edit-cancel-btn");
        editCancelBtn.addEventListener("click", (e) => {
            console.log("click on cancel button");
            if (e.target === editCancelBtn) {
                closeEdittimeslotModal();
            }
        });

        openEdittimeslotModal();
    });
}

edittimeslotButtons.forEach(attachEditButtonListener);