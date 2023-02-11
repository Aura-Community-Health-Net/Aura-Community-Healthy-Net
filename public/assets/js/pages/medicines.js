const addMedicineModalButton = document.querySelector("#add-med-btn");
const addMedicineModal = document.querySelector("#add-medicine-modal");
const addMedicineOverlay = document.querySelector("#add-medicine-overlay");
const addMedicineForm = document.querySelector("#add-medicine-form");
const addMedicineConfirmButton = document.querySelector("#add-medicine-ok-btn");
const addMedicineCancelButton = document.querySelector("#add-medicine-cancel-btn");



const addMedicineImageInput = document.querySelector("#add_img");
const addMedicineImageButton = document.querySelector("#image-btn");
const addMedicineImageFilename = document.querySelector("#image-filename");


const deleteMedicineModal =  document.querySelector("#delete-medicine-modal");
const deleteMedicineOverlay = document.querySelector("#delete-medicine-overlay");

const deleteMedicineConfirmButton = document.querySelector("#delete-medicine-ok-btn");
const deleteMedicineCancelButton = document.querySelector("#delete-medicine-cancel-btn");


const deleteMedicineButtons = document.querySelectorAll(".medicine-delete");

deleteMedicineButtons.forEach(function (button){
  button.addEventListener("click",() => {
          const elementID = button.id;
          const splittedID = elementID.split("-");

          deleteMedicineModal.innerHTML = `
              <h3>Do you really want to delete ${button.dataset.medicinename}</h3>
            <img class="modal-img" src="/assets/images/confirmation.jpg" alt="">
            <div class="modal-actions">
              <button class="cancel-btn" id="delete-medicine-cancel-btn">Cancel</button>
              <form action="/pharmacy-dashboard/medicines/delete?med_id=${splittedID[2]}" method="post">
                   <button class="ok-btn" id="delete-medicine-ok-btn">ok</button>
              </form>
            </div>
  `;


          const deleteMedCancelBtn =  deleteMedicineModal.querySelector("#delete-medicine-cancel-btn");
          deleteMedCancelBtn.addEventListener("click",(e)=>{
            console.log("click on cancel button");
            if(e.target === deleteMedCancelBtn)
            {
              deleteMedicineCloseModal();
            }
          });

            /* deleteMedicineOpenModal();*/



  });
})















addMedicineImageButton.addEventListener("click", () => {
  addMedicineImageInput.click();
});

addMedicineImageInput.addEventListener("change", function () {
  if (this.files && this.files.length > 0) {
    addMedicineImageFilename.innerHTML = this.files[0].name;
  }
});







addMedicineConfirmButton.addEventListener("click", () => {
  addMedicineForm.submit();
});

addMedicineCancelButton.addEventListener("click", () => {
  addMedicineCloseModal();
});







addMedicineModalButton.addEventListener("click", () => {
  console.log("clicked");
  addMedicineModal.style.display = "flex";
  addMedicineModal.style.flexDirection = "column";
  addMedicineOverlay.style.display = "block";
  addMedicineModal.classList.add("modal-open");
});

function addMedicineCloseModal() {
  addMedicineOverlay.classList.remove("overlay-open");
  addMedicineModal.classList.remove("modal-open");
  addMedicineModal.classList.add("modal-close");
  addMedicineOverlay.classList.add("overlay-close");
  setTimeout(() => {
    addMedicineModal.style.display = "none";
    addMedicineOverlay.style.display = "none";
    addMedicineModal.classList.remove("modal-close");
    addMedicineOverlay.classList.remove("overlay-close");
  }, 200);
}

function deleteMedicineCloseModal(){

  deleteMedicineOverlay.classList.remove("overlay-open");
  deleteMedicineModal.classList.remove("modal-open");
  deleteMedicineModal.classList.add("modal-close");
  deleteMedicineOverlay.classList.add("overlay-close");
  setTimeout(() => {
    deleteMedicineModal.style.display = "none";
    deleteMedicineOverlay.style.display = "none";
    deleteMedicineModal.classList.remove("modal-close");
    deleteMedicineOverlay.classList.remove("overlay-close");
  }, 200);




}

addMedicineOverlay.addEventListener("click", (e) => {
  if (e.target === addMedicineOverlay) {
    addMedicineCloseModal();
  }
});


deleteMedicineOverlay.addEventListener("click",(e)=>{
  if(e.target === deleteMedicineOverlay)
  {
    deleteMedicineCloseModal();
  }
})


