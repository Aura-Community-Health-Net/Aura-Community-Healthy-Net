

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
        const tr = button.parentElement.parentElement;
        console.log(tr.dataset)
        console.log(userId)

        updateUserModal.innerHTML = `
         <h3>Update User information for ${userName}</h3>
        <div class="modal-actions">
            <form class="user-update-form" action="/admin-dashboard/users/update?userId=${userId}}" method="post">
               
                <label class="form-input__label" for="">NIC</label>
                <input  class="form-input__input" type="text" name="nic" value="${tr.dataset.usernic}">
                <label class="form-input__label" for="">Email Address</label>
                <input class="form-input__input" type="text" name="email" value="${tr.dataset.useremail}">
                <label class="form-input__label" for="">Mobile Number</label>
                <input class="form-input__input" type="text" name="mobile_number" value="${tr.dataset.mobilenumber}">                
                <label class="form-input__label" for="">Address</label>
                <input class="form-input__input" type="text" name="address" value="${tr.dataset.address}">
               
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




const updateProviderModal = document.querySelector("#update-provider-modal");
const updateProviderOverlay = document.querySelector("#update-provider-overlay");

const updateProviderButtons = document.querySelectorAll(".provider-update");

console.log(updateProviderButtons)


const openUpdateProviderModal = () => {
    updateProviderModal.style.display = "block";
    updateProviderOverlay.style.display = "block";
    updateProviderModal.classList.add("modal-open");
    updateProviderOverlay.classList.add("overlay-open");
};

updateProviderOverlay.addEventListener("click", (e) => {
    console.log("click on overlay");
    if (e.target === updateProviderOverlay) {
        closeUpdateProviderModal();
    }
});

function closeUpdateProviderModal() {
    updateProviderOverlay.classList.remove("overlay-open");
    updateProviderModal.classList.remove("modal-open");
    updateProviderModal.classList.add("modal-close");
    updateProviderOverlay.classList.add("overlay-close");
    setTimeout(() => {
        updateProviderModal.style.display = "none";
        updateProviderOverlay.style.display = "none";
        updateProviderModal.classList.remove("modal-close");
        updateProviderOverlay.classList.remove("overlay-close");
    }, 200);
}

function attachProviderUpdateButtonListener(button){
    button.addEventListener("click", function () {
        // alert(`User id is ${element.id}, Product name is ${element.dataset.productname}`)
        const provider_nic = button.dataset.nic;
        const provider_name = button.dataset.name;
        const email_address = button.dataset.email;
        const mobile_number = button.dataset.mobile;
        const address = button.dataset.address;
        const bank_acc_no = button.dataset.account;
        const bank_name = button.dataset.bank;
        const branch_name = button.dataset.branch;
        const tr = button.parentElement.parentElement;
        //console.log(tr.dataset)
        console.log(provider_name)

        updateProviderModal.innerHTML = `
         <h3>Update User information for ${provider_name}</h3>
        <div class="modal-actions">
            <form class="user-update-form" action="/admin-dashboard/provider/update?provider_nic=${provider_nic}}" method="post">
               
                <input name="provider_nic" type="hidden" id="provider_nic" value="${provider_nic}">
                <label class="form-input__label" for="">NIC</label>
                <input  class="form-input__input" id="nic" type="text" name="nic">
                <label class="form-input__label" for="">Full Name</label>
                <input class="form-input__input" id="name" type="text" name="name">
                <label class="form-input__label" for="">Email Address</label>
                <input class="form-input__input" id="email" type="text" name="email">                
                <label class="form-input__label" for="">Mobile Number</label>
                <input class="form-input__input" id="mobile" type="text" name="mobile">
                <label class="form-input__label" for="">Address</label>
                <input class="form-input__input" id="address" type="text" name="address">
                <label class="form-input__label" for="">Bank Account Number</label>
                <input class="form-input__input" id="acc_no" type="text" name="acc_no">
                <label class="form-input__label" for="">Bank Name</label>
                <input class="form-input__input" id="bank" type="text" name="bank">
                <label class="form-input__label" for="">Branch Name</label>
                <input class="form-input__input" id="branch" type="text" name="branch">
               
                <div class="update-btn-section">
                    <button class="cancel-btn" id="update-provider-cancel-btn" type="button">Cancel</button>
                    <button class="ok-btn" id="update-provider-ok-btn">Ok</button>
                </div>
            </form>
        </div>
        `;

        document.getElementById("nic").value = provider_nic;
        document.getElementById("name").value = provider_name;
        document.getElementById("email").value = email_address;
        document.getElementById("mobile").value = mobile_number;
        document.getElementById("address").value = address;
        document.getElementById("acc_no").value = bank_acc_no;
        document.getElementById("bank").value = bank_name;
        document.getElementById("branch").value = branch_name;


        const updateProviderCancelBtn =
            updateProviderModal.querySelector("#update-provider-cancel-btn");
        updateProviderCancelBtn.addEventListener("click", (e) => {
            console.log("click on cancel button");
            if (e.target === updateProviderCancelBtn) {
                closeUpdateProviderModal();
            }
        });

        openUpdateProviderModal();
    });
}
updateProviderButtons.forEach(attachProviderUpdateButtonListener);


