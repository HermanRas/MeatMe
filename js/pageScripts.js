/////////////////////////////////////////////////////////////////////////////////
//  SEE APP.JS for Triggers
/////////////////////////////////////////////////////////////////////////////////

function pageCart() {
    // load current cart if set
    if (localStorage.getItem('cart') === null) {
        window.localStorage.setItem('cart', JSON.stringify([]));
    }

    //get data from stor
    let currentCart = localStorage.getItem("cart");
    document.getElementById('cartData').innerText = currentCart;
}