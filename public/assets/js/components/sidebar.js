let menuToggle = document.querySelector('.toggle');
let navigation = document.querySelector('.dashboard-container__side-nav');
let servicesList = document.querySelector('#services-list');
let servicesLink = document.querySelector('#services-link');

menuToggle.onclick = function (){
    menuToggle.classList.toggle('active')
    navigation.classList.toggle('active')
}

let navbtn = document.querySelectorAll('.navbtn');
for (let i = 0; i<navbtn.length; i++){
    navbtn[i].onclick = function (){
        let j = 0;
        while (j < navbtn.length){
            navbtn[j++].className = 'navbtn';
        }
        navbtn[i].className = 'navbtn active'
    }
}

if (servicesLink){
    servicesLink.addEventListener("click",
        () => {
        servicesList.classList.toggle("active");
        servicesLink.classList.toggle("active");
    })
}