<?php
if (!empty($_FILES["newPic"])) {

    $product = $_POST['product'];
    $UploadDir = '../img/'.str_replace('.json','',$product).'/';
    define("UPLOAD_DIR", $UploadDir );

    $myFile = $_FILES["newPic"];
    $size =  $_FILES["newPic"]["size"];
    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred check size .</p>";
        exit;
    }

    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
    }

    // check uploaded mimetype
    $mimetype = mime_content_type($myFile["tmp_name"]);
    if(in_array($mimetype, array('image/jpeg','image/png'))) {
        //looks like a picture
    } else {
        echo "<p>Unable to save file png or jpg Only.</p>";
        die;
    }

    //check upload ext
    $splitPDF =  strtoupper(substr($name,-4,strlen($name)));
    if ($splitPDF === '.JPG' || $splitPDF === '.PNG'){
        $success = move_uploaded_file($myFile["tmp_name"],
            UPLOAD_DIR . $name);
        if (!$success) { 
            echo "<p>Unable to save file server error.</p>";
            die;
        }else{
            echo '<div class="container">';
            echo "<h1> Item: Picture Uploaded</h1>";
            echo '<a href="home.php" class="btn btn-lg btn-primary w-100"> DONE </a>';
            echo '</div>';
            die;
        }
    }   else{
        echo "<p>Unable to save file png or jpg Only.</p>";
        die;
    }
}