/////////////////////////////////////////////////////////////////////////////////
//  SEE APP.JS for Triggers
/////////////////////////////////////////////////////////////////////////////////

function pageCart() {
    // load current cart if set
    if (localStorage.getItem('cart') === null) {
        window.localStorage.setItem('cart', JSON.stringify([]));
    }

    //get data from stor
    let currentCart = JSON.parse(localStorage.getItem("cart"));
    //run thru the items in this cart
    currentCart.forEach(cartItem => {
        const itemName = cartItem[0].name;
        const itemPp = cartItem[0].pp;
        const itemGrams = cartItem[0].qnt;
        const html = document.getElementById('cartData').innerHTML;
        const listItem = `<li class="list-group-item"> <div class="form-inline form-group"> <strong class="mr-2 pt-1"> <h5 class="text-uppercase">` + itemName +
            `: </h5> </strong> <label for="pp">Packed for people: </label> <input type = "text" id = "pp" class="form-control mx-1 mt-1" value = "` + itemPp +
            `" readonly > <label class="ml-2" for="gram">Grams: </label> <input type="test" id="gram" class="form-control mx-1 mt-1" value="` + itemGrams +
            `" readonly> <button type="button" class="btn btn-outline-secondary mt-1 ml-auto"> X </button> </div> </li > `;
        document.getElementById('cartData').innerHTML = html + listItem;
    });

}