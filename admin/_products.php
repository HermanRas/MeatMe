<?php
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
    <div class="container align-items-center h-100">
        <form method="POST" action="product.php">

            <div class="row">
                <div class="col-12 col-md-6">
                    <!-- Create Category Select -->
                    <select class="form-control  form-control-lg" name="product" id="products" onchange="itemUpdate()">
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
                <div class="col-12 col-md-6">
                    <!-- begin item select -->
                    <select class="form-control form-control-lg" name="item" id="item" onchange="form.submit();"
                        required>
                        <option value="">Select Item</option>
                    </select>
                    <!-- end item select -->
                </div>
            </div>

        </form>
    </div>
</div>
<script src="js/catagoryItems.js"></script>