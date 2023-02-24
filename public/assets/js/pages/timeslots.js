
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

        const date =button.dataset.date;
        console.log(date);

        const fromTime =button.dataset.fromtime;
        console.log(fromTime);

        const toTime =button.dataset.totime;
        console.log(toTime);




        edittimeslotModal.innerHTML = `<h3>Enter the details to Edit</h3>
<form action="/doctor-dashboard/timeslots/edit?slotNo=${slotNo}" class="timeslots-form"  id="edit-timeslot-form" method="POST">
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

function timeSlotDate(val){
    console.log(val);
        var  filter, table, tr, td, i, txtValue;
        filter = val;
        table = document.getElementById("doctor-available-slot");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }

}

function filterDoctor(){

    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("doctor-categories");
    filter = input.value;
    console.log(filter);
    table = document.getElementById("doctor-container");
    tr = table.getElementsByTagName("div");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("h2")[1];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }

}


