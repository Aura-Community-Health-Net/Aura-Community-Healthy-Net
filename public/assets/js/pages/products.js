const addProductModalButton = document.getElementById("add-product-btn");
const addProductModal = document.querySelector("#add-product-modal");
const addProductForm = document.querySelector("#add-product-form");
const addProductOverlay = document.querySelector("#add-product-overlay");
const addProductOKBtn = document.querySelector("#add-product-ok-btn");
const addProductCancelBtn = document.querySelector("#add-product-cancel-btn");

const deleteProductModal = document.querySelector("#delete-product-modal");
const deleteProductOverlay = document.querySelector("#delete-product-overlay");

const updateProductModal = document.querySelector("#update-product-modal");
const updateProductOverlay = document.querySelector("#update-product-overlay");

const nameInput = document.getElementById("name");
const weightInput = document.getElementById("weight");
const priceInput = document.getElementById("price");
const stock = document.getElementById("stock");

const productImageUploadButton = document.querySelector("#image-btn");
const productImageInput = document.querySelector("#image");
const productImageFilename = document.querySelector("#image-filename");

const deleteProductButtons = document.querySelectorAll(".product-delete");
const updateProductButtons = document.querySelectorAll(".product-update");
console.log(updateProductButtons)

addProductModalButton.addEventListener("click", () => {
  addProductModal.style.display = "block";
  addProductOverlay.style.display = "block";
  addProductModal.classList.add("modal-open");
  addProductOverlay.classList.add("overlay-open");
});

addProductOKBtn.addEventListener("click", () => {
  addProductForm.submit();
});

addProductOverlay.addEventListener("click", (e) => {
  console.log("click on overlay");
  if (e.target === addProductOverlay) {
    closeAddProductModal();
  }
});

addProductCancelBtn.addEventListener("click", (e) => {
  console.log("click on cancel button");
  if (e.target === addProductCancelBtn) {
    closeAddProductModal();
  }
});

function closeAddProductModal() {
  addProductOverlay.classList.remove("overlay-open");
  addProductModal.classList.remove("modal-open");
  addProductModal.classList.add("modal-close");
  addProductOverlay.classList.add("overlay-close");
  setTimeout(() => {
    addProductModal.style.display = "none";
    addProductOverlay.style.display = "none";
    addProductModal.classList.remove("modal-close");
    addProductOverlay.classList.remove("overlay-close");
  }, 200);
}

const openDeleteProductModal = () => {
  deleteProductModal.style.display = "block";
  deleteProductOverlay.style.display = "block";
  deleteProductModal.classList.add("modal-open");
  deleteProductOverlay.classList.add("overlay-open");
};

deleteProductOverlay.addEventListener("click", (e) => {
  console.log("click on overlay");
  if (e.target === deleteProductOverlay) {
    closeDeleteProductModal();
  }
});

function closeDeleteProductModal() {
  deleteProductOverlay.classList.remove("overlay-open");
  deleteProductModal.classList.remove("modal-open");
  deleteProductModal.classList.add("modal-close");
  deleteProductOverlay.classList.add("overlay-close");
  setTimeout(() => {
    deleteProductModal.style.display = "none";
    deleteProductOverlay.style.display = "none";
    deleteProductModal.classList.remove("modal-close");
    deleteProductOverlay.classList.remove("overlay-close");
  }, 200);
}

productImageUploadButton.addEventListener("click", () => {
  productImageInput.click();
});

productImageInput.addEventListener("change", function () {
  if (this.files && this.files.length > 0) {
    productImageFilename.innerHTML = this.files[0].name;
  }
});

function attachDeleteButtonListener(button){
  button.addEventListener("click", function () {
    // alert(`Product id is ${element.id}, Product name is ${element.dataset.productname}`)
    const productId = button.dataset.productid; // delete-product-56
    const productName = button.dataset.productname;
    console.log(productId)
    const categoryID = button.dataset.categoryid;

    deleteProductModal.innerHTML = `
         <h3>Do you really want to delete ${productName}</h3>
        <img class="modal-img" src="/assets/images/confirmation.jpg" alt="">
        <div class="modal-actions">
            <button class="cancel-btn" id="delete-cancel-btn">Cancel</button>
            <form action="/product-seller-dashboard/products/delete?productId=${productId}&categoryId=${categoryID}" method="post">
                <button class="ok-btn" id="delete-ok-btn">Ok</button>
            </form>
        </div>
        `;
    const deleteCancelBtn =
        deleteProductModal.querySelector("#delete-cancel-btn");
    deleteCancelBtn.addEventListener("click", (e) => {
      console.log("click on cancel button");
      if (e.target === deleteCancelBtn) {
        closeDeleteProductModal();
      }
    });

    openDeleteProductModal();
  });
}
deleteProductButtons.forEach(attachDeleteButtonListener);

const openUpdateProductModal = () => {
  updateProductModal.style.display = "block";
  updateProductOverlay.style.display = "block";
  updateProductModal.classList.add("modal-open");
  updateProductOverlay.classList.add("overlay-open");
};

updateProductOverlay.addEventListener("click", (e) => {
  console.log("click on overlay");
  if (e.target === updateProductOverlay) {
    closeUpdateProductModal();
  }
});

function closeUpdateProductModal() {
  updateProductOverlay.classList.remove("overlay-open");
  updateProductModal.classList.remove("modal-open");
  updateProductModal.classList.add("modal-close");
  updateProductOverlay.classList.add("overlay-close");
  setTimeout(() => {
    updateProductModal.style.display = "none";
    updateProductOverlay.style.display = "none";
    updateProductModal.classList.remove("modal-close");
    updateProductOverlay.classList.remove("overlay-close");
  }, 200);
}

function attachUpdateButtonListener(button){
  button.addEventListener("click", function () {
    // alert(`Product id is ${element.id}, Product name is ${element.dataset.productname}`)
    const productId = button.dataset.productid;
    const productName = button.dataset.productname;
    console.log(productId)
    const categoryID = button.dataset.categoryid;

    updateProductModal.innerHTML = `
         <h3>Update product information for ${productName}</h3>
        <div class="modal-actions">
            <form class="product-update-form" action="/product-seller-dashboard/products/update?productId=${productId}&categoryId=${categoryID}" method="post">
                <label class="form-input__label" for="">Product Image</label>
                <input type="file" id="image" name="image" style="display: none; visibility: hidden" accept="image/*"
                    required>
                <div class="form-upload-component">
                    <button class="upload-btn" id="image-btn" type="button">
                        <i class="fa-solid fa-plus add-icon"></i>
                    </button>
                    <div id="image-filename"></div>
                </div>
                <label class="form-input__label" for="">Product Name</label>
                <input  class="form-input__input" type="text">
                <label class="form-input__label" for="">Quantity</label>
                <input class="form-input__input" type="text">
                <label class="form-input__label" for="">Price</label>
                <input class="form-input__input" type="text">
                <label class="form-input__label" for="">Stock</label>
                <input class="form-input__input" type="text">
                <div class="update-btn-section">
                    <button class="cancel-btn" id="update-cancel-btn">Cancel</button>
                    <button class="ok-btn" id="update-ok-btn">Ok</button>
                </div>
            </form>
        </div>
        `;
    const updateCancelBtn =
        updateProductModal.querySelector("#update-cancel-btn");
    updateCancelBtn.addEventListener("click", (e) => {
      console.log("click on cancel button");
      if (e.target === updateCancelBtn) {
        closeUpdateProductModal();
      }
    });

    openUpdateProductModal();
  });
}
updateProductButtons.forEach(attachUpdateButtonListener);
