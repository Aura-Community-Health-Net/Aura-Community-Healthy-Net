 const search = () => {
    const searchBox = document.getElementById("search").values.toUpperCase();
    const storeItems = document.getElementById("consumer-product__grid-container");
    const product = document.getElementsByClassName(".product");
    const productName = storeItems.getElementsByTagName("h2");

    for (let i = 0; i < productName.length; i++){
        let match = product[i].getElementsByTagName('h2')[0];

        if (match){
            let textValue = match.textContent || match.innerHTML

            if (textValue.toUpperCase().indexOf(searchBox) > -1){
                product[i].style.display = "";
            } else {
                product[i].style.display = "none";
            }
        }
    }
 }