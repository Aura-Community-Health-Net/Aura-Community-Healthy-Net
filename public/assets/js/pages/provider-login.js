const container = document.querySelector('.login-slides-container');
const loginSlides = document.querySelectorAll(".login-slide")

let index = 0
setInterval(() => {
    loginSlides[index].scrollIntoView({
        behavior: index === 0 ? 'auto':'smooth',
        block: 'start',
        inline: 'nearest',
        direction: 'forward'
    })
    index = (index + 1) % 4
}, 2000)
