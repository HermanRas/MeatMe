<?php
    if(isset($_POST['save'])){

        echo "<h1> One Day this will save your data </h1>";
        var_dump($_POST);
        echo '<a href="home.php" class="btn btn-lg btn-primary w-100"> CANCEL </a>';
        die;
    }

    if(isset($_POST['product'])){
        $product = $_POST['product'];
        $jsonfile = file_get_contents("../data/$product");
        $json_data = json_decode($jsonfile, true);
    }else{    
        echo '<script>window.location.replace("products.php");</script>';
        die;
    }
?>

<div class="container mt-3">
    <h1 class="bg-secondary-dark rounded p-2 text-center">Products</h1>
    <form method="POST" action="product.php">
        <input required type="hidden" value="<?php echo $item['product']; ?>">
        <?php
            //Display Items
            foreach ($json_data["items"] as $item) {
        ?>
        <h2 class="bg-primary-dark text-center text-white"><?php echo $item['desc']; ?></h2>
        <div class="form-group">
            <label for="name">Name</label>
            <input required type="text" class="form-control" id="name" name="name[]"
                value="<?php echo $item['name']; ?>">
        </div>
        <div class="form-group">
            <label for="desc">Description</label>
            <input required type="text" class="form-control" id="desc" name="desc[]"
                value="<?php echo $item['desc']; ?>">
        </div>
        <div class="form-group">
            <label for="img">Image</label>
            <input required type="text" class="form-control" id="img" name="img[]" value="<?php echo $item['IMG']; ?>">
        </div>
        <div class="form-group">
            <label for="price">Price Per Kg</label>
            <input required type="text" class="form-control" id="price" name="price[]"
                value="<?php echo $item['Price p/kg']; ?>">
        </div>
        <div class="form-group">
            <label for="size">Portion Size</label>
            <?php
            $size = '';
            foreach ($item['Portion Size'] as $portion) {
                foreach ($portion as $key => $value) {
                    $size = $size.("$key=$value\n");
                }
            }
            ?>
            <small id="sizeHelp" class="form-text text-muted">Total Weight grams = Displayed Portion text</small>
            <textarea required class="form-control" id="size" name="size[]" rows="3"
                aria-describedby="sizeHelp"><?php echo $size; ?></textarea>
        </div>
        <div class="form-group">
            <label for="minQty">Minimum Quantity</label>
            <input required type="number" class="form-control" id="minQty" name="minQty[]"
                value="<?php echo $item['minQTY']; ?>">
        </div>
        <div class="form-group">
            <label for="maxQty">Maximum Quantity</label>
            <input required type="number" class="form-control" id="maxQty" name="maxQty[]"
                value="<?php echo $item['maxQTY']; ?>">
        </div>
        <?php
            echo "<br><hr>";
            }
        ?>

        <div id="productFrm">
            <!-- new elements here -->
        </div>

        <div class="row text-center">
            <div class="col-12 col-md-4">
                <input type="submit" class="btn btn-lg btn-secondary w-100" name="save" value=" SAVE ">
            </div>
            <div class="col-12 col-md-4">
                <button type="button" class="btn btn-lg btn-dark w-100" onclick="addOne()"> Add </button>
            </div>
            <div class="col-12 col-md-4">
                <a href="home.php" class="btn btn-lg btn-primary w-100"> CANCEL </a>
            </div>
        </div>
        <hr>
    </form>
</div>
<!-- page Script -->
<script src="js/catagoryItems.js"></script>