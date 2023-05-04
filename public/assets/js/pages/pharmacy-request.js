const uploadPresModal = document.querySelector("#pharmacy-request-modal");
const uploadPresOverlay = document.querySelector("#pharmacy-request-overlay");







const addprescriptionForm = document.querySelector("#pharmacy-request-form");
const uploadPresButtons = document.querySelectorAll(".pharmacy-request");


uploadPresButtons.forEach(function (attach_prescription_Button){

    attach_prescription_Button.addEventListener("click",()=>{
        const elementID = attach_prescription_Button.dataset.pharmacyid;
        console.log(elementID);

        const tr = attach_prescription_Button.parentElement.parentElement;

        uploadPresModal.innerHTML = `
        
        <h3>Attach your Prescription for ${attach_prescription_Button.dataset.pharmacyname}</h3>
        
        <div class="modal-actions">
        
        <form class="pharmacy-request-form" id="pharmacy-request-form" action="/consumer-dashboard/services/pharmacy?pharmacy_id=${elementID}"  method="post" enctype="multipart/form-data">
       
              <div class="form-input">
                <label class="form-input__label" for="">Prescription</label>

                <input  id="prescription" type="file" name="prescription"
                    style="display: none; visibility: hidden" accept="image/*" required>

                <div class="form-upload-component">
                    <button class="upload-btn" id="prescription-upload-btn" type="button">
                        <i class="fa-regular fa-plus"></i>
                    </button>
                    <div id="prescription-filename"></div>
                </div>
              </div>
            

            <label class="form-input__label" for="">Remark</label>
            <input  class="form-input__input" type="text" name="customer_remark">
            
            <button class="ok-btn" id="attach-prescription-ok-btn" type="submit">ok</button>
            <button class="cancel-btn" id="attach-prescription-cancel-btn">cancel</button>
        
        
        </form>
      </div>
        
        
        `;

        const addprescriptionImageInput = uploadPresModal.querySelector("#prescription");
        const addprescriptionImageButton = uploadPresModal.querySelector("#prescription-upload-btn");
        const addprescriptionImageFilename = uploadPresModal.querySelector("#prescription-filename");
        const uploadPresConfirmBtn = document.querySelector("#attach-prescription-ok-btn");
        const uploadPresCancelBtn = document.querySelector("#attach-prescription-cancel-btn");

        addprescriptionImageButton.addEventListener("click", () => {
            addprescriptionImageInput.click();
        });

        addprescriptionImageInput.addEventListener("change",  (e)=> {
            if (e.target.files && e.target.files.length > 0) {
                addprescriptionImageFilename.innerHTML = e.target.files[0].name;
            }
        });

        uploadPresConfirmBtn.addEventListener("click", () => {
            console.log("Clicked add ok button")
            addprescriptionForm.submit();
        });

        uploadPresCancelBtn.addEventListener("click", () => {
            uploadPresCloseModal();
        });




        const uploadPresCancelButton = document.querySelector("#attach-prescription-cancel-btn");
        uploadPresCancelButton.addEventListener("click",(e)=>{
            if(e.target === uploadPresCancelButton)
            {
                uploadPresCloseModal();
            }
        });

        uploadPresOpenModal();

    });
})





















function uploadPresOpenModal()
{

    uploadPresModal.style.display = "block";
    uploadPresOverlay.style.display="block";
    uploadPresModal.classList.add("modal-open");
    uploadPresOverlay.classList.add("overlay-open");
}







function uploadPresCloseModal() {
    uploadPresOverlay.classList.remove("overlay-open");
    uploadPresModal.classList.remove("modal-open");
    uploadPresModal.classList.add("modal-close");
    uploadPresOverlay.classList.add("overlay-close");
    setTimeout(() => {
        uploadPresModal.style.display = "none";
        uploadPresOverlay.style.display = "none";
        uploadPresModal.classList.remove("modal-close");
        uploadPresOverlay.classList.remove("overlay-close");
    }, 200);
}



uploadPresOverlay.addEventListener("click", (e) => {
    if (e.target === uploadPresOverlay) {
        uploadPresCloseModal();
    }
});


