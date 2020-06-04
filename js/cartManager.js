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

    // Load ZAR Currency formatter
    var formatter = new Intl.NumberFormat('en-ZA', {
        style: 'currency',
        currency: 'ZAR',
    });

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

    // TOTAL
    let priceTotal = 0;
    currentCart.forEach(cartItem => {

        // lookup the item in storeData
        const index = storeData.map(e => e.name).indexOf(cartItem[0].name);
        const itemPrice = (cartItem[0].qnt * cartItem[0].portionValue / 1000) * storeData[index]['Price p\/kg'];
        priceTotal += itemPrice;
        const itemIMG = storeData[index]['IMG'];
        const itemDesc = storeData[index]['desc'];
        const itemPortion = cartItem[0].portionText;
        const itemGrams = cartItem[0].qnt;
        const html = document.getElementById('cartData').innerHTML;
        // .toFixed(2)
        const listItem = `
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <img style="width: 3rem;" class="rounded" src="`+ itemIMG + `" alt="` + itemDesc + `">
                                <h5 class="ml-1 d-inline text-uppercase">` + itemDesc + `</h5>
                            </div>
                            <div class="col-12 col-md-2">
                                <strong>Portion: </strong>` + itemPortion + `
                            </div>
                            <div class="col-12 col-md-2">
                               <strong>Quantity: </strong> ` + itemGrams + `
                            </div>
                            <div class="col-12 col-md-3">
                               <strong>Price: </strong><div class="d-inline" id="price">` + formatter.format(itemPrice) + `</div>
                            </div>
                            <div class="col-12 col-md-1 text-right">
                                <button type="button" class="btn btn-outline-secondary mt-1" id="`+ i + `" onclick="remoteItemCart(this);"> X </button>
                            </div>
                        </div>
                    </li>`;
        document.getElementById('cartData').innerHTML = html + listItem;
        i++;
    });
    const html = document.getElementById('cartData').innerHTML;
    document.getElementById('cartData').innerHTML = html + `<h1 class="text-right">` + formatter.format(priceTotal) + `</h1>`;
}

// if cart on page update
updateCartCountOnMenu();