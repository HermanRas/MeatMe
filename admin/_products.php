<div class="container mt-3">
    <h1 class="bg-secondary-dark rounded p-2 text-center">QWEENS ONLINE DELI<br><small>Products</small></h1>
    <div class="container align-items-center h-100">
        <form method="POST">
            <select class="form-control" name="product" id="products">
                <option value="">Please Select</option>
                <?php
                    // Load all Json files and Remove .. & . files
                    $files = array_diff(scandir('../data'), array('..', '.'));
                    foreach ($files as $file) {
                        $data = str_replace(".json","",$file);
                        echo '<option value="'.$data.'">'.$data.'</option>';
                    }
                ?>
            </select>
        </form>
    </div>
</div>