<?php 
    if(isset($_SESSION['user'])){
        if ($_SESSION['user'] !== "admin"){
            // not admin
            echo '<script>window.location.replace("index.php");</script>';
            die;
        }
    }else{
            // not logged in
            echo '<script>window.location.replace("index.php");</script>';
            die;
    }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-1">
    <!-- ICON  -->
    <a class="navbar-brand" href="index.php">
        <img src="../img/icon.png" class="d-inline-block nav-img align-top rounded">
    </a>

    <!-- Right Pull Menu -->
    <div class="search form-inline my-2 my-lg-0">
        <div class="input-group-append">
            <a href="logout.php" class="btn btn-outline-secondary"><i class="fas fa-lock"></i></a>
        </div>
    </div>

    <!-- MOBILE BURGER BUTTON -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuOrders" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Orders
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuOrders">
                    <a class="dropdown-item" href="ordersActive.php">Orders Active</a>
                    <a class="dropdown-item" href="ordersHistory.php">Order History</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Products
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="products.php">Edit Products</a>
                    <a class="dropdown-item" href="itemIMG.php">Edit Pictures</a>
                </div>
            </li>
        </ul>
    </div>
</nav>