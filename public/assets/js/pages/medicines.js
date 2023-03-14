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


const updateMedicineModal = document.querySelector("#update-medicine-modal");
const updateMedicineOverlay = document.querySelector("#update-medicine-overlay");

// const updateMedicineConfirmButton = document.querySelector("#update-medicine-ok-btn");
// const updateMedicineCancelButton = document.querySelector("#update-medicine-cancel-btn");



const deleteMedicineButtons = document.querySelectorAll(".medicine-delete");
const updateMedicineButtons = document.querySelectorAll(".medicine-update");

const updateMedicineForm = document.querySelector("#update-medicine-form");


deleteMedicineButtons.forEach(function (deleteMed_button){
  deleteMed_button.addEventListener("click",() => {
          const elementID = deleteMed_button.id;
          const splittedID = elementID.split("-");

          deleteMedicineModal.innerHTML = `
              <h3>Do you really want to delete ${deleteMed_button.dataset.medicinename}</h3>
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

             deleteMedicineOpenModal();



  });
})


updateMedicineButtons.forEach(function (updateMed_Button){

  updateMed_Button.addEventListener("click",() => {

    const elementID = updateMed_Button.id;
    const splittedID = elementID.split("-");
    const tr = updateMed_Button.parentElement.parentElement;





    updateMedicineModal.innerHTML = `

           <h3>Update medicine information for ${updateMed_Button.dataset.medicinename}</h3>
            <div class="modal-actions">
               <form class="medicine-update-form" action="/pharmacy-dashboard/medicines/update?med_id=${splittedID[2]}" method="post">
                
                <label class="form-input__label" for="">Medicine Name</label>
                <input  class="form-input__input" type="text" name="med_name" value="${tr.dataset.medicinename}">
                <label class="form-input__label" for="">Quantity</label>
                <input class="form-input__input" type="text" name="quantity" value="${tr.dataset.medicinequantity}">
                <label class="form-input__label" for="">Quantity Unit</label>
                <input class="form-input__input" type="text" name="quantity_unit" value="${tr.dataset.medicinequantity_unit}">

                <label class="form-input__label" for="">Price</label>
                <input class="form-input__input" type="text" name="price" value="${tr.dataset.medicineprice}">
                <label class="form-input__label" for="">Stock</label>
                <input class="form-input__input" type="text" name="stock" value="${tr.dataset.medicinestock}">
                <label class="form-input__label" for="">Stock Unit</label>

                
                <div class="update-btn-section">
                    <button class="cancel-btn" id="update-medicine-cancel-btn" type="button">Cancel</button>
                    <button class="ok-btn" id="update-medicine-ok-btn" type="submit">Ok</button>
                </div>
               </form>

            <div>







    `;


    const updateMedCancelBtn =  updateMedicineModal.querySelector("#update-medicine-cancel-btn");
    updateMedCancelBtn.addEventListener("click",(e)=>{
      console.log("click on update button");
      if(e.target === updateMedCancelBtn)
      {
        updateMedicineCloseModal();
      }
    });

    updateMedicineOpenModal();












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
   console.log("Clicked add ok button")
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

function updateMedicineCloseModal(){
  updateMedicineOverlay.classList.remove("overlay-open");
  updateMedicineModal.classList.remove("modal-open");
  updateMedicineModal.classList.add("modal-close");
  updateMedicineOverlay.classList.add("overlay-close");
  setTimeout(() => {
    updateMedicineModal.style.display = "none";
    updateMedicineOverlay.style.display = "none";
    updateMedicineModal.classList.remove("modal-close");
    updateMedicineOverlay.classList.remove("overlay-close");
  }, 200);
}









function deleteMedicineOpenModal()
{

   deleteMedicineModal.style.display = "block";
   deleteMedicineOverlay.style.display="block";
   deleteMedicineModal.classList.add("modal-open");
   deleteMedicineOverlay.classList.add("overlay-open");
}

function updateMedicineOpenModal()
{
  updateMedicineModal.style.display = "block";
  updateMedicineOverlay.style.display="block";
  updateMedicineModal.classList.add("modal-open");
  updateMedicineOverlay.classList.add("overlay-open");

}

//
// updateMedicineConfirmButton.addEventListener("click", () => {
//   console.log("Clicked add ok button")
//   updateMedicineForm.submit();
// });












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
});


updateMedicineOverlay.addEventListener("click",(e)=>{
  if(e.target === updateMedicineOverlay)
  {
     updateMedicineCloseModal();
  }
})


