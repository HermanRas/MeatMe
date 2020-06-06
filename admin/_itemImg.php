<?php

if(isset($_POST['del'])){
    $file_pointer = $_POST["pic"];  
    // Use unlink() function to delete a file  
    if (!unlink($file_pointer)) {  
        echo ("$file_pointer cannot be deleted due to an error");  
    }  
    else {  
        echo '<div class="container">';
        echo "<h1> Item: Picture Removed</h1>";
        echo '<a href="home.php" class="btn btn-lg btn-primary w-100"> DONE </a>';
        echo '</div>';
        die;
    }  
}

//////////////////////////////////////////////////////////////////////////////////
// Load Category data
//////////////////////////////////////////////////////////////////////////////////

// Load all Json files and Remove .. & . files
$files = array_diff(scandir('../data'), array('..', '.'));

// $dataSet = [];
// // loop thru all data files loading items
// foreach ($files as $file) {
//     $dataSet[$file] = [];
//     $jsonfile = file_get_contents("../data/$file");
//     $json_data = json_decode($jsonfile, true);
//     $localName = str_replace(".json","",$file);

//     //Display Items
//     foreach ($json_data["items"] as $item) {
//         array_push($dataSet[$file],$item);
//     }
// }
// // Print all store Data
// $storeData = json_encode($dataSet);
// echo "<script> const storeData = JSON.parse('$storeData'); </script>\n";
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
                    <option value="Special">Specials</option>
                    <option value="Slider">Slider</option>
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
    <form method="POST" action="itemImg.php" enctype="multipart/form-data">
        <div class="form-group">
            <label class="file-upload btn btn-primary" for="newPic">Please select picture to upload
                <input type="file" class="form-control-file" name="newPic" id="newPic" onchange="form.submit()">
                <input type="hidden" name="product" value="<?php echo $_POST['product']; ?>">
            </label>
        </div>
    </form>
    <div class="row">
        <?php
            $product = $_POST['product'];
            $files = array_diff(scandir('../img/'.str_replace('.json','',$product)), array('..', '.'));
            foreach ($files as $file) {
                echo '<div class="col-3 p-3 my-2 itemImgBox">';
                echo '<form class="h-100" method="POST">';
                echo '<label class="itemImgLabel text-white">'.$file.'</label>';
                echo '<img class="w-100 h-100 rounded" src="'.'../img/'.str_replace('.json','',$product).'/'.$file.'" alt="item picture" >';
                echo '<input hidden value="../img/'.str_replace('.json','',$product).'/'.$file.'" name="pic" />';
                echo '<input type="submit" class="btn btn-primary form-control" name="del" value="DELETE" />';
                echo '</form>';
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