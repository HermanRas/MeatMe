<?php

//////////////////////////////////////////////////////////////////////////////////
// save new picture
//////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['newPic'])){
        echo "<h1> One Day this will Save your picture </h1>";
        var_dump($_POST);
        echo '<a href="home.php" class="btn btn-lg btn-primary w-100"> CANCEL </a>';
        die;
}

//////////////////////////////////////////////////////////////////////////////////
// Load Category data
//////////////////////////////////////////////////////////////////////////////////

// Load all Json files and Remove .. & . files
$files = array_diff(scandir('../data'), array('..', '.'));

$dataSet = [];
// loop thru all data files loading items
foreach ($files as $file) {
    $dataSet[$file] = [];
    $jsonfile = file_get_contents("../data/$file");
    $json_data = json_decode($jsonfile, true);
    $localName = str_replace(".json","",$file);

    //Display Items
    foreach ($json_data["items"] as $item) {
        array_push($dataSet[$file],$item);
    }
}
// Print all store Data
$storeData = json_encode($dataSet);
echo "<script> const storeData = JSON.parse('$storeData'); </script>\n";
?>
<div class="container mt-3">
    <h1 class="bg-secondary-dark rounded p-2 text-center">Products</h1>

    <form method="POST" action="itemImg.php">
        <div class="row">
            <div class="col-12">
                <!-- Create Category Select -->
                <select class="form-control  form-control-lg" name="product" id="products" onchange="form.submit()">
                    <option value="">Please Select</option>
                    <?php
                            //loop thru files as categories
                            foreach ($files as $file) {
                                $data = str_replace(".json","",$file);
                                echo '<option value="'.$file.'">'.$data.'</option>';
                            }
                        ?>
                </select>
                <!-- end category select -->
            </div>
        </div>
    </form>
    <hr>

    <!-- Image Gallery -->
    <?php
        if(isset($_POST['product'])){
    ?>
    <form method="POST">
        <div class="form-group">
            <label for="newPic">Please select picture to upload</label>
            <input type="file" class="form-control-file" name="newPic" id="newPic" onchange="form.submit()">
        </div>
    </form>
    <div class="row">
        <?php
            $product = $_POST['product'];
            $files = array_diff(scandir('../img/'.str_replace('.json','',$product)), array('..', '.'));
            foreach ($files as $file) {
                echo '<div class="col-3 p-3 my-2 itemImgBox">';
                echo '<label class="itemImgLabel text-white">'.$file.'</label>';
                echo '<img class="w-100 h-100 rounded" src="'.'../img/'.str_replace('.json','',$product).'/'.$file.'" alt="item picture" >';
                echo '<a class="btn btn-primary form-control" href="?del='.str_replace('.json','',$product).'/'.$file.'" >DELETE</a>';
                echo '</div>';
            }
        }
    ?>
    </div>
    <div class="row">
        <div class="col-12 col-md-12">
            <br>
            <hr>
            <a href="home.php" class="btn btn-lg btn-primary w-100"> Cancel </a>
            <br>
            <br>
        </div>
    </div>
</div>
<script src="js/catagoryItems.js"></script>