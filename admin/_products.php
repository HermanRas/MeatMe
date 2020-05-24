<div class="container mt-3">
    <h1 class="bg-secondary-dark rounded p-2 text-center">Products</h1>
    <div class="container align-items-center h-100">
        <form method="POST" action="product.php">
            <select class="form-control  form-control-lg" name="product" id="products" onchange="form.submit();">
                <option value="">Please Select</option>
                <?php
                    // Load all Json files and Remove .. & . files
                    $files = array_diff(scandir('../data'), array('..', '.'));
                    foreach ($files as $file) {
                        $data = str_replace(".json","",$file);
                        echo '<option value="'.$file.'">'.$data.'</option>';
                    }
                ?>
            </select>
        </form>
    </div>
</div>