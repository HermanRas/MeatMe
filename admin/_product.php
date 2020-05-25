<?php
///////////////////////////////////////////////////////////////////////////////////
// Edit Item
///////////////////////////////////////////////////////////////////////////////////
    if(isset($_POST['save'])){
        echo "<h1> One Day this will edit your data </h1>";
        var_dump($_POST);
        echo '<a href="home.php" class="btn btn-lg btn-primary w-100"> CANCEL </a>';
        die;
    }

///////////////////////////////////////////////////////////////////////////////////
// Add Item
///////////////////////////////////////////////////////////////////////////////////
    if(isset($_POST['add'])){
        echo "<h1> One Day this will add your data </h1>";
        var_dump($_POST);
        echo '<a href="home.php" class="btn btn-lg btn-primary w-100"> CANCEL </a>';
        die;
    }


///////////////////////////////////////////////////////////////////////////////////
// DELETE Item
///////////////////////////////////////////////////////////////////////////////////
    if(isset($_POST['delete'])){
        echo "<h1> One Day this will delete your data </h1>";
        var_dump($_POST);
        echo '<a href="home.php" class="btn btn-lg btn-primary w-100"> CANCEL </a>';
        die;
    }


///////////////////////////////////////////////////////////////////////////////////
// Load Item for edit
///////////////////////////////////////////////////////////////////////////////////
    if(isset($_POST['product']) & isset($_POST['item'])){
        //set defaults 
        $product = $_POST['product'];
        $item = $_POST['item'];
        $jsonfile = file_get_contents("../data/$product");
        $json_data = json_decode($jsonfile, true);

        // if new show blank form, else show update
        if($item !== 'ADD'){   
            //user is updating
            $i = 0;
            foreach ($json_data['items'] as $value) {
                if($value['name'] === $item){
                    $item = $value;
                break;
                }
            $i++;
            }
        }else{
            $i = '';
            $item = [];
            $item['name'] = '';
            $item['desc'] = '';
            $item['IMG'] = '';
            $item['Price p/kg'] = '';
            $item['Portion Size'] = [['100'=>'100g']];
            $item['minQTY'] = 0;
            $item['maxQTY'] = 1000;
        }
    }else{    
        // if open the page opens directly send user to select screen
        echo '<script>window.location.replace("products.php");</script>';
        die;
    }
?>

<div class="container mt-3">
    <h1 class="bg-secondary-dark rounded p-2 text-center">Products</h1>
    <form method="POST" action="product.php">
        <input type="hidden" name="update" value="<?php echo $i; ?>">
        <input type="hidden" name="product" value="<?php echo $product; ?>">
        <h2 class="bg-primary-dark text-center text-white"><?php echo $item['desc']; ?></h2>
        <div class="form-group">
            <label for="name">Name</label>
            <input required type="text" class="form-control" id="name" name="name" value="<?php echo $item['name']; ?>">
        </div>
        <div class="form-group">
            <label for="desc">Description</label>
            <input required type="text" class="form-control" id="desc" name="desc" value="<?php echo $item['desc']; ?>">
        </div>
        <div class="form-group">
            <label for="img">Image</label>
            <select class="form-control" id="img" name="img" onchange="updateIMG()">
                <option value="<?php echo $item['IMG']; ?>"><?php echo $item['IMG']; ?></option>
                <?php
                 $files = array_diff(scandir('../img/'.str_replace('.json','',$product)), array('..', '.'));
                 foreach ($files as $file) {
                     echo '<option value="'.'../img/'.str_replace('.json','',$product).'/'.$file.'">'.$file.'</option>';
                    }
                    ?>
            </select>
            <img class="rounded p-2" id="itemPic" width="250px" src="../<?php echo $item['IMG']; ?>" alt="item picture">
        </div>
        <div class="form-group">
            <label for="price">Price Per Kg</label>
            <input required type="text" class="form-control" id="price" name="price"
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
            <textarea required class="form-control" id="size" name="size" rows="3"
                aria-describedby="sizeHelp"><?php echo $size; ?></textarea>
        </div>
        <div class="form-group">
            <label for="minQty">Minimum Quantity</label>
            <input required type="number" class="form-control" id="minQty" name="minQty"
                value="<?php echo $item['minQTY']; ?>">
        </div>
        <div class="form-group">
            <label for="maxQty">Maximum Quantity</label>
            <input required type="number" class="form-control" id="maxQty" name="maxQty"
                value="<?php echo $item['maxQTY']; ?>">
        </div>

        <?php
            if ($i !== ''){
        ?>
        <div class="row text-center">
            <div class="col-12 col-md-4">
                <input type="submit" class="btn btn-lg btn-secondary w-100" name="save" value="Update">
            </div>
            <div class="col-12 col-md-4">
                <input type="submit" class="btn btn-lg btn-dark w-100" name="delete" value="Delete">
            </div>
            <div class="col-12 col-md-4">
                <a href="home.php" class="btn btn-lg btn-primary w-100"> Cancel </a>
            </div>
        </div>
        <?php
            }else{
        ?>
        <div class="row text-center">
            <div class="col-12 col-md-6">
                <input type="submit" class="btn btn-lg btn-secondary w-100" name="add" value="Add">
            </div>
            <div class="col-12 col-md-6">
                <a href="home.php" class="btn btn-lg btn-primary w-100"> Cancel </a>
            </div>
        </div>
        <?php
            }
        ?>
        <hr>
    </form>
</div>
<script src="js/catagoryItems.js"></script>