function addCart(newItem) {

    // check if form valid
    if (!document.getElementById(newItem.id + 'Pp').checkValidity()) {
        document.getElementById(newItem.id + 'Save').click();
    } else {

        // load current cart if set
        if (localStorage.getItem('cart') === null) {
            window.localStorage.setItem('cart', JSON.stringify([]));
        }

        //get data from stor
        let currentCart = JSON.parse(localStorage.getItem("cart"));

        //get data from from
        const name = newItem.id;
        const pp = document.getElementById(newItem.id + 'Pp').value;
        const qnt = document.getElementById(newItem.id + 'Grams').value;
        let cart = new Array();

        if (currentCart.length === 0) {
            // brand new cart
            let item = [{ 'name': name, 'pp': pp, 'qnt': qnt }];
            cart = item;
        } else {
            // active cart + new Item
            // newitem
            let item = [{ 'name': name, 'pp': pp, 'qnt': qnt }];
            currentCart.push(item);
            cart = currentCart;
        }
        window.localStorage.setItem('cart', JSON.stringify(cart));

        // cleanup form
        document.getElementById(newItem.id + 'Pp').value = '';
        document.getElementById(newItem.id + 'Grams').value = '';
        Swal.fire({
            icon: 'success',
            title: 'Your cart has been Updated!',
            showConfirmButton: true,
            timer: 1500
        });
        updateCartCountOnMenu();
    }
}

function updateCartCountOnMenu() {
    // load current cart if set
    if (localStorage.getItem('cart') === null) {
        window.localStorage.setItem('cart', JSON.stringify([]));
    }

    //get data from stor
    let currentCart = JSON.parse(localStorage.getItem("cart"));
    let counter;
    if (currentCart.length === 0) {
        counter = '';
    } else {
        counter = currentCart.length;
    }
    document.getElementById('cartCount').innerText = counter;
}

// if cart on page update
updateCartCountOnMenu();