/////////////////////////////////////////////////////////////////////////////////
//  Check if Item being added to cart is valid
/////////////////////////////////////////////////////////////////////////////////
function addCart(newItem) {

    // check if form valid
    if (!document.getElementById(newItem.id + 'Qty').checkValidity() || !document.getElementById(newItem.id + 'Portion').checkValidity()) {
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
        const pp = document.getElementById(newItem.id + 'Portion').value;
        const qnt = document.getElementById(newItem.id + 'Qty').value;
        let cart = new Array();

        if (currentCart.length === 0) {
            // brand new cart
            let item = [{ 'name': name, 'pp': pp, 'qnt': qnt }];
            currentCart.push(item);
            cart = currentCart;
        } else {
            // active cart + new Item
            // newitem
            let item = [{ 'name': name, 'pp': pp, 'qnt': qnt }];
            currentCart.push(item);
            cart = currentCart;
        }
        window.localStorage.setItem('cart', JSON.stringify(cart));

        // cleanup form
        document.getElementById(newItem.id + 'Portion').value = '';
        document.getElementById(newItem.id + 'Qty').value = '';
        Swal.fire({
            icon: 'success',
            title: 'Your cart has been Updated!',
            showConfirmButton: true,
            timer: 1500
        });
        updateCartCountOnMenu();
    }
}

/////////////////////////////////////////////////////////////////////////////////
//  Update Cart Icon On Menu
/////////////////////////////////////////////////////////////////////////////////
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


/////////////////////////////////////////////////////////////////////////////////
//  Render Cart Page
/////////////////////////////////////////////////////////////////////////////////
function pageCart() {
    // load current cart if set
    if (localStorage.getItem('cart') === null) {
        window.localStorage.setItem('cart', JSON.stringify([]));
    }

    //get data from stor
    let currentCart = JSON.parse(localStorage.getItem("cart"));
    //run thru the items in this cart
    let i = 0;
    currentCart.forEach(cartItem => {
        const itemName = cartItem[0].name;
        const itemPp = cartItem[0].pp;
        const itemGrams = cartItem[0].qnt;
        const html = document.getElementById('cartData').innerHTML;
        const listItem = `
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <img style="width: 3rem;" class="rounded" src="https://via.placeholder.com/400x250.png?text=400x250 + ` + itemName + `" alt="nek">
                                <h5 class="ml-1 d-inline text-uppercase">` + itemName + `</h5>
                            </div>
                            <div class="col-12 col-md-4">
                                <strong>Grams: </strong>` + itemPp + `
                            </div>
                            <div class="col-12 col-md-3">
                               <strong>Quantity: </strong> ` + itemGrams + `
                            </div>
                            <div class="col-12 col-md-1">
                                <button type="button" class="btn btn-outline-secondary mt-1 float-right" id="`+ i + `" > X </button>
                            </div>
                        </div>
                    </li>`;
        document.getElementById('cartData').innerHTML = html + listItem;
        i++;
    });
}

// if cart on page update
updateCartCountOnMenu();