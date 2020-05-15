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
        const qnt = document.getElementById(newItem.id + 'Qty').value;
        const portion = document.getElementById(newItem.id + 'Portion');
        const portionValue = portion.value;
        const portionText = portion.options[portion.selectedIndex].text;

        // update data
        let cart = new Array();
        let item = [{ 'name': name, 'portionValue': portionValue, 'portionText': portionText, 'qnt': qnt }];
        currentCart.push(item);
        cart = currentCart;

        // save data
        window.localStorage.setItem('cart', JSON.stringify(cart));

        // cleanup form
        // document.getElementById(newItem.id + 'Portion').value = 'Choose...';
        document.getElementById(newItem.id + 'Portion').getElementsByTagName('option')[0].selected = 'selected'
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
//  Remove Item From Cart
/////////////////////////////////////////////////////////////////////////////////
function remoteItemCart(item) {
    // load current cart if set
    if (localStorage.getItem('cart') === null) {
        window.localStorage.setItem('cart', JSON.stringify([]));
    }

    //get data from stor
    let currentCart = JSON.parse(localStorage.getItem("cart"));

    // remove item
    currentCart.splice(item.id, 1);

    // save data
    window.localStorage.setItem('cart', JSON.stringify(currentCart));

    updateCartCountOnMenu();
    pageCart();
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

    // Clear page
    document.getElementById('cartData').innerHTML = '';

    //run thru the items in this cart
    let i = 0;
    if (currentCart.length === 0) {
        document.getElementById('cartData').innerHTML = `
            <li class="list-group-item">
                <div class="row">
                    <div class="col-12">
                        <p> no items in your cart ! </p>
                    </div>
                </div>
            </li>
        `;
    }
    currentCart.forEach(cartItem => {
        const itemName = cartItem[0].name;
        const itemPortion = cartItem[0].portionText;
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
                                <strong>Portion: </strong>` + itemPortion + `
                            </div>
                            <div class="col-12 col-md-3">
                               <strong>Quantity: </strong> ` + itemGrams + `
                            </div>
                            <div class="col-12 col-md-1">
                                <button type="button" class="btn btn-outline-secondary mt-1 float-right" id="`+ i + `" onclick="remoteItemCart(this);"> X </button>
                            </div>
                        </div>
                    </li>`;
        document.getElementById('cartData').innerHTML = html + listItem;
        i++;
    });
}

// if cart on page update
updateCartCountOnMenu();