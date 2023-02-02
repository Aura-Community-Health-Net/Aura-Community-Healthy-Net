const addMedicineModalButton = document.querySelector("#add-med-btn");
const addMedicineModal = document.querySelector("#add-medicine-modal");
const addMedicineOverlay = document.querySelector("#add-medicine-overlay");
const addMedicineForm = document.querySelector("#add-medicine-form");
const addMedicineConfirmButton = document.querySelector("#add-medicine-ok-btn");
const addMedicineCancelButton = document.querySelector(
  "#add-medicine-cancel-btn"
);

const addMedicineImageInput = document.querySelector("#add_img");
const addMedicineImageButton = document.querySelector("#image-btn");
const addMedicineImageFilename = document.querySelector("#image-filename");

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

addMedicineOverlay.addEventListener("click", (e) => {
  if (e.target === addMedicineOverlay) {
    addMedicineCloseModal();
  }
});
