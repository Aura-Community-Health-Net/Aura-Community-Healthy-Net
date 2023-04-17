// function change(element)
// {
//    // const prescription_image =  document.querySelector("#pres_img");
//
//    element.classList.toggle("zoomed_pres_image");
//
//
//
//
//
//
// }


 document.querySelectorAll('.prescription_img img').forEach(image =>{
         image.onclick = () =>{
             document.querySelector('.popup_image').style.display = 'block';
             document.querySelector('.popup_image img').src = image.getAttribute('src');
         }


 });


document.querySelector('.popup_image span').onclick = () =>{
    document.querySelector('.popup_image').style.display = 'none';
}