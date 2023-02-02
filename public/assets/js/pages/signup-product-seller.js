const productSellerProfileImageUploadBtn = document.querySelector("#profile-pic-btn")
const productSellerProfileImageInput = document.querySelector("#profile-pic")
const productSellerProfileFilename = document.querySelector("#profile-pic-filename")

productSellerProfileImageUploadBtn.addEventListener("click", () => {
    productSellerProfileImageInput.click()
})

productSellerProfileImageInput.addEventListener("change", (e) => {
    if(e.target.files && e.target.files.length > 0) {
        productSellerProfileFilename.innerHTML = e.target.files[0].name
    }
})