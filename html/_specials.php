<?php
// Load all Img files and Remove .. & . files
    $files = array_diff(scandir('img/Special'), array('..', '.'));
?>
<!-- PageStart -->
<main data-barba="container" data-barba-namespace="home">
    <div class="container mt-3">
        <hr>
        <h1 class="bg-secondary-dark rounded p-2">Specials !</h1>
        <div class="row">
            <?php
            //loop thru files as categories
            foreach ($files as $file) {
            ?>
            <div class="col-12 col-md-6 text-center">
                <a href="#" class="btn btn-outline-secondary" style="min-width:100%;"><img class="img-fluid"
                        style="min-width:100%; min-height:100%;" src="img/Special/<?php echo $file ;?>"
                        class="rounded main-ico"></a>
            </div>
            <?php
            }
            ?>
        </div>
        <br>
        <hr>
    </div>
</main>