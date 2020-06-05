<?php
///////////////////////////////////////////////////////////////////////////////////
// Edit Item
///////////////////////////////////////////////////////////////////////////////////
    if(isset($_POST['save'])){
        // set update defaults
        $product = $_POST['product'];
        $update = $_POST['update'];
        
        // build out portions size array
        $size = [];
        $list = trim($_POST['size']);
        $list = explode("\n",$list);
        $i =0;
        foreach ($list as $value) {
            $value = trim($value);
            $value = explode("=",$value);
            $size[$i] = ["$value[0]" => "$value[1]"];
            $i++;
        }

        // build the updated item
        $item = [];
        $item['name'] = $_POST['name'];
        $item['desc'] = $_POST['desc'];
        $item['IMG'] = $_POST['img'];
        $item['PortionPack'] = [explode(",",$_POST['PortionPack'])[0],explode(",",$_POST['PortionPack'])[1]];
        $item['Price p/kg'] = (float)$_POST['price'];
        $item['Portion Size'] = $size;
        $item['minQTY'] = (int)$_POST['minQty'];
        $item['maxQTY'] = (int)$_POST['maxQty'];
        
        // Load Items
        $jsonfile = file_get_contents("../data/$product");
        $json_data = json_decode($jsonfile, true);

        //add item to Items
        $json_data["items"][$update] = $item;

        // Save the data
        file_put_contents("../data/$product",json_encode($json_data));
        echo '<div class="container">';
        echo "<h1> Item: ".$_POST['desc']." was UPDATED for Category: " .  str_replace(".json","",$_POST['product']) . "</h1>";
        echo '<a href="home.php" class="btn btn-lg btn-primary w-100"> DONE </a>';
        echo '</div>';
        die;
    }

///////////////////////////////////////////////////////////////////////////////////
// Add Item
///////////////////////////////////////////////////////////////////////////////////
    if(isset($_POST['add'])){
       // set update defaults
        $product = $_POST['product'];
        $update = $_POST['update'];
        
        // build out portions size array
        $size = [];
        $list = trim($_POST['size']);
        $list = explode("\n",$list);
        $i =0;
        foreach ($list as $value) {
            $value = trim($value);
            $value = explode("=",$value);
            $size[$i] = ["$value[0]" => "$value[1]"];
            $i++;
        }

        // build the updated item
        $item = [];
        $item['name'] = $_POST['name'];
        $item['desc'] = $_POST['desc'];
        $item['IMG'] = $_POST['img'];
        $item['PortionPack'] = [explode(",",$_POST['PortionPack'])[0],explode(",",$_POST['PortionPack'])[1]];
        $item['Price p/kg'] = (float)$_POST['price'];
        $item['Portion Size'] = $size;
        $item['minQTY'] = (int)$_POST['minQty'];
        $item['maxQTY'] = (int)$_POST['maxQty'];
        
        // Load Items
        $jsonfile = file_get_contents("../data/$product");
        $json_data = json_decode($jsonfile, true);

        // checkDupe
            $i = 0;
            foreach ($json_data['items'] as $value) {
                if($value['name'] === $item['name']){
                    $item = $value;
                break;
                }
            $i++;
            }

        //add item to Items
        $count = $i;
        var_dump($count);
        $json_data["items"][$count] = $item;

        // Save the data
        file_put_contents("../data/$product",json_encode($json_data));
        echo '<div class="container">';
        echo "<h1> Item: ".$_POST['desc']." was ADDED for Category: " .  str_replace(".json","",$_POST['product']) . "</h1>";
        echo '<a href="home.php" class="btn btn-lg btn-primary w-100"> DONE </a>';
        echo '</div>';
        die;
    }


///////////////////////////////////////////////////////////////////////////////////
// DELETE Item
///////////////////////////////////////////////////////////////////////////////////
    if(isset($_POST['delete'])){
        // set update defaults
        $product = $_POST['product'];
        $update = $_POST['update'];
        
        // Load Items
        $jsonfile = file_get_contents("../data/$product");
        $json_data = json_decode($jsonfile, true);

        //Display Items
        array_splice($json_data["items"],$update,1);

        // Save the data
        file_put_contents("../data/$product",json_encode($json_data));
        echo '<div class="container">';
        echo "<h1> Item: ".$_POST['desc']." was DELETED for Category: " .  str_replace(".json","",$_POST['product']) . "</h1>";
        echo '<a href="home.php" class="btn btn-lg btn-primary w-100"> DONE </a>';
        echo '</div>';
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
            
            $item['name'] =  strtoupper(str_replace(".json","",$_POST['product'])) .':Item Name Here';
            $item['desc'] = '';
            $item['IMG'] = '';
            $item['Price p/kg'] = '';
            $item['PortionPack'] = ["1000","p/Kg"];
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
                     echo '<option value="'.'img/'.str_replace('.json','',$product).'/'.$file.'">'.$file.'</option>';
                    }
                ?>
            </select>
            <img class="rounded p-2" id="itemPic" width="250px" src="../<?php echo $item['IMG']; ?>" alt="item picture">
        </div>
        <div class="form-group">
            <label for="price">Per Packing</label>
            <select required class="form-control" id="PortionPack" name="PortionPack">
                <option value="<?php echo $item['PortionPack'][0].",".$item['PortionPack'][1]; ?>" selected>
                    <?php echo $item['PortionPack'][1]; ?>
                </option>
                <option value="1000,p/Kg">p/Kg</option>
                <option value="1,p/Gram">p/Gram</option>
                <option value="1,p/Item">p/Item</option>
                <option value="6,p/Box (x6)">p/Box (x6)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price Per Kg</label>
            <input required type="number" class="form-control" step="0.01" min="0" id="price" name="price"
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