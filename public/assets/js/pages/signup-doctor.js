const doctorProfileImageUploadBtn =
  document.querySelector("#profile-pic-btn");
const doctorProfileImageInput = document.querySelector("#profile-pic");
const doctorProfileImageFilename = document.querySelector(
  "#profile-pic-filename"
);

const doctorMBBSCertificateUploadBtn = document.querySelector(
  "#mbbs-certificate-btn"
);
const doctorMBBSCertificateInput =
  document.querySelector("#mbbs-certificate");
const doctorMBBSCertificateFilename = document.querySelector(
  "#mbbs-certificate-filename"
);

doctorProfileImageUploadBtn.addEventListener("click", () => {
  doctorProfileImageInput.click();
});

doctorProfileImageInput.addEventListener("change", (e) => {
  if (e.target.files && e.target.files.length > 0) {
    doctorProfileImageFilename.innerHTML = e.target.files[0].name;
  }
});

doctorMBBSCertificateUploadBtn.addEventListener("click", () => {
  doctorMBBSCertificateInput.click();
});

doctorMBBSCertificateInput.addEventListener("change", (e) => {
  if (e.target.files && e.target.files.length > 0) {
    doctorMBBSCertificateFilename.innerHTML = e.target.files[0].name;
  }
});
