<?php
// Load all Json files and Remove .. & . files
$files = array_diff(scandir('data'), array('..', '.'));

$dataSet = [];

// loop thru all data files loading items
foreach ($files as $file) {
    $jsonfile = file_get_contents("data/$file");
    $json_data = json_decode($jsonfile, true);

    //Display Items
    foreach ($json_data["items"] as $item) {
        array_push($dataSet,$item);
    }
}

// Print all store Data
$storeData = json_encode($dataSet);
echo "<script> const storeData = JSON.parse('$storeData'); </script>";
?>