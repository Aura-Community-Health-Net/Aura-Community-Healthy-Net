

export class Notifier {
    static nextTop = 16

    /**
     * @param {string} text
     * @param {string} id
     */
    static show(text, id){

        const notificationElement = document.createElement("div")
        notificationElement.innerHTML = text
        notificationElement.id = id
        notificationElement.classList.add("notification")
        notificationElement.style.top = `${this.nextTop}px`
        document.body.appendChild(notificationElement);

        notificationElement.addEventListener("click", function (){
            Notifier.destroy(id);
        })


        const {top, height} = notificationElement.getBoundingClientRect()
        console.log(top + height)
        this.nextTop = top + height + 16
    }

    static destroy(id){
        const notificationElement = document.querySelector(`#${id}`)
        notificationElement.classList.remove("notification")
        notificationElement.classList.add("notification--remove")
        setTimeout(function(){
            notificationElement.remove()
        }, 300)
    }
}
