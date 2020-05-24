function addOne() {

    let newElement = `
        <h2 class="bg-primary-dark text-center text-white">New Product:</h2>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name[]" value="">
        </div>
        <div class="form-group">
            <label for="desc">Description</label>
            <input type="text" class="form-control" id="desc" name="desc[]" value="">
        </div>
        <div class="form-group">
            <label for="img">Image</label>
            <input type="text" class="form-control" id="img" name="img[]" value="">
        </div>
        <div class="form-group">
            <label for="price">Price Per Kg</label>
            <input type="text" class="form-control" id="price" name="price[]"
                value="">
        </div>
        <div class="form-group">
            <label for="size">Portion Size</label>
            <small id="sizeHelp" class="form-text text-muted">Total Weight grams = Displayed Portion text</small>
            <textarea class="form-control" id="size" name="size[]" rows="3"
                aria-describedby="sizeHelp">0=0g</textarea>
        </div>
        <div class="form-group">
            <label for="minQty">Minimum Quantity</label>
            <input type="number" class="form-control" id="minQty" name="minQty[]"
                value="0">
        </div>
        <div class="form-group">
            <label for="maxQty">Maximum Quantity</label>
            <input type="number" class="form-control" id="maxQty" name="maxQty[]"
                value="1000">
        </div>`;


    var newChild = document.createElement('div');
    newChild.innerHTML = newElement;
    // child = child.firstChild;
    document.getElementById('productFrm').appendChild(newChild);
}