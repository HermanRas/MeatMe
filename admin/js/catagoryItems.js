function updateIMG() {
    const x = document.getElementById("img").selectedIndex;
    const y = document.getElementById("img").options;
    const imgURL = y[x].value;

    const itemPic = document.getElementById('itemPic');
    itemPic.src = imgURL;


}

function itemUpdate() {
    const x = document.getElementById("products").selectedIndex;
    const y = document.getElementById("products").options;
    const category = y[x].value;
    const items = (storeData[category]);

    const selectItem = document.getElementById("item");
    selectItem.innerHTML = `<option value="">Select Item</option>`;
    items.forEach(item => {
        selectItem.innerHTML = selectItem.innerHTML + `<option value="` + item.name + `">` + item.desc + `</option>`
    });
    selectItem.innerHTML = selectItem.innerHTML + `<option value="ADD">ADD New Item</option>`
}