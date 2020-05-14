<!-- PageStart -->
<main data-barba="container" data-barba-namespace="home">
    <div class="container mt-3">
        <h1 class="bg-secondary-dark rounded p-2">BEEF</h1>
        <div class="text-center">
            <img class="img-fluid rounded " src="https://via.placeholder.com/400x250.png?text=400x250 + BEEF"
                alt="beef">
            <p class="small text-danger">Packing: 0 - one big Pack <br>
                Packing: 1-9 packed per person </p>
        </div>
        <br>
        <hr>
        <?php
        // Load Items
        $jsonfile = file_get_contents("data/beef.json");
        $json_data = json_decode($jsonfile, true);

        //Display Items
        foreach ($json_data["items"] as $item) {
        ?>
        <!-- Item START-->
        <form id="<?php echo $item["name"]; ?>Frm">
            <div class="media">
                <img class="mr-3 buy-item" src="https://via.placeholder.com/400x400.png?text=400x400"
                    alt="<?php echo $item["name"]; ?>">
                <div class="media-body">
                    <h5 class="mt-0"><?php echo $item["name"]; ?></h5>
                    <div class="form-row align-items-center">

                        <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Price p/kg</div>
                                </div>
                                <input type="text" class="form-control" id="<?php echo $item["name"]; ?>Price"
                                    value="<?php echo "R " . $item["Price p/kg"]; ?>" readonly>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="<?php echo $item["name"]; ?>Portion">Portion
                                        Size</label>
                                </div>
                                <select class="custom-select" id="<?php echo $item["name"]; ?>Portion" required>
                                    <option value="">Choose...</option>
                                    <?php
                                    // loop thru Portions
                                    foreach ($item["Portion Size"] as $Portion) {
                                        foreach ($Portion as $key => $value) {}
                                        echo '<option value="'. $key .'">'. $value .'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">QTY:</div>
                                </div>
                                <input type="number" class="form-control" id="<?php echo $item["name"]; ?>Qty"
                                    placeholder="0" required>
                            </div>
                        </div>

                        <div class="col-auto">
                            <div class="mb-2">
                                <input class="btn btn-primary mt-0 form-control" type="button"
                                    id="<?php echo $item["name"]; ?>" value="Add" onclick="addCart(this);">
                                <input style="display: none;" type="submit" id="<?php echo $item["name"]; ?>Save">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <hr>
        <!-- Item END-->
        <?php
        }

        ?>
        <br>
        <hr>
    </div>
</main>

<!-- Page Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="js/cartManager.js"></script>
<script>
updateCartCountOnMenu();
</script>