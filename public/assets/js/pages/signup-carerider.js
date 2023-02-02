const careRiderProfileImageUploadBtn = document.querySelector("#profile-pic-btn")
const careRiderProfileImageInput = document.querySelector("#profile-pic")
const careRiderProfileFilename = document.querySelector("#profile-pic-filename")

careRiderProfileImageUploadBtn.addEventListener("click", () => {
    careRiderProfileImageInput.click()
})

careRiderProfileImageInput.addEventListener("change", (e) => {
    if(e.target.files && e.target.files.length > 0) {
        careRiderProfileFilename.innerHTML = e.target.files[0].name
    }
})