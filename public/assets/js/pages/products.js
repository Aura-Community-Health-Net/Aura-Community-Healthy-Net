const addProductModalButton = document.getElementById("add-product-btn");
const addProductModal = document.querySelector("#add-product-modal");
const addProductForm = document.querySelector("#add-product-form");
const addProductOverlay = document.querySelector("#add-product-overlay");
const addProductOKBtn = document.querySelector("#add-product-ok-btn");
const addProductCancelBtn = document.querySelector("#add-product-cancel-btn");

const deleteProductModal = document.querySelector("#delete-product-modal");
const deleteProductOverlay = document.querySelector("#delete-product-overlay");

const nameInput = document.getElementById("name");
const weightInput = document.getElementById("weight");
const priceInput = document.getElementById("price");
const stock = document.getElementById("stock");

const productImageUploadButton = document.querySelector("#image-btn");
const productImageInput = document.querySelector("#image");
const productImageFilename = document.querySelector("#image-filename");

const deleteProductButtons = document.querySelectorAll(".product-delete");

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

deleteProductButtons.forEach((element) => {
  element.addEventListener("click", () => {
    // alert(`Product id is ${element.id}, Product name is ${element.dataset.productname}`)
    const elementId = element.id; // delete-product-56
    const splittedId = elementId.split("-"); // ['delete', 'product', '56']

    deleteProductModal.innerHTML = `
         <h3>Do you really want to delete ${element.dataset.productname}</h3>
        <img class="modal-img" src="/assets/images/confirmation.jpg" alt="">
        <div class="modal-actions">
            <button class="cancel-btn" id="delete-cancel-btn">Cancel</button>
            <form action="/product-seller-dashoard/products/delete?productId=${splittedId[2]}" method="post">
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
});
