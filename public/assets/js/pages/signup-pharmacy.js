const pharmacyProfileImageUploadBtn =
  document.querySelector("#profile-pic-btn");
const pharmacyProfileImageInput = document.querySelector("#profile-pic");
const pharmacyProfileImageFilename = document.querySelector(
  "#profile-pic-filename"
);

const pharmacyNMRACertificateUploadBtn = document.querySelector(
  "#nmra-certificate-btn"
);
const pharmacyNMRACertificateInput =
  document.querySelector("#nmra-certificate");
const pharmacyNMRACertificateFilename = document.querySelector(
  "#nmra-certificate-filename"
);

pharmacyProfileImageUploadBtn.addEventListener("click", () => {
  pharmacyProfileImageInput.click();
});

pharmacyProfileImageInput.addEventListener("change", (e) => {
  if (e.target.files && e.target.files.length > 0) {
    pharmacyProfileImageFilename.innerHTML = e.target.files[0].name;
  }
});

pharmacyNMRACertificateUploadBtn.addEventListener("click", () => {
  pharmacyNMRACertificateInput.click();
});

pharmacyNMRACertificateInput.addEventListener("change", (e) => {
  if (e.target.files && e.target.files.length > 0) {
    pharmacyNMRACertificateFilename.innerHTML = e.target.files[0].name;
  }
});
