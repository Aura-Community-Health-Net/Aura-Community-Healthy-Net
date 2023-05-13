// const updateUserModal = document.querySelector("#update-user-moadal");
// const updateUserOverlay = document.querySelector(#update-user-overlay);
//
// const nicInput = document.getElementById("nic");
// const weightInput = document.getElementById("name");
// const mobileNumber = document.getElementById("mobile-number");
// const address = document.getElementById("address");
// const bankAccountNumber = document.getElementById("bank-account-number");
// const bankName = document.getElementById("bank-name");
// const bankBranchName = document.getElementById("bank-branch-name");
//
// const updateUserButton = document.querySelectorAll(".user-update");
//
// updateUserOverlay.addEventListener("click", (e)=>{
//     console.log("click on overlay");
//     if (e.target === updateUserOverlay){
//         closeUpdateUserModal();
//     }
// });
//
// function closeUpdateProductModal(){
//     updateUserOverlay.classList.remove("overlay-open");
//     updateUserModal.classList.remove("modal-open");
//     updateUserModal.classList.add("modal-close");
//     updateUserOverlay.classList.remove("overlay-close");
//     setTimeout( () => {
//         updateUserModal.style.disable = "none";
//         updateUserOverlay.style.display = "none";
//         updateUserModal.classList.remove("modal-close");
//         updateUserOverlay.classList.remove("overlay-close");
//         }, 200);
// }
//
// function attachUpdateButtonListner(button){
//     button.addEventListener("click", function () {
//         const nic = button.dataset.nic;
//         const name = button.dataset.name;
//         const tr = button.parentElement.parentElement;
//
//         updateUserModal.innerHTML = `
//          <h3>Update product information for ${name}</h3>
//         <div class="modal-actions">
//             <form class="user-update-form" action="/admin-dashboard/users/update?user=${nic}" method="post">
//
//                 <label class="form-input__label" for="">NIC</label>
//                 <input  class="form-input__input" type="text" name="nic" value="${button.dataset.nic}">
//                 <label class="form-input__label" for="">Email Address</label>
//                 <input class="form-input__input" type="text" name="address" value="${button.dataset.address}">
//                 <label class="form-input__label" for="">Mobile Number</label>
//                 <input class="form-input__input" type="text" name="mobile_number" value="${button.dataset.mobile_number}">
//                 <label class="form-input__label" for="">Address</label>
//                 <input class="form-input__input" type="text" name="address" value="${button.dataset.address}
//                 <label class="form-input__label" for="">Bank Account Number</label>
//                 <input class="form-input__input" type="text" name="bank_account_number" value="${button.dataset.bank_account_number}">
//                 <label class="form-input__label" for="">Bank Branch</label>
//                 <input class="form-input__input" type="text" name="bank_branch" value="${button.dataset.bank_account_number}">
//                 </form>
//         </div>
//         `;
//         const updateCancelBtn =
//             updateUserModal.querySelector("#update-cancel-btn");
//         updateCancelBtn.addEventListener("click", (e) => {
//             console.log("click on cancel button");
//             if (e.target === updateCancelBtn) {
//                 closeUpdateUserModal();
//             }
//         });
//
//         openUpdateProductModal();
//     });
// }
// updateUserButton.forEach(attachUpdateButtonListner);
//
//


const updateUserModal = document.querySelector("#update-user-modal");
const updateUserOverlay = document.querySelector("#update-user-overlay");

const updateUserButtons = document.querySelectorAll(".user-update");

console.log(updateUserButtons)


const openUpdateUserModal = () => {
    updateUserModal.style.display = "block";
    updateUserOverlay.style.display = "block";
    updateUserModal.classList.add("modal-open");
    updateUserOverlay.classList.add("overlay-open");
};

updateUserOverlay.addEventListener("click", (e) => {
    console.log("click on overlay");
    if (e.target === updateUserOverlay) {
        closeUpdateUserModal();
    }
});

function closeUpdateUserModal() {
    updateUserOverlay.classList.remove("overlay-open");
    updateUserModal.classList.remove("modal-open");
    updateUserModal.classList.add("modal-close");
    updateUserOverlay.classList.add("overlay-close");
    setTimeout(() => {
        updateUserModal.style.display = "none";
        updateUserOverlay.style.display = "none";
        updateUserModal.classList.remove("modal-close");
        updateUserOverlay.classList.remove("overlay-close");
    }, 200);
}

function attachUpdateButtonListener(button){
    button.addEventListener("click", function () {
        // alert(`User id is ${element.id}, Product name is ${element.dataset.productname}`)
        const userId = button.dataset.usernic;
        const userName = button.dataset.username;
        const userEmail = button.dataset.useremail;
        // const datasetElement = button.parentElement.parentElement;
        console.log(button.dataset)
        console.log(userId)

        updateUserModal.innerHTML = `
         <h3>Update User information for ${userName}</h3>
        <div class="modal-actions">
            <form class="user-update-form" action="/admin-dashboard/consumers/update?userId=${userId}" method="post">
               
                <label class="form-input__label" for="">NIC</label>
                <input  class="form-input__input" type="text" name="nic" value="${button.dataset.usernic}">
                <label class="form-input__label" for="">Email Address</label>
                <input class="form-input__input" type="text" name="email" value="${button.dataset.useremail}">
                <label class="form-input__label" for="">Mobile Number</label>
                <input class="form-input__input" type="text" name="mobile_number" value="${button.dataset.mobilenumber}">                
                <label class="form-input__label" for="">Address</label>
                <input class="form-input__input" type="text" name="address" value="${button.dataset.address}">
               
                <div class="update-btn-section">
                    <button class="cancel-btn" id="update-cancel-btn" type="button">Cancel</button>
                    <button class="ok-btn" id="update-ok-btn">Ok</button>
                </div>
            </form>
        </div>
        `;
        const updateCancelBtn =
            updateUserModal.querySelector("#update-cancel-btn");
        updateCancelBtn.addEventListener("click", (e) => {
            console.log("click on cancel button");
            if (e.target === updateCancelBtn) {
                closeUpdateUserModal();
            }
        });

        openUpdateUserModal();
    });
}
updateUserButtons.forEach(attachUpdateButtonListener);

